<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = (int)$_POST['task_id'];
    $userId = $_SESSION['user']['id'];
    $content = trim($_POST['content']);
    
    if (empty($content)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    
    // proverka dali korisnikot ima dozvola da komentira
    $sql = "SELECT t.*, u.level as assignee_level, p.team_lead_id
            FROM tasks t
            JOIN projects p ON t.project_id = p.id
            LEFT JOIN users u ON t.assignee_id = u.id
            WHERE t.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$taskId]);
    $task = $stmt->fetch();
    
    $canComment = false;
    $userLevel = $_SESSION['user']['level'];
    
    switch($userLevel) {
        case 'Senior':
            $canComment = true;  
            break;
        case 'Mid':
            // mid mozat da komentiraat samo na nivnite zadaci i na juniorite
            $canComment = $task['assignee_id'] === $userId || 
                         ($task['assignee_level'] === 'Junior');
            break;
        case 'Junior':
            $canComment = $task['assignee_id'] === $userId;
            break;
    }
    
    if ($canComment) {
        $currentTime = date('Y-m-d H:i:s');
        $sql = "INSERT INTO comments (task_id, user_id, content, created_at) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$taskId, $userId, $content, $currentTime]);
    }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
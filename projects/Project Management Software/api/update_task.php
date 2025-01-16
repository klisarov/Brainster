<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = (int)$_POST['task_id'];
    $newStatus = $_POST['status'];
    $userId = $_SESSION['user']['id'];
    
    // zema informacii za zadaca
    $sql = "SELECT * FROM tasks WHERE id = '$taskId'";
    $result = mysqli_query($conn, $sql);
    $task = mysqli_fetch_assoc($result);
    
    // zema nivo na korisnik ako postoi
    $assigneeLevel = null;
    if ($task['assignee_id']) {
        $sql = "SELECT level FROM users WHERE id = '" . $task['assignee_id'] . "'";
        $result = mysqli_query($conn, $sql);
        $assignee = mysqli_fetch_assoc($result);
        $assigneeLevel = $assignee['level'];
    }
    
    $canChange = false;
    $userLevel = $_SESSION['user']['level'];
    $isAssigned = ($task['assignee_id'] == $userId);
    
    // proverka za dozvola bazirano na hierarhija
    if ($userLevel === 'Senior') {
        $canChange = true;
    } elseif ($userLevel === 'Mid' && $isAssigned) {
        $canChange = ($newStatus !== 'To Do');
    } elseif ($userLevel === 'Junior' && $isAssigned) {
        $canChange = ($newStatus === 'In Progress' || $newStatus === 'QA');
    }
    
    if ($canChange) {
        // vrsi promena na status na zadaca
        $sql = "UPDATE tasks SET status = '$newStatus' WHERE id = '$taskId'";
        mysqli_query($conn, $sql);
        
        // dodava sistemski komentar za promena
        $username = mysqli_real_escape_string($conn, $_SESSION['user']['name']);
        $oldStatus = $task['status'];
        $currentTime = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO comments (task_id, user_id, content, is_system_generated, created_at) 
                VALUES ('$taskId', '$userId', 
                        '$username changed status from $oldStatus to $newStatus', 
                        1, '$currentTime')";
        mysqli_query($conn, $sql);
    }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
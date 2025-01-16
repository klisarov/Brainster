<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
    header('Location: ../../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO projects (
        title, 
        description, 
        requirements, 
        estimated_completion, 
        team_lead_id, 
        deadline
    ) VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $_POST['title'],
        $_POST['description'],
        $_POST['requirements'],
        $_POST['estimated_completion'],
        $_POST['team_lead_id'],
        $_POST['deadline']
    ]);
    
    $projectId = $conn->lastInsertId();
    
    // dodava team lead vo proektot na timot
    $sql = "INSERT INTO teams (project_id, user_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$projectId, $_POST['team_lead_id']]);
    
    header('Location: ../dashboard.php');
}
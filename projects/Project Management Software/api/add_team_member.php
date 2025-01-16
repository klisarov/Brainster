<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectId = (int)$_POST['project_id'];
    $userId = (int)$_POST['user_id'];
    
    // proverka dali korisnikot ima dozvola da dodava clenovi na tim
    $sql = "SELECT team_lead_id FROM projects WHERE id = '$projectId'";
    $result = mysqli_query($conn, $sql);
    $project = mysqli_fetch_assoc($result);
    
    $canAddMember = false;
    if ($_SESSION['user']['is_admin']) {
        $canAddMember = true;
    } elseif ($_SESSION['user']['is_team_lead']) {
        $canAddMember = $project['team_lead_id'] == $_SESSION['user']['id'];
    }
    
    if ($canAddMember) {
        // proverka dali korisnikot veke postoi
        $sql = "SELECT COUNT(*) as count FROM teams 
                WHERE project_id = '$projectId' AND user_id = '$userId'";
        $result = mysqli_query($conn, $sql);
        $exists = mysqli_fetch_assoc($result)['count'] > 0;
        
        if (!$exists) {
            // dodavanje na clen
            $sql = "INSERT INTO teams (project_id, user_id) 
                    VALUES ('$projectId', '$userId')";
            mysqli_query($conn, $sql);
        }
    }
    
    header('Location: ../project.php?id=' . $projectId);
}
?>
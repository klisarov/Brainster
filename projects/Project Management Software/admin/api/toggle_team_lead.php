<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int)$_POST['user_id'];
    $isTeamLead = $_POST['is_team_lead'] === 'true' ? 1 : 0;
    
    // proverka dali korisnikot ima Senior role
    $sql = "SELECT level FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    
    if ($user['level'] !== 'Senior') {
        echo json_encode([
            'success' => false,
            'message' => 'Only Senior users can be Team Leads'
        ]);
        exit;
    }
    
    $sql = "UPDATE users SET is_team_lead = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $success = $stmt->execute([$isTeamLead, $userId]);
    
    echo json_encode(['success' => $success]);
}
?>
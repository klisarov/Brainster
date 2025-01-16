<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int)$_POST['user_id'];
    
    // proverka za aktivni proekti
    $sql = "SELECT COUNT(*) FROM projects WHERE team_lead_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    if ($stmt->fetchColumn() > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Cannot delete user with active projects'
        ]);
        exit;
    }
    
    $conn->beginTransaction();
    
    try {
        // otstranuva od tim
        $sql = "DELETE FROM teams WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        
        // gi brise komentarite na korisnikot
        $sql = "DELETE FROM comments WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        
        // gi brise zadacite na korisnikot
        $sql = "UPDATE tasks SET assignee_id = NULL WHERE assignee_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        
        // go brise korisnikot od users
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        
        $conn->commit();
        echo json_encode(['success' => true]);
        
    } catch (Exception $e) {
        $conn->rollBack();
        echo json_encode([
            'success' => false,
            'message' => 'Failed to delete user'
        ]);
    }
}
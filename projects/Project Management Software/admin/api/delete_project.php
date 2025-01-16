<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectId = (int)$_POST['project_id'];
    
    $conn->beginTransaction();
    
    try {
        // brise komentari od zadaci na proektot
        $sql = "DELETE FROM comments WHERE task_id IN 
                (SELECT id FROM tasks WHERE project_id = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$projectId]);
        
        // gi brise zadacite na proektot
        $sql = "DELETE FROM tasks WHERE project_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$projectId]);
        
        // gi brise clenovite na timovite
        $sql = "DELETE FROM teams WHERE project_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$projectId]);
        
        // go brise celosno proektot od projects
        $sql = "DELETE FROM projects WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$projectId]);
        
        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $conn->rollBack();
        echo json_encode([
            'success' => false,
            'message' => 'Failed to delete project'
        ]);
    }
}
?>
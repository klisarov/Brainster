<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int)$_POST['user_id'];
    
    $sql = "DELETE FROM users WHERE id = ? AND is_approved = 0";
    $stmt = $conn->prepare($sql);
    $success = $stmt->execute([$userId]);
    
    echo json_encode(['success' => $success]);
}
?>
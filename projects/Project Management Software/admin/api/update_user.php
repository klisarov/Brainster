<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int)$_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $level = $_POST['level'];
    
    $sql = "UPDATE users SET name = ?, email = ?, level = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $success = $stmt->execute([$name, $email, $level, $userId]);
    
    echo json_encode(['success' => $success]);
}
?>
<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $level = $_POST['level'];
    $password = substr(md5(rand()), 0, 8); // generira sifra
    
    $sql = "INSERT INTO users (name, email, password, level, is_approved) 
            VALUES (?, ?, ?, ?, 1)";
    $stmt = $conn->prepare($sql);
    $success = $stmt->execute([
        $name,
        $email,
        md5($password),
        $level
    ]);
    
    if ($success) {
        echo json_encode([
            'success' => true,
            'password' => $password
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to create user'
        ]);
    }
}
?>
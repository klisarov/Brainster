<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentId = (int)$_POST['comment_id'];
    $userId = $_SESSION['user']['id'];
    
    // proverka za sopstvenost na komentar
    $sql = "SELECT * FROM comments WHERE id = '$commentId'";
    $result = mysqli_query($conn, $sql);
    $comment = mysqli_fetch_assoc($result);
    
    if ($comment && 
        ($comment['user_id'] == $userId || $_SESSION['user']['is_admin']) && 
        !$comment['is_system_generated']) {
        
        // brisenje na komentar
        $sql = "DELETE FROM comments WHERE id = '$commentId'";
        mysqli_query($conn, $sql);
    }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
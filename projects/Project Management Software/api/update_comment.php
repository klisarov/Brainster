<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentId = (int)$_POST['comment_id'];
    $content = mysqli_real_escape_string($conn, trim($_POST['content']));
    $userId = $_SESSION['user']['id'];
    
    if (empty($content)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    
    // proverka dali korisnikot e sopstvenik na komentar
    $sql = "SELECT * FROM comments WHERE id = '$commentId'";
    $result = mysqli_query($conn, $sql);
    $comment = mysqli_fetch_assoc($result);
    
    if ($comment && 
        ($comment['user_id'] == $userId || $_SESSION['user']['is_admin']) && 
        !$comment['is_system_generated']) {
        
        $currentTime = date('Y-m-d H:i:s');
        
        // obnovuvanje na komentar
        $sql = "UPDATE comments 
                SET content = '$content', 
                    is_edited = 1, 
                    created_at = '$currentTime' 
                WHERE id = '$commentId'";
        mysqli_query($conn, $sql);
    }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

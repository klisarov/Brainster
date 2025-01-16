<?php
session_start();

// redirect nosi zavisno od auth
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
} else {
    header('Location: auth/login.php');
}
exit;
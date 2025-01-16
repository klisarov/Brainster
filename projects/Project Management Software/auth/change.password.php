<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user']['id'];
    $currentPassword = md5($_POST['current_password']);
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    
    if ($newPassword !== $confirmPassword) {
        $error = "New passwords do not match";
    } else {
        // proverka na psw
        $sql = "SELECT id FROM users WHERE id = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $currentPassword]);
        
        if (!$stmt->fetch()) {
            $error = "Current password is incorrect";
        } else {
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            
            if ($stmt->execute([md5($newPassword), $userId])) {
                $success = "Password changed successfully";
            } else {
                $error = "Failed to change password";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password - ManageTasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php include '../includes/header.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Change Password</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success">
                                <?php echo $success; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Confirm New Password</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                            <a href="../dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
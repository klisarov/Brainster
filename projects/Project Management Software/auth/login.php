<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = $_POST['identifier']; // moze da bide ili email ili ime (username)
    $password = md5($_POST['password']);
    
    // proverka na email i name
    $sql = "SELECT * FROM users 
            WHERE (email = ? OR name = ?) 
            AND password = ? 
            AND is_approved = 1";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute([$identifier, $identifier, $password]);
    $user = $stmt->fetch();
    
    if ($user) {
        $_SESSION['user'] = $user;
        if ($user['is_admin']) {
            header('Location: ../admin/dashboard.php');
        } else {
            header('Location: ../dashboard.php');
        }
        exit;
    } else {
        $error = "Invalid credentials or account not approved";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - ManageTasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label>Email or Name</label>
                                <input type="text" name="identifier" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="register.php" class="btn btn-link">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
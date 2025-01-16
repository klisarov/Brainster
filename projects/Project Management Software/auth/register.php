<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $error = "Passwords do not match";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $level = $_POST['level'];
        
        // proverka na mail 
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        
        if ($stmt->fetchColumn() > 0) {
            $error = "Email already exists";
        } else {
            $sql = "INSERT INTO users (name, email, password, level) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            
            if ($stmt->execute([$name, $email, $password, $level])) {
                $_SESSION['success'] = "Registration successful. Please wait to get approved by an admin.";
                header('Location: login.php');
                exit;
            } else {
                $error = "Registration failed";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - ManageTasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Register</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Level</label>
                                <select name="level" class="form-control" required>
                                    <option value="Junior">Junior</option>
                                    <option value="Mid">Mid</option>
                                    <option value="Senior">Senior</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                            <a href="login.php" class="btn btn-link">Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body> 
</html>
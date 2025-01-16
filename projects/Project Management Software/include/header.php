<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /auth/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ManageTasks | Luka Krstev Brainster Challenges</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/dashboard.php">ManageTasks</a>
            <div class="nav">
                <a class="nav-link text-white" href="/dashboard.php">Dashboard</a>
                <?php if ($_SESSION['user']['is_admin']): ?>
                    <a class="nav-link text-white" href="/admin/dashboard.php">Admin Panel</a>
                <?php endif; ?>
                <div class="nav-item">
                    <span class="nav-link text-white" id="userMenuButton" onclick="toggleUserMenu()">
                        <?php echo htmlspecialchars($_SESSION['user']['name']); ?> 
                        (<?php echo htmlspecialchars($_SESSION['user']['level']); ?>)
                    </span>
                    <div id="userMenu" class="bg-white border p-2" style="display: none; position: absolute; right: 0;">
                        <a href="/auth/change_password.php" class="d-block p-1">Change Password</a>
                        <a href="/auth/logout.php" class="d-block p-1">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
    function toggleUserMenu() {
        var menu = document.getElementById('userMenu');
        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }

    // event handling
    document.addEventListener('click', function(event) {
        if (!event.target.matches('#userMenuButton')) {
            document.getElementById('userMenu').style.display = 'none';
        }
    });
    </script>

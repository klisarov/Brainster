<?php
$show_form = true;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $users = file("users.txt", FILE_IGNORE_NEW_LINES);
    $user_found = false;

    foreach ($users as $user) {
        list($stored_email, $stored_credentials) = explode(", ", $user);
        list($stored_username, $stored_password) = explode("=", $stored_credentials);
        
        if ($stored_username === $username && password_verify($password, $stored_password)) {
            $user_found = true;
            break;
        }
    }

    if ($user_found) {
        $show_form = false;
        $message = "Welcome $username";
    } else {
        $message = "Wrong username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Brainster</title>
</head>
<body>
    <?php if ($show_form): ?>
        <h1>Login</h1>
        <?php
        if ($message) {
            echo "<p>$message</p>";
        }
        ?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
    <?php else: ?>
        <h1><?php echo $message; ?></h1>
    <?php endif; ?>
</body>
</html>
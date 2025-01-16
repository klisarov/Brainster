<?php
$show_form = true;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $users = file("users.txt", FILE_IGNORE_NEW_LINES);
    $username_taken = false;
    $email_taken = false;

    foreach ($users as $user) {
        list($stored_email, $stored_credentials) = explode(", ", $user);
        list($stored_username, $stored_password) = explode("=", $stored_credentials);
        
        if ($stored_username === $username) {
            $username_taken = true;
        }
        
        if ($stored_email === $email) {
            $email_taken = true;
        }

        if ($username_taken || $email_taken) {
            break;
        }
    }

    if ($username_taken) {
        $message = "This username is taken!";
    } elseif ($email_taken) {
        $message = "This email already exists!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $user_data = "$email, $username=$hashed_password\n";
        file_put_contents("users.txt", $user_data, FILE_APPEND);
        $show_form = false;
        $message = "Welcome $username";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up | Brainster</title>
</head>
<body>
    <?php if ($show_form): ?>
        <h1>Sign up</h1>
        <?php
        if ($message) {
            echo "<p>$message</p>";
        }
        ?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Sign Up">
        </form>
    <?php else: ?>
        <h1><?php echo $message; ?></h1>
    <?php endif; ?>
</body>
</html>
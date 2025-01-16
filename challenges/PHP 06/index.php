<?php
include 'process.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Validation | Brainster Challenge</title>
    <style>
        * {
            text-align: center;
        }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Sign Up</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
            <?php if (isset($errors['name'])) echo "<p class='error'>".$errors['name']."</p>"; ?>
        </div>
        <div>
            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" value="<?php echo isset($_POST['surname']) ? $_POST['surname'] : ''; ?>">
            <?php if (isset($errors['surname'])) echo "<p class='error'>".$errors['surname']."</p>"; ?>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            <?php if (isset($errors['email'])) echo "<p class='error'>".$errors['email']."</p>"; ?>
        </div>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
            <?php if (isset($errors['username'])) echo "<p class='error'>".$errors['username']."</p>"; ?>
        </div>
        <div>
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
            <?php if (isset($errors['phone'])) echo "<p class='error'>".$errors['phone']."</p>"; ?>
        </div>
        <div>
            <label for="dateofbirth">Date of Birth:</label>
            <input type="date" id="dateofbirth" name="dateofbirth" value="<?php echo isset($_POST['dateofbirth']) ? $_POST['dateofbirth'] : ''; ?>">
            <?php if (isset($errors['dateofbirth'])) echo "<p class='error'>".$errors['dateofbirth']."</p>"; ?>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <?php if (isset($errors['password'])) echo "<p class='error'>".$errors['password']."</p>"; ?>
        </div>
        <div>
            <input type="submit" value="Sign Up">
        </div>
    </form>
</body>
</html>

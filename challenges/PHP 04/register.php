<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $telNumber = $_POST['telNumber'];
    $password = $_POST['password'];

    $errors = [];

    if (empty($firstName)) {
        $errors[] = "Your first name is required.";
    }
    if (empty($lastName)) {
        $errors[] = "Your last name is required.";
    }
    if (empty($userName)) {
        $errors[] = "Username is required.";
    }
    if (empty($telNumber)) {
        $errors[] = "Your telephone number is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

            foreach ($errors as $error) {
                echo $error;
                echo "<a href='index.php'>Go back to the form.</a>";
            }
        } else {
            if (!file_exists('users')) {
                mkdir('users', 0755, true);
            }

        $usersFile = 'users/users.txt';
        if (!file_exists($usersFile)) {
            file_put_contents($usersFile, $userName . PHP_EOL);
        } else {
            file_put_contents($usersFile, $userName . PHP_EOL, FILE_APPEND);
        }

        $userFolder = 'users/' . $firstName . '_' . $lastName;
        if (!file_exists($userFolder)) {
            mkdir($userFolder, 0755, true);
        }

        $userFile = $userFolder . '/' . $firstName . '.txt';
        $userData = $firstName . ',' . $lastName . ',' . $userName . ',' . $telephoneNumber . ',' . $password;
        file_put_contents($userFile, $userData);

        echo "Welcome to our page!";
    }
?>

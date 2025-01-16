<?php
include 'validation.php';

$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $dob = $_POST["dateofbirth"];
    $password = $_POST["password"];

    if (!validateReq($name)) $errors["name"] = "Name is required";
    if (!validateReq($surname)) $errors["surname"] = "Surname is required";
    if (!validateReq($email)) {
        $errors["email"] = "Email is required";
    } elseif (!validateEmail($email)) {
        $errors["email"] = "Invalid email";
    }
    if (!validateReq($username)) {
        $errors["username"] = "Username is required";
    } elseif (!validateUsername($username)) {
        $errors["username"] = "Invalid username";
    }
    if (!validateReq($phone)) {
        $errors["phone"] = "Phone number is required";
    } elseif (!validatePhone($phone)) {
        $errors["phone"] = "Invalid phone number";
    }
    if (!validateReq($dob)) {
        $errors["dateofbirth"] = "Date of birth is required";
    } elseif (!validateAge($dob)) {
        $errors["dateofbirth"] = "You must be at least 18 years old";
    }
    if (!validateReq($password)) {
        $errors["password"] = "Password is required";
    } elseif (!validatePassword($password)) {
        $errors["password"] = "Invalid password";
    }
}

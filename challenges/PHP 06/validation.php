<?php
function validateReq($value) {
    return $value != "";
}

function validateUsername($username) {
    $valid = true;
    for ($i = 0; $i < strlen($username); $i++) {
        $char = $username[$i];
        if (!($char >= 'a' && $char <= 'z') && !($char >= 'A' && $char <= 'Z') && !($char >= '0' && $char <= '9')) {
            $valid = false;
            break;
        }
    }
    return $valid;
}

function validateEmail($email) {
    $atPosition = strpos($email, '@');
    if ($atPosition === false || $atPosition < 5) {
        return false;
    }
    return strpos($email, '.', $atPosition) !== false;
}

function validatePassword($password) {
    $hasUpper = false;
    $hasNumber = false;
    $hasSpecial = false;
    $specialChars = "!@#$%^&*";
    for ($i = 0; $i < strlen($password); $i++) {
        $char = $password[$i];
        if ($char >= 'A' && $char <= 'Z') {
            $hasUpper = true;
        } elseif ($char >= '0' && $char <= '9') {
            $hasNumber = true;
        } elseif (strpos($specialChars, $char) !== false) {
            $hasSpecial = true;
        }
    }
    return $hasUpper && $hasNumber && $hasSpecial;
}

function validatePhone($phone) {
    for ($i = 0; $i < strlen($phone); $i++) {
        if (!($phone[$i] >= '0' && $phone[$i] <= '9')) {
            return false;
        }
    }
    return true;
}

function validateAge($dob) {
    $dobParts = explode('-', $dob);
    $dobYear = (int)$dobParts[0];
    $dobMonth = (int)$dobParts[1];
    $dobDay = (int)$dobParts[2];
    
    $currentYear = (int)date('Y');
    $currentMonth = (int)date('m');
    $currentDay = (int)date('d');
    
    $age = $currentYear - $dobYear;
    if ($currentMonth < $dobMonth || ($currentMonth == $dobMonth && $currentDay < $dobDay)) {
        $age--;
    }
    
    return $age >= 18;
}
?>
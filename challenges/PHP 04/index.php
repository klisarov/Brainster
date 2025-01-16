<!DOCTYPE html>
<html>
<head>
    <title>Registration Form | Brainster PHP</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName">
        <br>
        
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName">
        <br>
        
        <label for="userName">Username:</label>
        <input type="text" id="userName" name="userName">
        <br>
        
        <label for="telephoneNumber">Telephone Number:</label>
        <input type="text" id="telNumber" name="telNumber">
        <br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>

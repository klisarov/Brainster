<?php
require_once 'database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $fields = ['cover_image_url', 'title', 'subtitle', 'company_description', 'phone', 'location', 'type', 'item1_url', 'item1_description', 'item2_url', 'item2_description', 'item3_url', 'item3_description', 'contact_description', 'linkedin_url', 'facebook_url', 'twitter_url', 'instagram_url'];

    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
        }
    }

    if (empty($errors)) {
        try {
            $stmt = $db->prepare("INSERT INTO websites (cover_image_url, title, subtitle, company_description, phone, location, type, item1_url, item1_description, item2_url, item2_description, item3_url, item3_description, contact_description, linkedin_url, facebook_url, twitter_url, instagram_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute(array_map('htmlspecialchars', [
                $_POST['cover_image_url'],
                $_POST['title'],
                $_POST['subtitle'],
                $_POST['company_description'],
                $_POST['phone'],
                $_POST['location'],
                $_POST['type'],
                $_POST['item1_url'],
                $_POST['item1_description'],
                $_POST['item2_url'],
                $_POST['item2_description'],
                $_POST['item3_url'],
                $_POST['item3_description'],
                $_POST['contact_description'],
                $_POST['linkedin_url'],
                $_POST['facebook_url'],
                $_POST['twitter_url'],
                $_POST['instagram_url']
            ]));

            $id = $db->lastInsertId();
            header("Location: company.php?id=$id");
            exit();
        } catch(PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build a page!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-top: 10px;
            color: #666;
        }
        input[type="text"], input[type="url"], textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 1.1em;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>You are one step away from your own webpage!</h1>
        <?php
        if (!empty($errors)) {
            echo "<div class='error'>";
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo "</div>";
        }
        ?>
        <form method="POST" action="">
            <label for="cover_image_url">Cover Image URL:</label>
            <input type="url" id="cover_image_url" name="cover_image_url" required>

            <label for="title">Main Title of Page:</label>
            <input type="text" id="title" name="title" required>

            <label for="subtitle">Subtitle of Page:</label>
            <input type="text" id="subtitle" name="subtitle" required>

            <label for="company_description">Something about you:</label>
            <textarea id="company_description" name="company_description" required></textarea>

            <label for="phone">Your telephone number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="type">Do you provide services or products?</label>
            <select id="type" name="type" required>
                <option value="services">Services</option>
                <option value="products">Products</option>
            </select>

            <label for="item1_url">Image URL:</label>
            <input type="url" id="item1_url" name="item1_url" required>

            <label for="item1_description">Description of service/product 1:</label>
            <textarea id="item1_description" name="item1_description" required></textarea>

            <label for="item2_url">Image URL:</label>
            <input type="url" id="item2_url" name="item2_url" required>

            <label for="item2_description">Description of service/product 2:</label>
            <textarea id="item2_description" name="item2_description" required></textarea>

            <label for="item3_url">Image URL:</label>
            <input type="url" id="item3_url" name="item3_url" required>

            <label for="item3_description">Description of service/product:</label>
            <textarea id="item3_description" name="item3_description" required></textarea>

            <label for="contact_description">Description for contact form:</label>
            <textarea id="contact_description" name="contact_description" required></textarea>

            <label for="linkedin_url">LinkedIn:</label>
            <input type="url" id="linkedin_url" name="linkedin_url" required>

            <label for="facebook_url">Facebook:</label>
            <input type="url" id="facebook_url" name="facebook_url" required>

            <label for="twitter_url">Twitter:</label>
            <input type="url" id="twitter_url" name="twitter_url" required>

            <label for="instagram_url">Instagram:</label>
            <input type="url" id="instagram_url" name="instagram_url" required>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
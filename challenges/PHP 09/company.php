<?php
require_once 'database.php';

$database = new Database();
$db = $database->getConnection();

if (!isset($_GET['id'])) {
    die("No website ID provided");
}

try {
    $stmt = $db->prepare("SELECT * FROM websites WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $website = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$website) {
        die("Website not found");
    }
} catch(PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($website['title']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        header {
            background-image: url('<?php echo htmlspecialchars($website['cover_image_url']); ?>');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        header h1 {
            font-size: 3em;
            margin-bottom: 0.5em;
        }
        header p {
            font-size: 1.5em;
        }
        nav {
            background-color: #333;
            padding: 1em 0;
            position: sticky;
            top: 0;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 1em;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: #555;
        }
        section {
            padding: 2em;
            max-width: 800px;
            margin: 0 auto;
        }
        .services-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .service-item {
            flex-basis: 30%;
            text-align: center;
            margin-bottom: 2em;
        }
        .service-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em 0;
        }
        footer a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        form {
            display: grid;
            gap: 1em;
        }
        input, textarea {
            width: 100%;
            padding: 0.5em;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 1em;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($website['title']); ?></h1>
        <p><?php echo htmlspecialchars($website['subtitle']); ?></p>
    </header>

    <nav>
        <a href="#about">About Us</a>
        <a href="#<?php echo $website['type']; ?>"><?php echo ucfirst($website['type']); ?></a>
        <a href="#contact">Contact</a>
    </nav>

    <section id="about">
        <h2>About Us</h2>
        <p><?php echo htmlspecialchars($website['company_description']); ?></p>
        <p>Phone: <?php echo htmlspecialchars($website['phone']); ?></p>
        <p>Location: <?php echo htmlspecialchars($website['location']); ?></p>
    </section>

    <section id="<?php echo $website['type']; ?>">
        <h2><?php echo ucfirst($website['type']); ?></h2>
        <div class="services-container">
            <div class="service-item">
                <img src="<?php echo htmlspecialchars($website['item1_url']); ?>" alt="Item 1">
                <p><?php echo htmlspecialchars($website['item1_description']); ?></p>
            </div>
    </body>
    </html>
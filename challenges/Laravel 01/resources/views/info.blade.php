<!DOCTYPE html>
<html>
<head>
    <title>Business Casual - Info</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('/images/coffee-beans.jpg');
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .heading {
            text-align: center;
            color: white;
            font-size: 48px;
            margin: 40px 0;
            font-weight: normal;
        }

        nav {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px 0;
            text-align: center;
            margin-bottom: 50px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 20px;
            font-size: 16px;
        }

        nav a.active {
            color: #FFA500;
        }

        .info-container {
            margin: 50px auto;
            text-align: center;
            color: white;
            font-size: 20px;
        }

        .info-text {
            margin: 15px 0;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }

        .clear-session-btn {
            background-color: #2196F3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 20px;
            display: inline-block;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1 class="heading">BUSINESS CASUAL</h1>
    
    <nav>
        <a href="/">HOME</a>
        <a href="/form">LOG IN</a>
        <a href="/info" class="active">LOG OUT</a>
    </nav>

    <div class="info-container">
        <div class="info-text">Your name is: <?php echo session('name'); ?></div>
        <div class="info-text">Your last name is: <?php echo session('lastname'); ?></div>
        <?php if(session('email')): ?>
            <div class="info-text">Your email is: <?php echo session('email'); ?></div>
        <?php endif; ?>

        <form action="/clear-session" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="clear-session-btn">Clear Session</button>
        </form>
    </div>

    <footer>
        Copyright © Your Website 2024   
    </footer>
</body>
</html>
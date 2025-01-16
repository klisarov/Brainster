<!DOCTYPE html>
<html>
<head>
    <title>Business Casual</title>
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

        .content-wrapper {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .cafe-section {
            position: relative;
            margin-bottom: 50px;
        }

        .cafe-image {
            width: 100%;
            height: auto;
        }

        .info-box {
            position: absolute;
            top: 50%;
            left: 10%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            max-width: 400px;
        }

        .info-box h2 {
            margin: 0 0 10px 0;
            color: #333;
        }

        .info-box p {
            color: #666;
            margin-bottom: 20px;
        }

        .visit-btn {
            background-color: #FFA500;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .promise-section {
            background-color: #FFA500;
            padding: 30px;
            margin-bottom: 50px;
        }

        .promise-content {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            text-align: center;
        }

        .promise-content h3 {
            color: #333;
            margin: 0 0 10px 0;
            font-weight: normal;
        }

        .promise-content h2 {
            color: #333;
            margin: 0 0 20px 0;
            font-size: 32px;
        }

        .promise-content p {
            color: #666;
            margin: 0;
            line-height: 1.6;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }

        .clear-session-btn {
            background-color: #FF4136;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1 class="heading">BUSINESS CASUAL</h1>
    
    <nav>
        <a href="/" class="active">HOME</a>
        <a href="/form">LOG IN</a>
    </nav>

    <div class="content-wrapper">
        <div class="cafe-section">
            <img src="/images/cafe.jpg" alt="Cafe" class="cafe-image">
            <div class="info-box">
                <h2>LOREM IPSUM</h2>
                <h2>LOREM IPSUM</h2>
                <p>Enim sunt aliqua ullamco laborum et laboris non aliqua mollit consequat.</p>
                <p>Sunt quis laboris quis tempor reprehenderit nulla irure labore irure aute ipsum incididunt nostrud deserunt. Consequat enim ex non velit veniam excepteur nisi sunt et.</p>
                <button class="visit-btn">Visit us today</button>
            </div>
        </div>

        <div class="promise-section">
            <div class="promise-content">
                <h3>OUR PROMISE</h3>
                <h2>TO <?php echo session('name') ? session('name').' '.session('lastname') : 'YOU'; ?></h2>
                <p>Irure reprehenderit magna aliquip nisi ex pariatur. Magna aliquip dolore deserunt pariatur anim. Ex excepteur officia veniam commodo culpa aute in esse. Dolore ea nisi nostrud do culpa. Irure commodo cupidatat tempor esse aliqua euismod excepteur nulla ut duis do aliquip et. Incididunt magna elit reprehenderit do culpa aliquip. Id proident ex eu quis aliqua eit cilium consectetur ut enim. Non aute consectetur exercitation occaecat reprehenderit adipisicing consequat laborum commodo et. Aliqua duis officia eiusmod voluptate eu occaecat aliquip eu.</p>
            </div>
        </div>

        <?php if(session('name')): ?>
            <form action="/clear-session" method="POST" style="text-align: center;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="clear-session-btn">Clear Session</button>
            </form>
        <?php endif; ?>
    </div>

    <footer>
        Copyright © Your Website 2024
    </footer>
</body>
</html>
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

        .form-container {
            width: 90%;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: white;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            margin-top: 5px;
        }

        .error {
            background-color: #FF4136;
            color: white;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 3px;
            font-size: 14px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 20px;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <h1 class="heading">BUSINESS CASUAL</h1>
    
    <nav>
        <a href="/">HOME</a>
        <a href="/form" class="active">LOG IN</a>
    </nav>

    <div class="form-container">
        <form action="/submit-form" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <?php if(session('errors') && isset(session('errors')['name'])): ?>
                    <div class="error"><?php echo session('errors')['name']; ?></div>
                <?php endif; ?>
                <label>NAME</label>
                <input type="text" name="name" value="<?php echo session('old')['name'] ?? ''; ?>">
            </div>

            <div class="form-group">
                <?php if(session('errors') && isset(session('errors')['lastname'])): ?>
                    <div class="error"><?php echo session('errors')['lastname']; ?></div>
                <?php endif; ?>
                <label>LAST NAME</label>
                <input type="text" name="lastname" value="<?php echo session('old')['lastname'] ?? ''; ?>">
            </div>

            <div class="form-group">
                <?php if(session('errors') && isset(session('errors')['email'])): ?>
                    <div class="error"><?php echo session('errors')['email']; ?></div>
                <?php endif; ?>
                <label>EMAIL</label>
                <input type="email" name="email" value="<?php echo session('old')['email'] ?? ''; ?>">
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

    <footer>
        Copyright © Your Website 2024
    </footer>
</body>
</html>
<?php
    session_start();
    $isLoggedIn = isset($_SESSION['user_id']);
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $pdo = new PDO('mysql:host=localhost;dbname=projectecf', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();

        $welcome_message = 'Bienvenue, ' . $user['username'] . '!';
    } else {
        $welcome_message = 'Bienvenue!';
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="stylesheet" href="../styling/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body>

    <div id="navbar">
        <div id="leftS">
            <a href="mainpage.php" class="logo">Quai Antique</a>
        </div>

        <div id="SmallLogo">
            <a href="mainpage.php" class="logo">QA</a>
        </div>

        <div id="rightS">
            <ul id="rightNav">
                <li><a href="menu.php">Menu</a></li>
                <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="logout.php">Deconnexion</a></p>
                    <?php else: ?>
                        <p><a href="login.php">Connexion</a></p>
                    <?php endif; ?>
                </li>
                <li><a href="reservation.php">Reservez</a></li>
                
            </ul>
        </div>
    </div>

    <p class="wlcm"><?php echo $welcome_message; ?></p>
    
</body>
</html>

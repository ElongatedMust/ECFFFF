<?php
session_start();
if (isset($_POST['submit'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=projectecf', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$_POST['email']]);
        $user = $stmt->fetch();

        /*if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            
            header('Location: mainpage.php');
            exit;
        } else {
            $error = 'Invalid email or password.';
        }*/

        if ($user && $user['is_admin']) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: admin.php');
            exit;
        } elseif ($user) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: mainpage.php');
            exit;
        } else {
            $error_message = 'Email ou mot de passe invalide.';
        }
    } catch(PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../styling/login.css">
    <meta>
    <title>Connexion</title>
</head>
<body>

    <?php
    require 'header.php';
    ?>
    <?php if (isset($error)): ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?>
    <div id="container">
        <form method="post" class="log">
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <br>
        <div>
            <label>Mot de passe:</label>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit" name="submit" class="click">Connexion</button>
        <button class="click"> <a href="register.php" class="register">Inscription</a></button>
        </form>  
    </div>
    

    <?php
        // Disable browser caching
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    ?>
</body>
</html>

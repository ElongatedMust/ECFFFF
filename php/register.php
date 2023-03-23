<?php
$errors = [];

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters long.';
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = 'Password must contain at least one uppercase letter.';
    }

    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = 'Password must contain at least one lowercase letter.';
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = 'Password must contain at least one number.';
    }

    if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
        $errors[] = 'Password must contain at least one special character.';
    }

    if (!empty($errors)) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
        echo '</div>';
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=projectecf', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $pdo->prepare('INSERT INTO users(email, username, password) VALUES (:email, :username, :password)');
            $statement->bindValue(':email', $email);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $password_hash);
            $statement->execute();        
            echo 'User registered successfully.';
            header("location:login.php");
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}


require 'header.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../styling/register.css">

</head>
<body>
    <form method="post" action="register.php">
        <div id="container">
            <div class="log">
                <div>
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                <br>
                <div>
                    <label>Nom:</label>
                    <input type="text" name="username" required>
                </div>
                <br>
                <div>
                    <label>Mot de passe:</label>
                    <input type="password" name="password" required>
                </div>
                <br>
                <button type="submit" name="submit" class="click">Inscription</button>
            </div>
        </div>
    </form>
</body>
</html>

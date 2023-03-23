<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = new PDO('mysql:host=localhost;dbname=ecff', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('INSERT INTO menu_items (name, description, price) VALUES (?, ?, ?)');
    $stmt->execute([$_POST['name'], $_POST['description'], $_POST['price']]);

    header('Location: admin.php');
    exit;
}

if (!file_exists('header.php')) {
    die('Error: Unable to load header file');
}

require 'header.php';

?>

<html>
<head>
    <title>Add Menu Item</title>
</head>
<body>
    <h1>Add Menu Item</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name"><br>

        <label>Description:</label>
        <textarea name="description"></textarea><br>

        <label>Price:</label>
        <input type="number" name="price"><br>

        <input type="submit" value="Add Item">
    </form>
</body>
</html>

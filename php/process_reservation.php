<?php
$date = $_POST['date'];
$time = $_POST['time'];
$comments = $_POST['comments'];
$pdo = new PDO('mysql:host=localhost;dbname=projectecf', 'root', '');
$stmt = $pdo->prepare('INSERT INTO reservation (date, time, comments) VALUES (?, ?, ?)');
$stmt->execute([$date, $time, $comments]);
header('Location: confirmation.php');
exit;

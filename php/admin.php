<?php
$host = "localhost";
$dbname = "projectecf";
$username = "root";
$password = "";

try {

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT id, username, email FROM users");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin</title>
    <link rel="stylesheet" href="../styling/admin.css">
</head>
<body>
   


<div class="Template">
    <div class="UserList">
        <h1>User List</h1>
            <table class="UserTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['email'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
    </div>


</div>
</body>
</html>

<?php
$conn = null;
?>

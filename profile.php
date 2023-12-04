<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admindb";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$adminUsername = $_SESSION['username'];


$sql = "SELECT * FROM adminregdb WHERE username = '$adminUsername'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $adminData = $result->fetch_assoc();
} else {
    echo "Admin not found!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>

</head>
<body>
    <?php include('header2.php'); ?>

    <h1 align="center">Admin Profile</h1>

    <div align="center">
        <p>Name: <?php echo $adminData['name']; ?></p>
        <p>Email: <?php echo $adminData['email']; ?></p>
        <p>Username: <?php echo $adminData['username']; ?></p>
        
    </div>

    <?php include('footer.php'); ?>
</body>
</html>

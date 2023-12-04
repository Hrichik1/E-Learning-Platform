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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID'], $_POST['FullName'])) {
    $mentorID = $_POST['ID'];
    $mentorName = $_POST['FullName'];

    $sql = "UPDATE mentor SET FullName = '$mentorName' WHERE ID = '$mentorID'";

    if ($conn->query($sql) === TRUE) {
        echo "Mentor updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

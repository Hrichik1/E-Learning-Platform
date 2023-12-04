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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseID = $_POST['course_id'];
    $courseName = $_POST['course_name'];
    $courseTime = $_POST['course_time'];

    $sql = "UPDATE all_courses SET Courses = '$courseName', Time = '$courseTime' WHERE ID = '$courseID'";

    if ($conn->query($sql) === TRUE) {
        echo "Live course updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
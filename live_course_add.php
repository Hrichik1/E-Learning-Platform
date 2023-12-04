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
    $courseId = $_POST['course_id'];
    $courseName = $_POST['course_name'];
    $courseTime = $_POST['course_time'];
    

    $sql = "INSERT INTO all_courses (ID,Courses, Time) VALUES ('$courseId','$courseName', '$courseTime')";

    if ($conn->query($sql) === TRUE) {
        echo "Live course added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
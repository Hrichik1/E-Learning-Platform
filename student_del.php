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

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the student ID is set in the URL
if (isset($_GET['q'])) {
    $UserName = $_GET['q'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM student_info WHERE User_Name = $User_Name");
    $stmt->bind_param("s", $studentID);

    if ($stmt->execute()) {
        // Redirect to the student page after successful deletion
        header('location: Student.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

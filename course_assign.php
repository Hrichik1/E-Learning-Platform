<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['course_id']) && isset($_GET['student_id'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "admindb";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $courseID = $_GET['course_id'];
    $studentID = $_GET['student_id'];

    $sql = "INSERT INTO student_courses (Student_ID, Course_ID) VALUES ('$studentID', '$courseID')";

    if ($conn->query($sql) === TRUE) {
        // Update the course quantity in the coursedb table after the assignment
        $updateQuantity = "UPDATE coursedb SET Quantity = Quantity - 1 WHERE Course_ID = '$courseID'";
        if ($conn->query($updateQuantity) === TRUE) {
            echo "Course assigned to the student successfully!";
        } else {
            echo "Error updating the course quantity: " . $conn->error;
        }
    } else {
        echo "Error assigning the course. Please try again.";
    }

    $conn->close();
}
?>

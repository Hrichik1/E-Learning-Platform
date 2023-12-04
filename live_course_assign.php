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

    // Check if the course is available
    $checkAvailability = "SELECT * FROM all_courses WHERE ID = '$courseID'";
    $result = $conn->query($checkAvailability);

    if ($result->num_rows > 0) {
        // Course is available, proceed with assignment
        $sql = "INSERT INTO student_courses (Student_ID, Course_ID) VALUES ('$studentID', '$courseID')";

        if ($conn->query($sql) === TRUE) {
            echo "Course assigned to the student successfully!";
        } else {
            echo "Error assigning the course. Please try again.";
        }
    } else {
        echo "Selected course is not available.";
    }

    $conn->close();
}
?>
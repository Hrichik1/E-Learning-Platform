<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
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
    // Validate and sanitize form data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $education = mysqli_real_escape_string($conn, $_POST['education']);
    // You might want to store the CV file name in the database and handle file upload separately
    // For simplicity, let's assume CV is stored as a string in the database
    $cv = "cv_filename.pdf"; // Replace with actual file handling logic
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Insert the mentor information into the database
    $sql = "INSERT INTO mentor (FullName, Username, Email, Date_of_Birth, EducationQualification, CV, Password)
            VALUES ('$fullname', '$username', '$email', '$dob', '$education', '$cv', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Mentor information added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

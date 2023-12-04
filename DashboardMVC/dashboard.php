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

// total number of mentors
$mentorQuery = "SELECT COUNT(*) AS totalMentors FROM mentor";
$mentorResult = $conn->query($mentorQuery);
$rowMentor = $mentorResult->fetch_assoc();
$totalMentors = $rowMentor['totalMentors'];

// total number of managers
$managerQuery = "SELECT COUNT(*) AS totalManagers FROM manager_info";
$managerResult = $conn->query($managerQuery);
$rowManager = $managerResult->fetch_assoc();
$totalManagers = $rowManager['totalManagers'];

// total number of students
$studentQuery = "SELECT COUNT(*) AS totalStudents FROM student_info";
$studentResult = $conn->query($studentQuery);
$rowStudent = $studentResult->fetch_assoc();
$totalStudents = $rowStudent['totalStudents'];

// total number of offered courses
$courseQuery = "SELECT COUNT(*) AS totalCourses FROM coursedb";
$courseResult = $conn->query($courseQuery);
$rowCourse = $courseResult->fetch_assoc();
$totalCourses = $rowCourse['totalCourses'];

$liveCourseQuery = "SELECT COUNT(*) AS totalLiveCourses FROM all_courses";
$liveCourseResult = $conn->query($liveCourseQuery);
$rowLiveCourse = $liveCourseResult->fetch_assoc();
$totalLiveCourses = $rowLiveCourse['totalLiveCourses'];

// Calculate the total number of courses
$totalCourses = $totalCourses + $totalLiveCourses;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa; /* Light Gray background */
            color: #495057; /* Dark Gray text */
        }

        .header {
            overflow: hidden;
            background-color: #343a40; /* Dark Gray header background */
            padding: 20px 10px;
        }

        .header a {
            float: left;
            color: white;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
        }

        .header img {
            max-width: 100px; /* Adjust the max-width as needed */
            height: auto;
        }

        .header a.logo {
            font-size: 25px;
            font-weight: bold;
        }

        .header a:hover {
            background-color: #495057; /* Dark Gray on hover */
        }

        .header a.active {
            background-color: #3081D0; /* Blue for active link */
            color: white;
        }

        .dashboard {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 50px;
        }

        .dashboard figure {
            text-align: center;
            padding: 20px;
            border: 1px solid #dee2e6; /* Light Gray border */
            border-radius: 8px;
            background-color: #ffffff; /* White background */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Light shadow */
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .dashboard figure:hover {
            background-color: #E7BCDE; /* Light Blue on hover */
        }

        .footer {
            background-color: #343a40; /* Dark Gray footer background */
            padding: 10px;
            text-align: center;
            color: white;
        }
    </style>
</head>

<body>
    <div class="header">
        <a class="logo" href="#">
            <img src="image.png" alt="Logo">
        </a>
        <a href="homepage2.php">Home</a>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="coursemng.php">Course Management</a>
        <a href="Student.php">Student</a>
        <a href="mentor.php">Mentor</a>
        <a href="payment.php">Payment</a>
        <!-- Add more navigation links as needed -->
    </div>

    <h1 align="center">Dashboard</h1>

    <div class="dashboard">
        <a href="mentor.php">
            <figure>
                <h2>Total Mentors</h2>
                <p><?php echo $totalMentors; ?></p>
            </figure>
        </a>

        <a href="Student.php">
            <figure>
                <h2>Total Students</h2>
                <p><?php echo $totalStudents; ?></p>
            </figure>
        </a>

        <a href="coursemng.php">
            <figure>
                <h2>Total Courses</h2>
                <p><?php echo $totalCourses; ?></p>
            </figure>
        </a>

        <!-- Add more figures as needed -->

    </div>

    <p><br></p>
    <p><br></p>
    <p><br></p>

    <div class="footer">
        <?php include('footer.php') ?>
    </div>
</body>

</html>

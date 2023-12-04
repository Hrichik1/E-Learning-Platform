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
            background-color: #f8f9fa;
            color: #495057;
        }

        .header {
            overflow: hidden;
            background-color: #343a40;
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
            max-width: 100px;
            height: auto;
        }

        .header a.logo {
            font-size: 25px;
            font-weight: bold;
        }

        .header a:hover {
            background-color: #495057;
        }

        .header a.active {
            background-color: #3081D0;
            color: white;
        }

        .dashboard {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 50px;
            flex-wrap: wrap;
        }

        .dashboard figure {
            text-align: center;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
            flex: 1 1 300px;
            margin: 10px;
        }

        .dashboard figure:hover {
            background-color: #E7BCDE;
            transform: scale(1.05);
        }

        .footer {
            background-color: #343a40;
            padding: 10px;
            text-align: center;
            color: white;
        }

         .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .close-btn {
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
        }
        .tooltip {
    display: none;
    position: absolute;
    background-color: #3498db; /* Blue background color */
    color: #fff; /* White text color */
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle box-shadow */
    z-index: 1;
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
        
        <a href="mentor.php" onmouseover="showTooltip('Total Mentors: <?php echo $totalMentors; ?>')" onmouseout="hideTooltip()" onclick="navigateTo('mentor.php')">
            <figure>
                <h2>Total Mentors</h2>
                <p><?php echo $totalMentors; ?></p>
            </figure>
        </a>

        <a href="Student.php" onmouseover="showTooltip('Total Students: <?php echo $totalStudents; ?>')" onmouseout="hideTooltip()" onclick="navigateTo('Student.php')">
            <figure>
                <h2>Total Students</h2>
                <p><?php echo $totalStudents; ?></p>
            </figure>
        </a>

        <a href="coursemng.php" onmouseover="showTooltip('Total Courses: <?php echo $totalCourses; ?>')" onmouseout="hideTooltip()" onclick="navigateTo('coursemng.php')">
            <figure>
                <h2>Total Courses</h2>
                <p><?php echo $totalCourses; ?></p>
            </figure>
        </a>
    </div>

    <div id="tooltip" class="tooltip"></div>

  

    <script>
        function showTooltip(content) {
            var tooltip = document.getElementById('tooltip');
            tooltip.innerHTML = content;
            tooltip.style.display = 'block';
        }

        function hideTooltip() {
            var tooltip = document.getElementById('tooltip');
            tooltip.style.display = 'none';
        }

        function navigateTo(page) {
            window.location.href = page;
        }
    </script>

    <p><br></p>
    <p><br></p>
    <p><br></p>

    <div class="footer">
        <?php include('footer.php') ?>
    </div>
</body>

</html>

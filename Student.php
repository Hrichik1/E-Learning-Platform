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

$sql = "select * from student_info";
$res = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
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
            background-color: #007bff; /* Blue for active link */
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px;
            background-color: #ffffff; /* White table background */
            border: 1px solid #dee2e6; /* Light Gray border */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Light shadow */
        }

        th, td {
            border: 1px solid #dee2e6; /* Light Gray border */
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2; /* Light Gray heading background */
        }

        .footer {
            background-color: #343a40; /* Dark Gray footer background */
            padding: 10px;
            text-align: center;
            color: white;
        }

        a.delete {
            color: #dc3545; /* Red color for delete links */
        }

        a.delete:hover {
            color: #bd2130; /* Darker Red on hover */
        }

        .selected {
            background-color: #cce5ff; /* Light Blue for selected rows */
        }
    </style>
    <script>
        function sortTable(tableId, columnIndex) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById(tableId);
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        function highlightRow(row) {
            var table = row.parentNode;
            for (var i = 1; i < table.rows.length; i++) {
                table.rows[i].classList.remove("selected");
            }
            row.classList.add("selected");
        }

        function toggleVisibility(elementId) {
            var element = document.getElementById(elementId);
            element.style.display = (element.style.display === "none") ? "block" : "none";
        }
    </script>
</head>

<body>
    <div class="header">
        <a class="logo" href="#">
            <img src="image.png" alt="Logo">
        </a>
        <a href="homepage2.php" >Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="coursemng.php">Course Management</a>
        <a href="Student.php"class="active">Student</a>
        <a href="mentor.php">Mentor</a>
        <a href="payment.php">Payment</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Log out</a>
       
    </div>
    <h1 align="center">Student Information</h1>

    <table id="tableEmp2" align="center">
        <tr>
            <th onclick="sortTable('tableEmp2', 0)">Student Name</th>
            <th onclick="sortTable('tableEmp2', 1)">User Name</th>
            <th onclick="sortTable('tableEmp2', 2)">Password</th>
            <th>Delete</th>
            <th>Assign Course</th>
        </tr>

        <?php
        while ($r = mysqli_fetch_assoc($res)) {
            echo "<tr onclick=\"highlightRow(this)\">";
            echo "<td>" . $r['Name'] . "</td>";
            echo "<td>" . $r['User_Name'] . "</td>";
            echo "<td>" . $r['Password'] . "</td>";
            echo '<td><a class="delete" href="student_del.php?q=' . $r['User_Name'] . '">Delete</a></td>';
            echo '<td><a href="Student.php?assign_course=' . $r['Student_ID'] . '">Assign Course</a></td>';
            echo "</tr>";
        }
        echo "</table>";

        if (isset($_GET['assign_course'])) {
            $studentID = $_GET['assign_course'];
        ?>
            <h2 align="center">Online Courses Information</h2>
            
            <table id="tableEmp3" align="center">
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Quantity</th>
                    <th>Assign</th>
                </tr>

                <?php
                $servername1 = "localhost";
                $username1 = "root";
                $password1 = "";
                $dbname1 = "admindb";
                $conn1 = new mysqli($servername1, $username1, $password1, $dbname1);

                $sql1 = "select * from coursedb";
                $res1 = mysqli_query($conn1, $sql1);

                while ($y = mysqli_fetch_assoc($res1)) {
                    echo "<tr>";
                    echo "<td>" . $y['Course_ID'] . "</td>";
                    echo "<td>" . $y['Course_Name'] . "</td>";
                    echo "<td>" . $y['Quantity'] . "</td>";
                    echo '<td><a href="course_assign.php?course_id=' . $y['Course_ID'] . '&student_id=' . $studentID . '">Assign</a></td>';
                    echo "</tr>";
                }
                echo "</table>";

                echo "<h2 align='center'>Live Courses Information</h2>";
                echo "<table id='tableEmp4' align='center'>";
                echo "<tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Time</th>
                        <th>Assign</th>
                    </tr>";

                $sql2 = "select * from all_courses";
                $res2 = mysqli_query($conn1, $sql2);

                while ($z = mysqli_fetch_assoc($res2)) {
                    echo "<tr>";
                    echo "<td>" . $z['ID'] . "</td>";
                    echo "<td>" . $z['Courses'] . "</td>";
                    echo "<td>" . $z['Time'] . "</td>";
                    echo '<td><a href="live_course_assign.php?course_id=' . $z['ID'] . '&student_id=' . $studentID . '">Assign</a></td>';
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
    </body>

    <p><br></p>
    <p><br></p>
    <p><br></p>

    <div class="footer">
        <?php include('footer.php') ?>
    </div>

    </html>

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

$sql = "SELECT * FROM coursedb";
$res = mysqli_query($conn, $sql);

$sql1 = "SELECT * FROM all_courses";
$res1 = mysqli_query($conn, $sql1);

$totalCourses = mysqli_num_rows($res) + mysqli_num_rows($res1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Overview</title>
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

        .table-container {
            overflow-x: auto;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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

        .total-courses {
            margin-top: 20px;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function highlightRow(row) {
                row.style.backgroundColor = "#f0f8ff"; /* Light Blue color on hover */
            }

            function removeHighlight(row) {
                row.style.backgroundColor = "";
            }

            function attachEventListeners() {
                const rowsPaidCourses = document.querySelectorAll("#tablePaidCourses tbody tr");
                const rowsLiveCourses = document.querySelectorAll("#tableLiveCourses tbody tr");

                function addMouseEvents(rows) {
                    rows.forEach(row => {
                        row.addEventListener("mouseover", function () {
                            highlightRow(row);
                        });

                        row.addEventListener("mouseout", function () {
                            removeHighlight(row);
                        });
                    });
                }

                addMouseEvents(rowsPaidCourses);
                addMouseEvents(rowsLiveCourses);
            }

            attachEventListeners();

            function confirmDelete() {
                return confirm("Are you sure you want to delete this item?");
            }

            function attachDeleteConfirmation() {
                const deleteLinks = document.querySelectorAll("a.delete");

                deleteLinks.forEach(link => {
                    link.addEventListener("click", function (event) {
                        if (!confirmDelete()) {
                            event.preventDefault();
                        }
                    });
                });
            }

            attachDeleteConfirmation();
        });
    </script>
</head>

<body>
    <div class="header">
        <a class="logo" href="#">
            <img src="image.png" alt="Logo">
        </a>
        <a href="homepage2.php" >Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="coursemng.php"class="active">Course Management</a>
        <a href="Student.php">Student</a>
        <a href="mentor.php">Mentor</a>
        <a href="payment.php">Payment</a>
        <!-- Add more navigation links as needed -->
    </div>

    <div align="center">
        <h1 align="left">Online Courses</h1>
        <div class="table-container">
            <table id="tablePaidCourses">
                <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Price</th>
                    <th>Link</th>
                    <th>Quantity</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Add</th>
                </tr>

                <?php
                while ($r = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>{$r['Course_ID']}</td>";
                    echo "<td>{$r['Course_Name']}</td>";
                    echo "<td>{$r['Pice']}</td>";
                    echo '<td><a href="purchase.php?q=' . $r['Course_ID'] . '">Purchase</a></td>';
                    echo "<td>{$r['Quantity']}</td>";
                    echo '<td><a href="edit.php?q=' . $r['Course_ID'] . '">Edit</a></td>';
                    echo '<td><a class="delete" href="delete.php?q=' . $r['Course_ID'] . '">Delete</a></td>';
                    echo '<td><a href="add_course.php?q=' . $r['Course_ID'] . '">Add</a></td>';
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <div align="center">
        <h1 align="left">Live Courses</h1>
        <div class="table-container">
            <table id="tableLiveCourses">
                <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Time</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Add</th>
                </tr>

                <?php
                while ($r = mysqli_fetch_assoc($res1)) {
                    echo "<tr>";
                    echo "<td>{$r['ID']}</td>";
                    echo "<td>{$r['Courses']}</td>";
                    echo "<td>{$r['Time']}</td>";
                    echo '<td><a href="live_edit_form.php?q=' . $r['ID'] . '">Edit</a></td>';
                    echo '<td><a class="delete" href="live_del.php?q=' . $r['ID'] . '">Delete</a></td>';
                    echo '<td><a href="live_add_process.php?q=' . $r['ID'] . '">Add</a></td>';
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <div class="total-courses" align="center">
        <h1>Total Courses: <?php echo $totalCourses; ?></h1>
    </div>

    <div class="footer">
        <?php include('footer.php') ?>
    </div>
</body>
</html>

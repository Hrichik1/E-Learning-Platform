<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Live Course</title>
</head>
<body>

    <h1>Edit Live Course</h1>

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

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['q'])) {
        $courseID = $_GET['q'];

        $sql = "SELECT * FROM all_courses WHERE ID = '$courseID'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <form action="live_edit.php" method="post">
                Course ID: <input type="text" name="course_id" value="<?php echo $row['ID']; ?>" readonly><br><br>
                Course Name: <input type="text" name="course_name" value="<?php echo $row['Courses']; ?>"><br><br>
                Time: <input type="text" name="course_time" value="<?php echo $row['Time']; ?>"><br><br>
                <input type="submit" value="Update Live Course">
            </form>
    <?php
        } else {
            echo "Live Course not found.";
        }
    }

    $conn->close();
    ?>

</body>
</html>
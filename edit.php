<!DOCTYPE html>
<html>
<head>
    <title>Edit Course Information</title>
</head>
<body>

    <h1>Edit Course Information</h1>

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

        $sql = "SELECT * FROM coursedb WHERE Course_ID = '$courseID'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <form action="process_edit_course.php" method="post">
                Course ID: <input type="text" name="course_id" value="<?php echo $row['Course_ID']; ?>" ><br><br>
                
                Course Name: <input type="text" name="course_name" value="<?php echo $row['Course_Name']; ?>"><br><br>
                
                Price: <input type="text" name="price" value="<?php echo $row['Pice']; ?>"><br><br>
                
                Quantity: <input type="text" name="quantity" value="<?php echo $row['Quantity']; ?>"><br><br>

                Link: <input type="text" name="link" value="<?php echo $row['Link']; ?>"><br><br>
                
                <input type="submit" value="Update Paid Course">
            </form>
    <?php
        } else {
            echo "Course not found.";
        }
    }

    $conn->close();
    ?>
</body>
</html>

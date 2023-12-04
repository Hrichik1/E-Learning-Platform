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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $mentorID = $_GET['id'];

    $sql = "SELECT * FROM mentor WHERE ID = '$mentorID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $mentor = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mentor</title>
</head>
<body>

    <h1>Edit Mentor Information</h1>

    <form action="process_edit_mentor.php" method="post">
        Mentor ID: <input type="text" name="ID" value="<?php echo $mentor['ID']; ?>" readonly><br><br>
        Mentor Name: <input type="text" name="FullName" value="<?php echo isset($mentor['FullName']) ? $mentor['FullName'] : ''; ?>" required><br><br>
        <input type="submit" value="Update Mentor">
    </form>

</body>
</html>

<?php
    } else {
        echo "Mentor not found.";
    }
}

$conn->close();
?>

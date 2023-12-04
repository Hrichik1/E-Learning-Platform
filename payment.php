<?php include('header2.php') ?>
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

$sql = "SELECT User_Name, Payment, Due FROM payment_list";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
</head>
<body>

    <h1 align="center">Payment Information</h1>

    <table align="center" border="1">
        <tr>
            <th>User Name</th>
            <th>Payment</th>
            <th>Due</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['User_Name'] . "</td>";
            echo "<td>" . $row['Payment'] . "</td>";
            echo "<td>" . $row['Due'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
$conn->close();
?>
<?php include('footer.php') ?>
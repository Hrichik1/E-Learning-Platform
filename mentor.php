
<?php
session_start();

if (isset($_SESSION['username'])) {
   
} else {
    header('location: login.php');
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admindb";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sqlMentor = "SELECT * FROM mentor";
$resultMentor = mysqli_query($conn, $sqlMentor);


$sqlManager = "SELECT * FROM manager_info";
$resultManager = mysqli_query($conn, $sqlManager);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mentor and Manager Page</title>

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
    transition: background-color 0.3s ease;
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
}

.dashboard figure {
    text-align: center;
    padding: 20px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

.dashboard figure:hover {
    background-color: #E7BCDE;
}

.footer {
    background-color: #343a40;
    padding: 10px;
    text-align: center;
    color: white;
}

.container {
    text-align: center;
    margin: 20px;
}

.mentor-section,
.manager-section {
    width: 48%;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    display: inline-block;
    transition: transform 0.3s ease-in-out;
}

.mentor-section:hover,
.manager-section:hover {
    transform: scale(1.08);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th,
td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

th {
    background-color: #343a40;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

form {
    margin-top: 20px;
}

form label {
    display: block;
    margin-bottom: 8px;
}

form input {
    width: 100%;
    padding: 12px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    padding: 10px;
    transition: background-color 0.3s ease;
}

form input[type="submit"]:hover {
    background-color: #45a049;
}

h2 {
    color: #495057;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

    </style>

    <script>
        function redirectToMentorPage() {
            window.location.href = "mentor_info_page.php";
        }
    </script>
</head>
<body>
    <div class="header">
        <a class="logo" href="#">
            <img src="image.png" alt="Logo">
        </a>
        <a href="homepage2.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="coursemng.php">Course Management</a>
        <a href="Student.php">Student</a>
        <a href="mentor.php" class="active">Mentor</a>
        <a href="payment.php">Payment</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Log out</a>
       
    </div>

    <div class="container">
        <div class="mentor-section">
            <h1>Mentor Information</h1>

           <table id="tableMentor" border="1" style="padding: 15px;">
    <tr>
        <th>ID</th>
        <th>FullName</th>
        <th>Username</th>
        <th>Email</th>
        <th>Date of Birth</th>
        <th>Education Qualification</th>
        <th>CV</th>
        <th>Password</th>
        <th>Options</th>
    </tr>

    <?php
    while ($mentorRow = mysqli_fetch_assoc($resultMentor)) {
        echo "<tr>";
        echo "<td>{$mentorRow['ID']}</td>";
        echo "<td>{$mentorRow['FullName']}</td>";
        echo "<td>{$mentorRow['Username']}</td>";
        echo "<td>{$mentorRow['Email']}</td>";
        echo "<td>{$mentorRow['Date_of_Birth']}</td>";
        echo "<td>{$mentorRow['EducationQualification']}</td>";
        echo "<td>{$mentorRow['CV']}</td>";
        echo "<td>{$mentorRow['Password']}</td>";
        echo "<td>";
        echo "<a href='edit_mentor.php?id={$mentorRow['ID']}'>Edit</a> | ";
        echo "<a href='delete_mentor.php?id={$mentorRow['ID']}'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

            
            <form action="#" onsubmit="redirectToMentorPage(); return false;">
                <h2>Add Mentor</h2>
                <button type="submit">Add Mentor</button>
            </form>
        
        </div>
        <div class="manager-section">
            <h1>Manager Information</h1>

            <table id="tableManager" border="1" style="padding: 15px;">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Dob</th>
                    <th>Gender</th>
                </tr>

                <?php
                while ($managerRow = mysqli_fetch_assoc($resultManager)) {
                    echo "<tr>";
                    echo "<td>{$managerRow['Name']}</td>";
                    echo "<td>{$managerRow['Email']}</td>";
                    echo "<td>{$managerRow['User_Name']}</td>";
                    echo "<td>{$managerRow['Password']}</td>";
                    echo "<td>{$managerRow['Dob']}</td>";
                    echo "<td>{$managerRow['Gender']}</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <?php $conn->close(); ?>

    <?php include('footer.php') ?>
</
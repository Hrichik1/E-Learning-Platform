<?php
// Start the session at the very beginning of your script
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admindb";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$adminUsername = $_SESSION['username'];

// Check if the form is submitted for picture upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile-picture"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile-picture"]["name"]);
    move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $target_file);

    // Update the database with the file path
    $updateSql = "UPDATE adminregdb SET profile_picture = '$target_file' WHERE username = '$adminUsername'";
    $conn->query($updateSql);
}

// Retrieve admin data including the uploaded picture
$sql = "SELECT * FROM adminregdb WHERE username = '$adminUsername'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $adminData = $result->fetch_assoc();
} else {
    echo "Admin not found!";
}

// Retrieve admin information for the table
$infoSql = "SELECT name, email, username, profile_picture FROM adminregdb WHERE username = '$adminUsername'";
$infoResult = $conn->query($infoSql);

if ($infoResult->num_rows > 0) {
    $infoData = $infoResult->fetch_assoc();
} else {
    echo "Admin information not found!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
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
            color: white;
            text-align: center;
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

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff; /* White container background */
            border: 1px solid #dee2e6; /* Light Gray border */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Light shadow */
            text-align: center;
        }

        h1 {
            color: #343a40; /* Dark Gray heading color */
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #495057; /* Dark Gray text */
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        button {
            background-color: #007bff; /* Blue button background */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Light shadow */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Add any additional styles here */
    </style>
</head>
<body>
    <div class="header">
        <a class="logo" href="#">
            <img src="image.png" alt="Logo">
        </a>
        <a href="homepage2.php" >Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="coursemng.php">Course Management</a>
        <a href="Student.php">Student</a>
        <a href="mentor.php">Mentor</a>
        <a href="payment.php">Payment</a>
        <a href="profile.php"class="active">Profile</a>
        <a href="logout.php">Log out</a>
    </div>

    <div class="container">
        <h1>Admin Profile</h1>

        <p>Name: <?php echo $adminData['name']; ?></p>
        <p>Email: <?php echo $adminData['email']; ?></p>
        <p>Username: <?php echo $adminData['username']; ?></p>

        <!-- Picture upload section -->
        <form method="post" enctype="multipart/form-data">
            <label for="profile-picture">Profile Picture:</label>
            <input type="file" name="profile-picture" id="profile-picture" accept="image/*">
            <br>
            <button type="submit">Upload</button>
        </form>

        <!-- Table to display admin information -->
        <table class="container">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Profile Picture</th>
            </tr>
            <tr>
                <td><?php echo $infoData['name']; ?></td>
                <td><?php echo $infoData['email']; ?></td>
                <td><?php echo $infoData['username']; ?></td>
                <td>
                    <?php if (!empty($infoData['profile_picture'])): ?>
                        <img src="<?php echo $infoData['profile_picture']; ?>" alt="Profile Picture">
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>

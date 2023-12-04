
<?php 

session_start();

if(isset($_SESSION['username'])){

}
else{

    header('location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: right;
        }

        nav {
            float: left;
            width: 200px;
            background-color: #333;
            padding: 15px;
            color: white;
            height: 100vh;
            position: fixed;
        }

        nav a {
            display: block;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }

        hr {
            border: 1px solid #333;
        }

        img {
            width: 200px;
            height: 200px;
            display: block;
            margin: auto;
        }
    </style>

    <script>
        
        function showMessage() {
            alert('Hello! This is My JavaScript function.');
        }
    </script>
</head>

<body>
    <?php
    echo '
    
    <header>
        <a href="profile.php" style="font-size:18px; margin-right: 20px;">My Profile</a>
        <a href="logout.php" style="font-size:18px;">Log Out</a>
    </header>
    <nav>
        <img src="image.png" alt="Logo">
        <a href="homepage2.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="coursemng.php">Course Management</a>
        <a href="Student.php">Student</a>
        <a href="mentor.php">Mentor</a>
        <a href="payment.php">Payment</a>
        <a href="profile.php">Profile</a>
    </nav>
    <div class="content">
        <hr/>
        <!-- My page content goes here -->
        <h1>Welcome to My Page</h1>
        <button onclick="showMessage()">Click me</button>
    </div>
    ';
    ?>
</body>

</html>

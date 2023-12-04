<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log out</title>
</head>
<body>

    <?php
    session_start();

   
    if (isset($_SESSION['username'])) {
        
        $adminName = $_SESSION['username'];

        
        echo "<p>{$adminName}, you are logged out.</p>";

        
        echo '<a href="homepage.php">Go to Homepage</a>';
    } else {
        
        header('Location: homepage.php');
        exit;
    }
    ?>

</body>
</html>

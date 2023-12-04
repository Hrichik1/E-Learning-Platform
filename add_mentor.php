<?php
// Include database connection code here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mentorName = $_POST['mentor_name'];

   
    header('Location: mentor.php');
    exit;
}
?>

<?php
session_start();

if (!isset($_SESSION['username'])) {
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
            background-color: #343a40;
            color: white;
            padding: 15px;
            text-align: right;
        }

        nav {
            float: left;
            width: 200px;
            background-color: #343a40;
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
            transition: background-color 0.3s ease;
            text-align: center;
        }

        hr {
            border: 1px solid #343a40;
            margin-bottom: 20px;
        }

        img {
            width: 200px;
            height: 200px;
            display: block;
            margin: auto;
            border-radius: 50%;
        }

        .welcome-message {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        .clock-container {
            font-size: 36px;
            color: #343a40;
            margin-bottom: 20px;
        }

        .gallery-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 10px;
        }

        .gallery-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-image:hover {
            transform: scale(1.1);
        }

        .links-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .link-box {
            width: 150px;
            padding: 10px;
            border: 1px solid #007bff;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .link-box:hover {
            background-color: #007bff;
            color: white;
        }
    </style>

    <script>
        function showMessage() {
            alert('Hello! This is My JavaScript function.');
        }

        function changeBackgroundColor() {
            var content = document.querySelector('.content');
            content.style.backgroundColor = getRandomColor();
        }

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        function showClock() {
            var clockContainer = document.querySelector('.clock-container');
            var currentTime = new Date().toLocaleTimeString();
            clockContainer.textContent = currentTime;
        }

        function createImageGallery() {
            var galleryContainer = document.querySelector('.gallery-container');
            var imageUrls = [
                'image1.jpg',
                'image2.jpg',
                'image3.jpg',
                // Add more image URLs as needed
            ];

            imageUrls.forEach(function (url) {
                var imageElement = document.createElement('img');
                imageElement.src = url;
                imageElement.alt = 'Gallery Image';
                imageElement.className = 'gallery-image';
                imageElement.addEventListener('click', function () {
                    alert('You clicked on an image!');
                });
                galleryContainer.appendChild(imageElement);
            });
        }

        function openUdemy() {
            window.location.href = 'https://www.udemy.com/';
        }

        function openGitHub() {
            window.location.href = 'https://github.com/';
        }

        function openLinkedIn() {
            window.location.href = 'https://www.linkedin.com/';
        }
    </script>
</head>

<body>
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
        <hr />
        <h1 class="welcome-message">Welcome to My Page</h1>
        <div class="button-container">
            <button onclick="showMessage()">Click me</button>
            <button onclick="changeBackgroundColor()">Change Color</button>
        </div>
        <div class="clock-container" onload="setInterval(showClock, 1000)"></div>
        <div class="gallery-container">
            <script>
                createImageGallery();
            </script>
        </div>
        <div class="links-container">
            <div class="link-box" onclick="openUdemy()">
                <p>Udemy</p>
            </div>
            <div class="link-box" onclick="openGitHub()">
                <p>GitHub</p>
            </div>
            <div class="link-box" onclick="openLinkedIn()">
                <p>LinkedIn</p>
            </div>
        </div>
    </div>
</body>

</html>

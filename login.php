<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 50px auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-bottom: 0;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #9c3046;
        }

        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "admindb";
    $conn = new mysqli($servername, $username, $password, $dbname);
    ?>

    <?php include('header.php'); ?>

    <?php
    $flag = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userName = $_REQUEST['username'];
        $pass = $_REQUEST['password'];
        $sql = "select * from adminregdb where username='$userName' and pass='$pass'";
        $res = mysqli_query($conn, $sql);

        if ($res->num_rows > 0) {
            while ($r = mysqli_fetch_assoc($res)) {
                $_SESSION['username'] = $_REQUEST['username'];
                $_SESSION['password'] = $_REQUEST['password'];

                if (!empty($_POST["remember"])) {
                    setcookie("username", $_POST["username"], time() + 1000);
                    setcookie("password", $_POST["password"], time() + 1000);
                    echo "<h1>Cookies Set Successfully</h1>";
                } else {
                    setcookie("username", "");
                    setcookie("password", "");
                    echo "<h1>Cookies Not Set</h1>";
                }

                header('location:../Admin/homepage2.php');
            }
        } else {
            echo '<h2 class="error-message" align="center">Error Username or Password, login failed</h2>';
        }
    }
    ?>

    <center>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            
            <h1>Sign In</h1>
            <label for="username">User Name:</label>
            <input type="text" name="username" value="<?php if (isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" required>

            <label for="password">Password:</label>
            <input type="password" name="password" value="<?php if (isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" required>

            <input type="checkbox" id="remember" name="remember" value="remember">
            <label for="remember"> Remember me</label>

            <br><br>

            <input type="submit" value="Login">
        </form>
    </center>

    <?php include('footer.php') ?>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mentor Information Page</title>

    
</head>
<body>
    <h1>Mentor Information</h1>

    <form action="process_mentor.php" method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" required><br>

        <label for="education">Education Qualification:</label>
        <input type="text" name="education" required><br>

        <label for="cv">CV:</label>
        <input type="file" name="cv" accept=".pdf, .doc, .docx" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Submit">
    </form>

</body>
</html>

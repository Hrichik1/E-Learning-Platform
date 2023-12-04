<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
</head>
<body>

    <h1>Add New Course</h1>

    <form action="process_add_course.php" method="post">
        Course ID: <input type="text" name="course_id"><br><br>
        Course Name: <input type="text" name="course_name"><br><br>
        Price: <input type="text" name="price"><br><br>
        Course Link: <input type="text" name="link"><br><br>
        Quantity: <input type="text" name="quantity"><br><br>
        <input type="submit" value="Add Course">
    </form>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV Upload Page</title>
</head>
<body>
    <h1>Upload CV</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["cv"])) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["cv"]["name"]);
        $uploadOk = 1;
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is a PDF
        if ($pdfFileType != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, the file already exists.";
            $uploadOk = 0;
        }

        // Check file size (adjust as needed)
        if ($_FILES["cv"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Upload the file if all checks pass
        if ($uploadOk) {
            if (move_uploaded_file($_FILES["cv"]["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($_FILES["cv"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    ?>

    <form action="#" method="post" enctype="multipart/form-data">
        <label for="cv">Choose PDF CV:</label>
        <input type="file" name="cv" id="cv" accept=".pdf" required>
        <br>
        <input type="submit" value="Upload CV">
    </form>
</body>
</html>

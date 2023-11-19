<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Text File</title>
</head>
<body>
    <form action="upload_new_text.php" method="post" enctype="multipart/form-data">
        Select Text File:
         <input type="file" name="textFile" accept=".txt" required><br>

        <input type="submit" value="Upload">
    </form>
</body>
</html>

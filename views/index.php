<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSV File Upload</title>
</head>

<body>
    <h1>CSV File Upload</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="csvFile" accept=".csv">
        <input type="submit" value="Upload">
    </form>
</body>

</html>
<?php

session_start();

$title = "About PHP";

include_once("_includes/database-connection.php");
include_once("_includes/global-functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>

<body>

    <h1>Ladda upp en fil</h1>

    <form action="handleUpload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="fileToUpload" />
        <button type="submit">Upload</button>
    </form>

</form>
    <?php
    include "_includes/header.php";
    ?>

    <h1><?php echo "Hello world"; ?></h1>

    <?php
    include "_includes/footer.php";
    ?>


</body>

</html>
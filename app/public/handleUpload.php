<?php

// var_dump($_FILES);
include_once("_includes/database-connection.php");

// platsen där vi ska spara filen
$target_dir = "uploads/";

// filen som ska sparas
$fileToUpload = $_FILES["file"]["name"];

// full path blir
$fullPath = $target_dir . $fileToUpload; // /uploads/runbox_invoice.pdf

echo "You want to upload " . $fileToUpload . " to " . $fullPath;

$succesfullUpload = move_uploaded_file($_FILES["file"]["tmp_name"], $fullPath);

if ($succesfullUpload) {
    echo "<p>This was a success!</p>";

    $stmt = $pdo->prepare("INSERT INTO Files (filename, filepath, size) VALUES (:filename, :filepath, :size)");
    $stmt->bindParam(':filename', $_FILES["file"]["name"]);
    $stmt->bindParam(':filepath', $fullPath);
    $stmt->bindParam(':size', $_FILES["file"]["size"]);

    $sqlResult = $stmt->execute();

    if ($sqlResult) {
        echo "<p>Successfull insertion into table 'Files'</p>";
    }
}

?>
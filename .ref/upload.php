<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Attempt to upload file
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

        // Database connection using PDO
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=database', 'db_learn', 'db_password');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("INSERT INTO files (filename, filepath, size) VALUES (:filename, :filepath, :size)");
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':filepath', $filepath);
            $stmt->bindParam(':size', $size);

            // Insert file details
            $filename = basename($_FILES["fileToUpload"]["name"]);
            $filepath = $target_file;
            $size = $_FILES["fileToUpload"]["size"];
            $stmt->execute();

            echo "New record created successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

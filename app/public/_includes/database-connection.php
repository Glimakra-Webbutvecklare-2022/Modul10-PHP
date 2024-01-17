<?php

// credentials
$servername = "mysql";
$database = "db_lecture";
$username = "db_user";
$password = "db_password";

// data source name
$dsn = "mysql:host=$servername;dbname=$database";

try {

    // connect to database
    $pdo = new PDO($dsn, $username, $password);

    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    echo "<p>Connected successfully</p>";


    // SQL to create table if it does not exist
    $sql = "CREATE TABLE IF NOT EXISTS Files (
        id INT AUTO_INCREMENT PRIMARY KEY,
        filename VARCHAR(255) NOT NULL,
        filepath VARCHAR(255) NOT NULL,
        size INT NOT NULL,
        uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    // Execute query
    $pdo->exec($sql);
    echo "<p>Table 'Files' checked/created successfully</p>";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
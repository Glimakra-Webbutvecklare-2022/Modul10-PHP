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
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
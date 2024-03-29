<?php 

    // se till att sessioner används på sidan
    session_start();
        
    include_once("_includes/database-connection.php");
    include_once("_includes/global-functions.php");
    
    setup_user($pdo);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <?php

    include "_includes/header.php";

    ?>

    <h1>Login</h1>
    <form action="" method="post">
        <label for="username">Username: </label>
        <input type="text" name="username" id="username">

        <label for="password">Password: </label>
        <input type="password" name="password" id="password">
        
        <button type="submit">Login</button>
    </form>

    <?php 
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // get user data from form
        $form_username = $_POST['username'];
        $form_password = $_POST['password'];

        // send to database
        $sql_statement = "SELECT * FROM `user` WHERE `username` = '$form_username'";

        try {
            $result = $pdo->query($sql_statement);
            
            $user = $result->fetch();
            
            // no user found with these credentials
            if (!$user) {
                header("location: login.php");
                exit();
            }

            $is_correct_password = password_verify($form_password, $user['password']);
            if (!$is_correct_password) {
                header("location: login.php");
                exit();
            }


            // när rätt lösenord är angivet är användaren känd
            // skapa sessionsvariabler som kan användas 
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['user_id'];


            // redirect to start page
            header("location: index.php");
        } catch (PDOException $err) {
            echo "There was a problem: " . $err->getMessage(); 
        }

     }

    ?>

    <?php
    include "_includes/footer.php";
    ?>
</body>
</html>

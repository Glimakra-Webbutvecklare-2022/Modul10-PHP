<?php
    // kan kommunicera med databasen m.h.a $pdo
    include_once("_includes/database-connection.php");

    try {
        // Kontrollera om php scriptet körs på grund av en HTTP POST request
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Få tag på användarens input
            $username = $_POST["username"];
            $password = $_POST["password"];

            // fråga databasen om användarnamnet är upptaget
            // Vi behöver alltså skriva en sql query
            $stmt = $pdo->prepare("SELECT id, username, password FROM Users WHERE username = :username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();

            
            // Kontrolla om användaren finns
            if ($stmt->rowCount() > 0) {

                // Hämta användaren
                $user = $stmt->fetch();
                
                // kontrollera lösenord
                if (password_verify($password, $user["password"])) {
                    
                    // Släpp in användaren
                    $_SESSION['loggedin'] = true;
                    $_SESSION['userid'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
        
                    header("Location: dashboard.php");
                    exit;
                }

            }
        }
    } catch (PDOException $e) {
        echo "Error" . $e->getMessage();
    }
?>

<h1>Login</h1>
<form action="login.php" method="post">
    username: <input type="text" name="username" placeholder="Your username"/>
    password: <input type="password" name="password" placeholder="Your password"/>
    <button type="submit">Login</button>
</form>
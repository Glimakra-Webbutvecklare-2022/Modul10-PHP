<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

echo "<h1>Welcome to the Dashboard, " . $_SESSION['username'] . "!</h1>";
echo "<p>This is protected content only for logged-in users.</p>";
echo "<a href='logout.php'>Logout</a>";
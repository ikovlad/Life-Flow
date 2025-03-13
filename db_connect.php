<?php
// Show all errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";      // or whatever your host is
$username   = "root";          // or your MySQL username
$password   = "";              // or your MySQL password
$dbname     = "life_flow";    // the name of the DB that has your `users` table

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


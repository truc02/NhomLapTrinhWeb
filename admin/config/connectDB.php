<?php
// db.php - Database connection file

$servername = "localhost";
$dbUsername = "root@localhost";
$dbPassword = "";   
$dbname = "mywebsql";

// Create a connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if($conn){
    mysqli_query($conn, "SET name ");
}


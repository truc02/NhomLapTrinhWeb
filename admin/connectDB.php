<?php
$server = "localhost:3366";
$user = "root";
$password = "";
$database = "mydatabase";

// Kết nối tới cơ sở dữ liệu
$conn = new mysqli($server, $user, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


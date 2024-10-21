<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "user";

// Kết nối tới cơ sở dữ liệu
$conn = new mysqli($server, $user, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
  echo "Connected successfully";
}
$conn->close();


<?php
include ('../admin/connectDB.php');

$sql = 'SELECT * FROM film';
$result = $conn->query($sql);
$films = array();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
       $films[] = $row;
    }
}

foreach ($films as $film) { 
    echo "ID: " . $film['Film_id'] . "<br>";
    echo "Tên phim: " . $film['Name'] . "<br>";
    echo "Thể loại: " . $film['Title'] . "<br>";  
    echo "Nguồn gốc: " . $film['Origin'] . "<br>";
    echo "Mô tả: " . $film['Description'] . "<br>";
    echo "<hr>";
}

// Đóng kết nối
$conn->close();
?>

<?php
    $mysqli = new mysqli("localhost","root","","mywebsql");
    
    if($mysqli->connect_error){
        echo "Ket noi mysql loi." . $mysqli->connect_errno;
        exit();
    }

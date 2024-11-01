<?php
    //bat dau mot phien 
    session_start();

    include('../admin/connectDB.php'); 

    // chuan hoa du lieu dau vao
    function validateInput($data){
        global $conn; // Thêm global để sử dụng biến $conn
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return mysqli_real_escape_string($conn, $data); // Thêm mysqli_real_escape_string để tránh SQL injection
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            $registerName = validateInput($_POST['registerName'] ?? '');
            $registerUsername = validateInput($_POST['registerUsername'] ?? '');
            $registerEmail = validateInput($_POST['registerEmail'] ?? '');
            $registerPassword = validateInput($_POST['registerPassword'] ?? ''); 
            $registerRepeatPassword = validateInput($_POST['registerRepeatPassword'] ?? ''); 
            
            if(empty($registerUsername) || empty($registerName) || empty($registerEmail) ||
                empty($registerPassword) || empty($registerRepeatPassword)){
                    throw new Exception("Vui lòng điền đầy đủ thông tin");
            }

            // Kiểm tra password và repeat password có khớp nhau không
            if($registerPassword !== $registerRepeatPassword) {
                throw new Exception("Mật khẩu nhập lại không khớp");
            }

            if(!filter_var($registerEmail, FILTER_VALIDATE_EMAIL)){
                throw new Exception("Email không hợp lệ");
            }

            // Kiểm tra độ dài username
            if(strlen($registerUsername) < 4 || strlen($registerUsername) > 20) {
                throw new Exception("Username phải từ 4-20 ký tự");
            }

            // Kiểm tra độ dài password
            if(strlen($registerPassword) < 6) {
                throw new Exception("Mật khẩu phải có ít nhất 6 ký tự");
            }

            $checkUser = mysqli_query($conn, "SELECT username FROM user WHERE username = '$registerUsername'");
            if(mysqli_num_rows($checkUser) > 0){
                throw new Exception("Username đã tồn tại");
            }

            $checkEmail = mysqli_query($conn, "SELECT makh FROM user WHERE email = '$registerEmail'");
            if(mysqli_num_rows($checkEmail) > 0){
                throw new Exception("Email đã tồn tại");
            }

            // Tạo userId
            do {
                $userId = random_int(100, 1000);
                $checkId = mysqli_query($conn, "SELECT makh FROM user WHERE makh = '$userId'");
            } while(mysqli_num_rows($checkId) > 0);
            
            $hashedPassword = password_hash($registerPassword, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user (makh, tenkh, username, pass, email) 
                    VALUES ('$userId', '$registerName', '$registerUsername', '$hashedPassword','$registerEmail',)";

            if(mysqli_query($conn, $sql)){
                $_SESSION['success'] = "Đăng ký thành công!";
                header("Location: login.php"); // Thêm chuyển hướng đến trang login
                exit();
            } else{
                throw new Exception("Lỗi: " . mysqli_error($conn));
            }
        }   
        catch (Exception $e){
            error_log("Register Error: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage(); // Lưu lỗi vào session
            $_SESSION['old_input'] = [ // Lưu lại dữ liệu đã nhập
                'name' => $registerName,
                'username' => $registerUsername,
                'email' => $registerEmail
            ];
            header("Location: register.php"); // Chuyển hướng lại trang đăng ký
            exit();
        }
    }


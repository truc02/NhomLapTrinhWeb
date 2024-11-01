<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Website Film</title>
    <meta name="description" content="Website xem phim trực tuyến">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSS Links -->
    <link rel="stylesheet" href="../FormCss/background.css">
    <link rel="stylesheet" href="../FormCss/navFilm.css">
    <link rel="stylesheet" href="../FormCss/listFilm.css">
    <link rel="stylesheet" href="../FormCss/footer.css">
    <link rel="stylesheet" href="../FormCss/header.css">
    <link rel="stylesheet" href="../FormCss/bandner.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="icon" href="../images/favicon.png" type="image/png">

    <style>
        /* Card Film Style */
        .movie-card {
            transition: transform 0.3s ease;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .movie-card:hover {
            transform: translateY(-5px);
        }

        .card-img-top {
            height: 400px;
            object-fit: cover;
        }

        .category-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0,0,0,0.7);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
        }

        .movie-title {
            font-size: 1.2rem;
            margin: 10px 0;
            font-weight: bold;
        }

        .btn-watch {
            background-color: #e71a0f;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .btn-watch:hover {
            background-color: #c41810;
            transform: scale(1.02);
        }

        /* Phim Section Style */
        .listFilm {
            padding: 20px 0;
            margin-bottom: 30px;
        }

        .btn-PHIM {
            font-size: 24px;
            font-weight: bold;
            margin-right: 20px;
        }

        .btn-dangchieu, .btn-sapchieu {
            border: 1px solid #ddd;
            margin-right: 10px;
            padding: 8px 20px;
        }

        .btn-dangchieu:hover, .btn-sapchieu:hover {
            background-color: #e71a0f;
            color: white;
        }

        /* Carousel Style */
        .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="imageLogo">
            <img src="../images/logo_lovisong.png" alt="Logo Website">
        </div>

        <div class="menu">
            <button class="btn btn-muave">Mua vé</button>
            <button class="btn btn-phim">Phim</button>
            <button class="btn btn-gocdienanh">Góc điện ảnh</button>
            <button class="btn btn-sukien">Sự kiện</button>
            <button class="btn btn-rap">Rạp/Giá vé</button>
            <button class="btn btn-log" onclick="return login()">Đăng nhập</button>
        </div>
    </div>

    <!-- Banner Carousel -->
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
        </div>
        
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/doraemon.png" alt="Phim mới" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="../images/slider2.jpg" alt="Khuyến mãi" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="../images/slider3.jpg" alt="Sự kiện" class="d-block w-100">
            </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Movie Section -->
    <div class="container">
        <div class="listFilm">
            <button class="btn btn-PHIM">PHIM</button>
            <button class="btn btn-dangchieu">Đang chiếu</button>
            <button class="btn btn-sapchieu">Sắp chiếu</button>
        </div>

        <!-- Movie Cards -->
        <div class="row">
            <!-- Movie Card 1 -->
            <?php include('../admin/connectDB.php');
            $sql = 'SELECT * FROM film';
            $result = $conn->query($sql);
            $films = array();
            
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                   $films[] = $row;
                }
            }

            foreach ($films as $film) {
                ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card movie-card">
                        <span class="category-badge"><?php echo htmlspecialchars($film['Title']); ?></span>
                        <img src="../images/<?php echo htmlspecialchars($film['Image']); ?>" class="card-img-top" alt="Tên phim 1">
                        <div class="card-body">
                            <h5 class="movie-title"><?php echo htmlspecialchars($film['Name']); ?></h5>
                            <div class="movie-info mb-2">
                                <div class="rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <span class="ms-2">4.0/5.0</span>
                                </div>
                            </div>
                            <button class="btn btn-watch w-100">
                                <i class="fas fa-play me-2"></i>Mua vé
                            </button>
                        </div>
                    </div>
                </div>
                <?php
            }
        
            ?>

            

            <!-- Thêm các movie card tương tự -->
            
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <?php
            $footer_path = 'footer.html';
            if(file_exists($footer_path)) {
                include($footer_path);
            } else {
                echo '<div class="container">
                    <p class="text-center">Footer content not found.</p>
                </div>';
            }
        ?>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

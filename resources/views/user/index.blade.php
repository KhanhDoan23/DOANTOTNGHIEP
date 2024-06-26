<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang Đặt Sân Bóng Đá</title>
  <link href="{{asset('bootstrap-5.2.3/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('fontawesome-free-6.5.2-web/css/all.min.css')}}" rel="stylesheet">
  <style>
    .navbar-brand img {
      max-height: 40px;
      border-radius: 50%; 
    }
    .navbar {
      transition: background-color 0.5s ease;
    }
    .hero {
      background-image: url('https://via.placeholder.com/1200x400');
      background-size: cover;
      background-position: center;
      color: #fff;
      padding: 100px 0;
      position: relative;
    }
    .gradient-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom right, rgba(0,0,0,0.5), rgba(0,0,0,0.8));
      z-index: 1;
    }
    .hero h1 {
      font-size: 3rem;
    }
    .hero p {
      font-size: 1.5rem;
    }
    .san-bong .card {
      transition: transform 0.3s ease-in-out;
    }
    .san-bong .card:hover {
      transform: translateY(-10px);
    }
    .footer-info {
      color: #ccc;
      font-size: 0.9rem;
    }
    .footer-info a {
      color: #ccc;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .footer-info a:hover {
      color: #fff;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="{{asset('img/logo-web.jpg')}}" alt="Logo" class="img-fluid">
      Đặt Sân Bóng Đá
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">
            <i class="fas fa-home"></i> Trang chủ
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-calendar-alt"></i> Đặt sân
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-info-circle"></i> Tin Tức
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-phone"></i> Liên hệ
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('user.dang-nhap')}}">
            <i class="fas fa-sign-in-alt"></i> Đăng nhập
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<section class="hero d-flex align-items-center">
  <div class="gradient-overlay"></div>
  <div class="container text-center">
    <h1>Đặt Sân Bóng Đá</h1>
    <p class="lead">Hãy dễ dàng đặt sân bóng đá của bạn ngay từ bây giờ.</p>
    <a href="#" class="btn btn-primary btn-lg">Đặt sân ngay</a>
  </div>
</section>
<section class="san-bong py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 shadow">
          <img src="https://via.placeholder.com/300" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Sân A</h5>
            <p class="card-text">Sân có kích thước lớn, thích hợp cho các trận đấu lớn.</p>
            <a href="#" class="btn btn-primary">Đặt sân</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 shadow">
          <img src="https://via.placeholder.com/300" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Sân B</h5>
            <p class="card-text">Sân vừa phải, phù hợp cho các trận giao hữu.</p>
            <a href="#" class="btn btn-primary">Đặt sân</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 shadow">
          <img src="https://via.placeholder.com/300" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Sân C</h5>
            <p class="card-text">Sân nhỏ, thích hợp cho các trận đấu nhóm nhỏ.</p>
            <a href="#" class="btn btn-primary">Đặt sân</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<footer class="bg-dark text-light text-center py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>Thông tin liên hệ</h5>
        <p class="footer-info">
          Địa chỉ: 8A Nguyễn Trung Trực,Phường 5,Bình Thạnh,TPHCM<br>
          Điện thoại: +123 456 789<br>
          Email: Khanh179c@gmail.com
        </p>
      </div>
      <div class="col-md-4">
        <h5>Liên kết hữu ích</h5>
        <ul class="list-unstyled footer-info">
          <li><a href="#">Chính sách bảo mật</a></li>
          <li><a href="#">Điều khoản sử dụng</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Theo dõi chúng tôi</h5>
        <ul class="list-inline footer-info">
          <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
  <hr>
  <p>&copy; 2024 Trang Đặt Sân Bóng Đá. All rights reserved.</p>
</footer>
<script src="{{asset('bootstrap-5.2.3/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>

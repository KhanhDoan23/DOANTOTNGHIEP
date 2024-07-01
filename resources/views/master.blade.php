<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang Đặt Sân Bóng Đá</title>
  <link href="{{asset('bootstrap-5.2.3/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('fontawesome-free-6.5.2-web/css/all.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('sweetalert/sweetalert2.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
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
          <a class="nav-link active" aria-current="page" href="{{route('user.index')}}">
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
        
       @if(auth('cus')->check())
       <li class="nav-item">
          <a class="nav-link" href="{{route('user.dang-xuat')}}">
            <i class="fas fa-sign-in-alt"></i> Đăng xuất
          </a>
        </li>
       <li class="nav-item">
          <a class="nav-link" href="{{route('user.profile')}}">
            Hi,{{auth('cus')->user()->ho_ten}}
          </a>
        </li>
       @else
       <li class="nav-item">
          <a class="nav-link" href="{{route('user.dang-nhap')}}">
            <i class="fas fa-sign-in-alt"></i> Đăng nhập
          </a>
        </li>
       <li class="nav-item">
          <a class="nav-link" href="{{route('user.dang-ky')}}">
            <i class="fas fa-sign-in-alt"></i> Đăng ký
          </a>
        </li>
       @endif
      </ul>
    </div>
  </div>
</nav>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
  @yield('content')
</main>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"></script>
@yield('page')
@if (session('thong_bao'))
  <script>
    Swal.fire({
      icon:'success',
      title:"{{session('thong_bao')}}",
      text:'',
      footer:'',
      confirmButtonColor:"#000000"
    })
  </script>
  @endif

  @if (session('error'))
  <script>
    Swal.fire({
      icon:'error',
      title:"{{session('error')}}",
      text:'',
      footer:'',
      confirmButtonColor:"#000000"
    })
  </script>
  @endif
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý đặt sân bóng</title>
  <link href="{{asset('bootstrap-5.2.3/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('fontawesome-free-6.5.2-web/css/all.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('sweetalert/sweetalert2.min.css')}}">  
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
    }
    #sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 260px;
      z-index: 100;
      background: #343a40;
      color: #ffffff;
      transition: all 0.3s;
    }
    #sidebar .sidebar-heading {
      padding: 20px 0;
      text-align: center;
      font-size: 1.2rem;
      font-weight: bold;
    }
    #sidebar .list-group-item {
      border: none;
      background: transparent;
      color: #ffffff;
    }
    #sidebar .list-group-item:hover {
      background: rgba(255, 255, 255, 0.1);
    }
    #sidebar .active {
      background: #dc3545;
    }
    #content {
      margin-left: 260px;
      padding: 20px;
    }
    .navbar-brand img {
      max-height: 40px;
      border-radius: 50%; 
    }
  </style>
</head>
<body>

<div id="sidebar">
  <a class="navbar-brand" href="#">
      <img src="{{asset('img/logo-web.jpg')}}" alt="Logo" class="img-fluid">
 Quản lý đặt sân bóng </a>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a href="#" class="text-decoration-none text-white"><i class="fas fa-house-user"></i> Dashboard</a></li>
    <li class="list-group-item"><a href="{{route('admin.danhsach')}}" class="text-decoration-none text-white"><i class="far fa-calendar-alt"></i> Quản lý đặt sân</a></li>
    <li class="list-group-item"><a href="{{route('admin.danh-sach-san-bong')}}" class="text-decoration-none text-white"><i class="fa fa-columns"></i></i> Quản lý sân bóng</a></li>
    <li class="list-group-item"><a href="{{route('admin.quan-ly-user')}}" class="text-decoration-none text-white"><i class="fas fa-users"></i> Quản lý người dùng</a></li>
    <li class="list-group-item"><a href="{{route('danh-sach')}}" class="text-decoration-none text-white"><i class="fas fa-users"></i> Quản lý tài khoản admin</a></li>
    <li class="list-group-item"><a href="{{route('tin-tuc.danh-sach')}}" class="text-decoration-none text-white"><i class="fas fa-users"></i> Quản lý tài khoản tin tức</a></li>
    <li class="list-group-item"><a href="{{route('admin.dang-xuat')}}" class="text-decoration-none text-white"><i class="fas fa-sign-in-alt"></i> Đăng Xuất</a></li>
  </ul>
</div>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
  @yield('content')
</main>
<script src="{{asset('bootstrap-5.2.3/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('sweetalert/sweetalert2.all.min.js')}}"></script>
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

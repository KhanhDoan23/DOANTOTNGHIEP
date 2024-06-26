<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý đặt sân bóng</title>
  <link href="{{asset('bootstrap-5.2.3/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('fontawesome-free-6.5.2-web/css/all.min.css')}}" rel="stylesheet">
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
  </style>
</head>
<body>

<div id="sidebar">
  <div class="sidebar-heading">Quản lý đặt sân bóng</div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a href="#" class="text-decoration-none text-white"><i class="fas fa-house-user"></i> Dashboard</a></li>
    <li class="list-group-item"><a href="{{route('admin.danhsachdatsan')}}" class="text-decoration-none text-white"><i class="far fa-calendar-alt"></i> Quản lý đặt sân</a></li>
    <li class="list-group-item"><a href="#" class="text-decoration-none text-white"><i class="fas fa-users"></i> Quản lý người dùng</a></li>
    <li class="list-group-item"><a href="{{route('admin.dang-nhap')}}" class="text-decoration-none text-white"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
  </ul>
</div>

<div id="content">
  <div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <div class="row">
      <div class="col-lg-6">
        <h2>Sân bóng đang sử dụng</h2>
        <p>Đây là phần nội dung quản lý sân bóng.</p>
      </div>
      <div class="col-lg-6">
        <h2>Thống kê</h2>
        <p>Đây là phần thống kê dữ liệu.</p>
      </div>
    </div>
  </div>
</div>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
  @yield('content')
</main>
<script src="{{asset('bootstrap-5.2.3/js/bootstrap.bundle.min.js')}}"></script>
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

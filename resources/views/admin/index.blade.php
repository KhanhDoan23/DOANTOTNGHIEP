<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Trang Admin</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/thaydoi.css')}}" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{asset('fontawesome-free-6.5.2-web/css/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('sweetalert/sweetalert2.min.css')}}">  
  </head>
  <body>
    <div class="wrapper">
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <div class="logo-header" data-background-color="dark">
            <div class="nav-toggle">
            <strong style="color :aliceblue"><i class="fa fa-futbol text-primary ms-2"></i></strong>
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Menu</h4>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                  <i class="fas fa-layer-group"></i>
                  <p>Quản lý tài khoản</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{route('admin.quan-ly-user')}}">
                        <span class="sub-item">Quản lý tài khoản khách hàng</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{route('danh-sach')}}">
                        <span class="sub-item">Quản lý tài khoản admin</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="{{route('tin-tuc.danh-sach')}}">
                  <i class="fas fa-th-list"></i>
                  <p>Quản lý tin tức</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.quan-li-san-bong.danh-sach')}}">
                  <i class="fas fa-pen-square"></i>
                  <p>Quản lý sân bóng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.danhsach')}}">
                  <i class="fas fa-table"></i>
                  <p>Quản lý đặt sân</p>
                </a>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                <i class="fas fa-table"></i>
                  <p>Quản lý Thông Kê</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse">
                    <li>
                        <a href="{{route('admin.thong-ke')}}">
                        <span class="sub-item">Thống Kê Doanh Thu</span>
                      </a>
                    </li>
                    <li>
                        <a href="{{route('admin.thong-ke-san')}}">
                        <span class="sub-item">Thống Kê Số Lượng</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.thanh-toan-page')}}">
                  <i class="far fa-chart-bar"></i>
                  <p>Quản lý thanh toán</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.dang-xuat')}}">
                  <i class="far fa-sign-in"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img
                  src="assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
          </div>
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <span class="profile-username">
                    <i class="fas fa-user"></i>
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">{{auth('web')->user()->ten}}</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <i class="fas fa-user"></i>
                          </div>
                          <div class="u-text">
                            <h4>{{auth('web')->user()->ten}}</h4>
                            <p class="text-muted">{{auth('web')->user()->email}}</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('admin.dang-xuat')}}">Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </div>

        <div class="container">
          <div class="page-inner">
            <div  class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
                @yield('content')
            </main>
            </div>
          </div>
        </div>

        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <div class="copyright">
              2024, made with <i class="fa fa-heart heart text-danger"></i> by
              <a href="#">TuanKhanhCKC</a>
            </div>
            <div>
              Distributed by
              <a target="_blank" href="#">TuanKhanhCKC</a>.
            </div>
          </div>
        </footer>
      </div>
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js"')}}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>

    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js')}}"></script>


    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js')}}"></script>
    <script src="{{ asset('assets/js/setting-demo.js')}}"></script>
    <script src="{{ asset('assets/js/demo.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
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

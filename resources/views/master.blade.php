<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Đặt Sân Bóng Đá</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        
        <link rel="stylesheet" href="{{ asset('lib/animate/animate.min.css')}}" />
        <link rel="stylesheet" href="{{asset('sweetalert/sweetalert2.min.css')}}">  
        <link rel="stylesheet" href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/style.css')}}" />
    </head>

    <body>
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <div class="container-fluid topbar-top bg-primary">
            <div class="container">
                <div class="d-flex justify-content-between topbar py-2">
                    <div class="d-flex align-items-center flex-shrink-0 topbar-info">
                        <i class="fas fa-map-marker-alt me-2 text-dark"></i>8A Nguyễn Trung Trực,HCM</a>
                        <i class="fas fa-phone-alt me-2 text-dark"></i><a href="#" class="me-4 text-secondary">+84362760845</a>
                        <i class="fas fa-envelope me-2 text-dark"></i><a href="#" class="text-secondary">0306211148@caothang.edu.vn</a>
                    </div>
                    <div class="text-end pe-4 me-4 border-end border-dark search-btn">
                        <div class="search-form">
                            <form method="GET" action="{{route('user.dat-san.search')}}">
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input type="search" class="form-control border-0 rounded-pill" name="search-input" value="" placeholder="Search Here" required=""/>
                                        <button type="submit" value="Search Now!" class="btn"><i class="fa fa-search text-dark"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center topbar-icon">
                        <a href="#" class="me-4"><i class="fab fa-facebook-f text-dark"></i></a>
                        <a href="#" class="me-4"><i class="fab fa-twitter text-dark"></i></a>
                        <a href="#" class="me-4"><i class="fab fa-instagram text-dark"></i></a>
                        <a href="#" class=""><i class="fab fa-linkedin-in text-dark"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-dark">
            <div class="container">
                <nav class="navbar navbar-dark navbar-expand-lg py-lg-0">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="text-primary mb-0 display-5">K<span class="text-white">NG</span><i class="fa fa-futbol text-primary ms-2"></i></h1>
                    </a>
                    <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-dark"></span>
                    </button>
                    <div class="collapse navbar-collapse me-n3" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="{{route('user.index')}}" class="nav-item nav-link active"><i class="fas fa-home"></i>Home</a>
                            <a href="{{route('user.dat-san.hien-thi')}}" class="nav-item nav-link active"><i class="fas fa-calendar-alt"></i>Đặt Sân</a>
                            <a href="{{route('lien-he-ho-tro')}}" class="nav-item nav-link active"><i class="fas fa-phone"></i>Liên hệ</a>
                            <a href="{{route('user.tin-tuc.hien-thi')}}" class="nav-item nav-link active"><i class="fas fa-newspaper"></i>Tin Tức</a>
                            @if(auth('cus')->check())
                            <a href="{{route('lich-su-dat-san')}}" class="nav-item nav-link active"><i class="fas fa-shopping-cart"></i>Lịch Sử</a>
                                <a class="nav-item nav-link active" href="{{route('user.profile')}}">
                                    <i class="fas fa-user"></i> Hi,{{auth('cus')->user()->ho_ten}}
                                </a>
                                
                                <a class="nav-item nav-link active" href="{{route('user.dang-xuat')}}">
                                    <i class="fas fa-sign-in-alt"></i> Đăng xuất
                                </a>
                               
                            @else
                                <a class="nav-item nav-link active" href="{{route('user.dang-nhap')}}">
                                    <i class="fas fa-user"></i> Đăng nhập
                                </a>
                                <a class="nav-item nav-link active" href="{{route('user.dang-ky')}}">
                                    <i class="fas fa-user"></i> Đăng ký
                                </a>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>
       
      
        <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
          @yield('content')
        </main>
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay=".3s">
            <div class="container py-5">
                <div class="row g-4 footer-inner">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-white fw-bold mb-4">Phần mềm đặt sân bóng đá.</h4>
                            <p>Chúng tôi rất vui được biết đến bạn qua ứng dụng này</p>
                            <p class="mb-0"><a class="" href="#">KNG </a> &copy; 2024 All Right Reserved.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-white fw-bold mb-4">Usefull Link</h4>
                            <div class="d-flex flex-column align-items-start">
                                <a class="btn btn-link ps-0" href=""><i class="fa fa-check me-2"></i>About Us</a>
                                <a class="btn btn-link ps-0" href=""><i class="fa fa-check me-2"></i>Contact Us</a>
                                <a class="btn btn-link ps-0" href=""><i class="fa fa-check me-2"></i>Our Services</a>
                                <a class="btn btn-link ps-0" href=""><i class="fa fa-check me-2"></i>Terms & Condition</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-white fw-bold mb-4">Services Link</h4>
                            <div class="d-flex flex-column align-items-start">
                                <a class="btn btn-link ps-0" href=""><i class="fa fa-check me-2"></i>Apartment Cleaning</a>
                                <a class="btn btn-link ps-0" href=""><i class="fa fa-check me-2"></i>Office Cleaning</a>
                                <a class="btn btn-link ps-0" href=""><i class="fa fa-check me-2"></i>Car Washing</a>
                                <a class="btn btn-link ps-0" href=""><i class="fa fa-check me-2"></i>Green Cleaning</a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-white fw-bold mb-4">Contact Us</h4>
                            <a href="" class="btn btn-link w-100 text-start ps-0 pb-3 border-bottom rounded-0"><i class="fa fa-map-marker-alt me-3"></i>8A,Nguyễn Trung Trực,HCM</a>
                            <a href="" class="btn btn-link w-100 text-start ps-0 py-3 border-bottom rounded-0"><i class="fa fa-phone-alt me-3"></i>+84 362 760845</a>
                            <a href="" class="btn btn-link w-100 text-start ps-0 py-3 border-bottom rounded-0"><i class="fa fa-envelope me-3"></i>Khanh179c@gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                        <a href="#" class="text-primary mb-0 display-6">K<span class="text-white">NG</span><i class="fa fa-futbol text-primary ms-2"></i></a>
                    </div>
                    <div class="col-md-4 copyright-btn text-center text-md-start mb-3 mb-md-0 flex-shrink-0">
                        <a class="btn btn-primary rounded-circle me-3 copyright-icon" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary rounded-circle me-3 copyright-icon" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary rounded-circle me-3 copyright-icon" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-primary rounded-circle me-3 copyright-icon" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-primary rounded-circle border-3 back-to-top"><i class="fa fa-arrow-up"></i></a>

        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('lib/wow/wow.min.js')}}"></script>
        <script src="{{ asset('lib/easing/easing.min.js')}}"></script>
        <script src="{{ asset('lib/waypoints/waypoints.min.js')}}"></script>
        <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('js/main.js')}}"></script>
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
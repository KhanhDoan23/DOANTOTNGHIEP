<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập </title>
    <link rel="stylesheet" href="{{asset('bootstrap-5.2.3/css/bootstrap.min.css')}}">  
    <link rel="stylesheet" href="{{asset('styles.css')}}">
    <link rel="stylesheet" href="{{asset('signin.css')}}">
</head>
<main class="form-signin w-100 m-auto">
<form method="POST" action="{{route('admin.xl-dang-nhap')}}">
    @csrf
    <h1 class="h3 mb-3 fw-normal">Đăng Nhập</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="#" placeholder="namesignin" name="ten_dang_nhap">
      <label for="floatingInput">Tên Đăng Nhập</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="#" placeholder="Password" name="password">
      <label for="floatingPassword">Mật Khẩu</label>
    </div>
    @if(session('thong_bao'))
    <div>
        <p class="text-danger">{{session('thong_bao')}}</p>
    </div>
    @endif

    
    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Lưu tài khoản
      </label>
      <div>
        <a href="{{route('user.dang-ky')}}">nếu chưa có tài khoản nhấn đăng ký ở đây?</a>
     </div>
    </div>
    
    <button class="btn btn-primary w-100 py-2" type="submit">Đăng Nhập</button>
    <p class="mt-5 mb-3 text-body-secondary">© 2017–2023</p>
</form>
</main>
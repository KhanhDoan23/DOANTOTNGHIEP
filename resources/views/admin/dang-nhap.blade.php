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
<form method="POST" action="">
    @csrf
    <h1 class="h3 mb-3 fw-normal">Đăng Nhập</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="#" placeholder="namesignin" name="ten_dang_nhap"required>
      <label for="floatingInput">Tên Đăng Nhập</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="#" placeholder="Password" name="password"required>
      <label for="floatingPassword">Mật Khẩu</label>      
    </div>
    @if ($message = Session::get('message'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
    @endif
    @if ($message = Session::get('thong_bao'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
    @endif
    <button class="btn btn-primary w-100 py-2" type="submit">Đăng Nhập</button>
</form>
</main>
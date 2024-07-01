<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Đăng Ký</title>
  <link href="{{asset('bootstrap-5.2.3/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('fontawesome-free-6.5.2-web/css/all.min.css')}}" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Đăng Ký</h4>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              @csrf
              <div class="form-group">
                <label for="fullName">Họ và tên</label>
                <input type="text" class="form-control" id="fullName" name="ho_ten" required>
              </div>
              <div class="form-group">
                <label for="phoneNumber">Số điện thoại</label>
                <input type="tel" class="form-control" id="phoneNumber" name="so_dien_thoai" pattern="[0-9]{10,11}" required>
                <small id="phoneHelp" class="form-text text-muted">Vui lòng nhập số điện thoại hợp lệ (10 hoặc 11 số).</small>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="form-group">
                <label for="password">Nhập Lại Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="confirm_password" required>
              </div>
              <div>
                <a href="{{route('user.dang-nhap')}}">nếu đã có tài khoản vui lòng đăng nhập?</a>
              </div>
              @if(session('thong_bao'))
              <div>
                  <p class="text-danger">{{session('thong_bao')}}</p>
              </div>
              @endif
              <button type="submit" class="btn btn-primary">Đăng ký</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{asset('bootstrap-5.2.3/js/bootstrap.min.js')}}"></script>
</body>
</html>

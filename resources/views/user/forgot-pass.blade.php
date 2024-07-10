<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quên Mật Khẩu</title>
  <link href="{{ asset('bootstrap-5.2.3/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card-header {
      background: linear-gradient(to right, #56CCF2, #2F80ED);
      color: white;
    }
    .card-body {
      background-color: #f0f0f0;
      border: 1px solid #ced4da;
    }
    .form-control {
      background-color: #f8f9fa;
      border-color: #ced4da;
      transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .form-control:focus {
      border-color: #80bdff;
      box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4 class="mb-0">Forgot pass</h4>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                @error('email')
                  <div class="alert alert-warring">{{$message}}</div>
                @enderror
              </div>
              @if(session('thong_bao'))
              <div class="mb-3">
                <p class="text-danger">{{ session('thong_bao') }}</p>
              </div>
              @endif
              <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-block">Gửi Email</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('bootstrap-5.2.3/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

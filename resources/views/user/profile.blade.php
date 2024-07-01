@extends('master')
@section('content')
<form method="POST" action="{{ route('user.check-profile') }}">
@csrf
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thông tin cá nhân</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Họ và tên:</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{$auth->ho_ten }}" required>
                        </div>
                        @error('name')
                                <div class="help-block">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $auth -> email }}" required>
                            @error('email')
                                <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone:</label>
                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="so_dien_thoai" value="{{ $auth -> so_dien_thoai }}" required>
                            @error('phone')
                                <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">password:</label>
                        <div class="col-md-6">
                            <input id="password" type="text" class="form-control" name="password">
                            @error('password')
                                <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                           <button type="submit" class="btn btn-primary" >Cập nhật thông tin</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

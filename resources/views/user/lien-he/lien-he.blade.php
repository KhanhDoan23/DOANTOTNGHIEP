@extends('master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <i class="fas fa-user"></i> Liên hệ hỗ trợ</div>
            <div class="card-body">
                <div class="mb-3">
                <label for="hoTen" class="form-label">Họ và tên:</label>
                <input type="text" class="form-control" id="hoTen" value="{{ $dsAdmin->ten }}" disabled>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" value="{{ $dsAdmin->email }}" disabled>
            </div>
            <div class="mb-3">
                <label for="diaChi" class="form-label">Địa chỉ:</label>
                <textarea class="form-control" id="diaChi" rows="3" disabled>{{ $dsAdmin->dia_chi }}</textarea>
            </div>
        </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

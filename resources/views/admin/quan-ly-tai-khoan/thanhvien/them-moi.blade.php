@extends('admin.index')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm Mới Tài Khoản Quản Lý</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Tên Quản Lý</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control  @error('ten') @enderror " name="ten" >    
                                    @error('ten')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for="name" class="col-md-4 col-form-label text-md-right">Địa Chỉ</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control  @error('dia_chi') @enderror " name="dia_chi" >    
                                    @error('dia_chi')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for="name" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control  @error('email') @enderror " name="email" >    
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for="name" class="col-md-4 col-form-label text-md-right">Tên Đăng Nhập </label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control  @error('ten_dang_nhap') @enderror " name="ten_dang_nhap" >     
                                     @error('ten_dang_nhap')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror                            
                                </div>
                                <label for="name" class="col-md-4 col-form-label text-md-right">Mật Khẩu</label>
                                <div class="col-md-6">
                                    <input id="name" type="password" class="form-control  @error('password') @enderror " name="password" >
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror      
                                </div>
                                <label for="name" class="col-md-4 col-form-label text-md-right">Chọn quyền</label>
                                <div class="col-md-6">

                                <select name="quyen" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    @foreach ($dsQuyen as $quyen)
                                        @if($quyen->id != 2)
                                        <option value="{{ $quyen->id }}">{{ $quyen->ten_quyen }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Lưu
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{route('danh-sach')}}" class="btn btn-primary">Quay lại</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
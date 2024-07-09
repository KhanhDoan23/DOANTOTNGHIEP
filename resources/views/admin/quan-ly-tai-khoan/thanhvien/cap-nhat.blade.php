@extends('admin.index')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cập nhật Tài Khoản') }}</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Tên Quản Lý</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" value="{{$admin->ten}}" name="ten">
                                    @error('ten')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror 
                                </div>
                              
                            </div>
                            <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Địa Chỉ</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control"  value="{{$admin->dia_chi}}" name="dia_chi" >    
                                    @error('dia_chi')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                              
                            </div>
                            <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="name" type="email" class="form-control" value="{{$admin->email}}" name="email" >    
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                              
                            </div>
                            
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Tên Đăng Nhập</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" value="{{$admin->ten_dang_nhap}}"  name="ten_dang_nhap">
                                    @error('ten_dang_nhap')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror 
                                </div>
                               
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Quyền Quản Lý</label>
                                <div class="col-md-6">
                                
                                <select name="quyen" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option selected value="{{$admin->quyen_id}}" >{{$admin->quyen->ten_quyen}}</option>
                                @foreach ($quyen as $q)
                                    @if($admin->quyen_id != $q->id)
                                    <option value="{{ $q->id }}">{{ $q->ten_quyen}}</option>
                                    @endif
                                @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                       Lưu
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
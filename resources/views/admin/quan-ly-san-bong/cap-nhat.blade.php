@extends('admin.index')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cập nhật Sân') }}</div>

                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Tên Sân</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" value="{{$sanbong->ten_san}}" name="ten_san">
                                    @error('ten_san')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror 
                                </div>
                              
                            </div>
                            
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Địa chỉ</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('dia_chi') is-invalid @enderror" value="{{$sanbong->dia_chi}}"  name="dia_chi" required autofocus>
                                    @error('dia_chi')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror 
                                </div>
                               
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Loại Sân</label>
                                <div class="col-md-6">
                                
                                <select name="loai_san" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option selected value="{{$sanbong->loai_san_id}}" >{{$sanbong->loai_san->loai_san}}</option>
                                    @foreach ($loaisan as $ls)
                                        @if($sanbong->loai_san_id != $ls->id)
                                        <option value="{{ $ls->id }}">{{ $ls->loai_san}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Hình ảnh hiện tại:</strong><br>
                                    @if($sanbong->hinh_anh)
                                        <img src="{{ asset($sanbong->hinh_anh) }}" alt="Hình ảnh sân" style="width:300px;height:300px">
                                    @else
                                        <p>Không có hình ảnh</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Chọn hình ảnh mới:</strong>
                                    <input type="file" name="hinh_anh" class="form-control-file">
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
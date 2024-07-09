@extends('admin.index')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm Mới Sân Bóng</div>

                    <div class="card-body">
                    <form method="POST" action="{{ route('quan-li-san-bong.xu-ly-them-moi') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Tên Sân</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control  @error('ten_san') @enderror " name="ten_san" >    
                                    @error('ten_san')
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
                                <label for="loai_san" class="col-md-4 col-form-label text-md-right">Chọn loại sân</label>
                                <div class="col-md-6">

                                <select name="loai_san" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    @foreach ($dsLoaiSan as $loaisan)
                                        <option value="{{ $loaisan->id }}">{{ $loaisan->loai_san }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Hình ảnh:</strong>
                                        <input type="file" name="hinh_anh" class="form-control-file">
                                        @error('image')
                                                <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
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
                                    <a href="{{route('admin.quan-li-san-bong.danh-sach')}}" class="btn btn-primary">Quay lại</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
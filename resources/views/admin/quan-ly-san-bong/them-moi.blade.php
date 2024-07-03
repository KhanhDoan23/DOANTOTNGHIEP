@extends('admin.index')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm Mới Sân Bóng</div>

                    <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('quan-li-san-bong.xu-ly-them-moi') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Tên Sân</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control  @error('ten_san') @enderror " name="ten_san" >    
                                    @error('ten_san')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for="name" class="col-md-4 col-form-label text-md-right">Chọn loại sân</label>
                                <div class="col-md-6">

                                <select name="loai_san" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    @foreach ($dsLoaiSan as $loaisan)
                                        @if($loaisan->id != 2)
                                        <option value="{{ $loaisan->id }}">{{ $loaisan->loai_san }}</option>
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
@extends('admin.index')

@section('content')
<div id="content">
<div class="table-responsive">
        <table class="table table-striped table-sm" border="1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Sửa tin tức</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('tin-tuc.danh-sach') }}"> Quay lại</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Đã có lỗi xảy ra khi nhập liệu.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tin-tuc.xl-cap-nhat',$news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tiêu đề:</strong>
                        <input type="text" name="tieu_de" value="{{ $news->tieu_de }}" class="form-control" placeholder="Tiêu đề">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Mô tả ngắn:</strong>
                        <input type="text" name="mo_ta_ngan" value="{{ $news->mo_ta_ngan }}" class="form-control" placeholder="Mô tả ngắn">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Ngày cập nhật:</strong>
                        <input type="datetime" name="ngay_dang" value="{{ $news->ngay_dang }}" class="form-control" placeholder="Ngày đăng" readonly>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nội dung:</strong>
                        <textarea class="form-control" style="height:150px" name="noi_dung" placeholder="Nội dung">{{ $news->noi_dung }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Hình ảnh hiện tại:</strong><br>
                        @if($news->image)
                            <img src="{{ asset($news->image) }}" alt="Hình ảnh tin tức" style="max-width: 100%;">
                        @else
                            <p>Không có hình ảnh</p>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Chọn hình ảnh mới:</strong>
                        <input type="file" name="image" class="form-control-file">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>

        </form>
    </div>
    </table>
</div></div>
@endsection

@extends('admin.index')

@section('content')
<div id="content">
<div class="table-responsive">
        <table class="table table-striped table-sm" border="1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Tạo tin tức mới</h2>
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

        <form action="{{route('tin-tuc.xl-them-moi')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tiêu đề:</strong>
                        <input type="text" name="tieu_de" class="form-control" placeholder="Tiêu đề">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Mô tả ngắn:</strong>
                        <textarea class="form-control" style="height:150px" name="mo_ta_ngan" placeholder="Nội dung"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nội dung:</strong>
                        <textarea class="form-control" style="height:150px" name="noi_dung" placeholder="Nội dung"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Hình ảnh:</strong>
                        <input type="file" name="image" class="form-control-file">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>

        </form>
    </div>
    </table>
    </div>
    </div>
@endsection

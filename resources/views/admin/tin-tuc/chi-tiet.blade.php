@extends('admin.index')

@section('content')
<div id="content">
<div class="table-responsive">
        <table class="table table-striped table-sm" border="1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Chi tiết tin tức</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('tin-tuc.danh-sach') }}"> Quay lại</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tiêu đề:</strong>
                    {{ $news->tieu_de }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Mô tả ngắn:</strong>
                    {{ $news->mo_ta_ngan }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nội dung:</strong>
                    {{ $news->noi_dung }}
                </div>
            </div>
            @if($news->image)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Hình ảnh:</strong><br>
                    <img src="{{ asset($news->image) }}" alt="Hình ảnh tin tức" style="max-width: 50%;">
                </div>
            </div>
            @endif
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Ngày đăng:</strong>
                    {{ $news->ngay_dang}}
                </div>
            </div>
        </div>
    </div>
    </table>
    </div>
    </div>
@endsection

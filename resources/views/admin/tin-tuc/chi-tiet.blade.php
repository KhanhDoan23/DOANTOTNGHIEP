@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Chi tiết tin tức</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('news.index') }}"> Quay lại</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tiêu đề:</strong>
                    {{ $news->title }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nội dung:</strong>
                    {{ $news->content }}
                </div>
            </div>
            @if($news->image)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Hình ảnh:</strong><br>
                    <img src="{{ asset($news->image) }}" alt="Hình ảnh tin tức" style="max-width: 100%;">
                </div>
            </div>
            @endif
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Thời gian tạo:</strong>
                    {{ $news->created_at->format('d-m-Y H:i:s') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('master')

@section('content')

<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">{{ $news->tieu_de }}</h2>
                    <p class="card-text text-muted mb-4">Ngày đăng: {{ $news->ngay_dang }}</p>
                    @if ($news->image)
                    <img src="{{ asset($news->image) }}" class="img-fluid mb-4" alt="Hình ảnh tin tức">
                    @endif
                    <p class="card-text">{{ $news->noi_dung }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Nội dung về tin tức</h5>
                    <ul class="list-unstyled">
                        <li>{{ $news->tieu_de }}</li>
                        <p>{{ $news->mo_ta_ngan }}</p>
                        <p class="card-text">{{ $news->noi_dung }}</p>
                        <li><strong>Ngày đăng:</strong> {{ $news->ngay_dang }}</li>
                    </ul>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Các tin tức khác</h5>
                    <div class="row">
                        @foreach ($randomNews as $random)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                @if ($random->image)
                                <a href="{{ route('user.tin-tuc.chi-tiet', $random->id) }}"><img src="{{ asset($random->image) }}" class="card-img-top" alt="Hình ảnh tin tức"></a>
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title"><a href="{{ route('user.tin-tuc.chi-tiet', $random->id) }}">{{ $random->tieu_de }}</a></h6>
                                    <p class="card-text">{{ $random->mo_ta_ngan }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

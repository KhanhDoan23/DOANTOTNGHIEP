@extends('master')

@section('content')

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($news as $item)
            <div class="col">
                <div class="card shadow-sm">
                    @if ($item->image)
                    <a href="{{ route('user.tin-tuc.chi-tiet',$item->id) }}">
                        <img src="{{ asset($item->image) }}" class="card-img-top" alt="{{ $item->tieu_de }}">
                    </a>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('user.tin-tuc.chi-tiet',$item->id) }}" class="text-dark text-decoration-none stretched-link">{{ $item->tieu_de }}</a>
                        </h5>
                        <p class="card-text">{{ $item->mo_ta_ngan }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('user.tin-tuc.chi-tiet',$item->id) }}" class="btn btn-sm btn-outline-secondary">Xem thêm</a>
                            </div>
                            <small class="text-muted">Ngày đăng: {{ $item->ngay_dang }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .card-title a:hover {
        color: #007bff;
        text-decoration: underline;
    }

    .btn-outline-secondary:hover {
        color: #007bff;
        background-color: #007bff; 
        border-color: #007bff;
    }
    .btn-group:hover{
        color: aqua;
    }
</style>

@endsection

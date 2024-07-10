@extends('master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($dsSanBong->chunk(3) as $chunk)
        <div class="row">
            @foreach ($chunk as $sanBong)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset($sanBong->hinh_anh) }}" class="card-img-top" alt="Ảnh sân bóng">
                    <div class="card-body">
                        <h5 class="card-title">{{ $sanBong->ten_san }} - {{ $sanBong->loai_san->loai_san }}</h5>
                        <p class="card-text">Địa chỉ: {{ $sanBong->dia_chi }}</p>
                        <p class="card-text">Giá thuê: {{number_format($sanBong->gia_thue->gia_30p)}}VNĐ / 30 phút</p>
                        <p class="card-text" >Giá thuê: {{number_format($sanBong->gia_thue->gia_1h)}}VNĐ / 60 phút</p>
                        <p class="card-text" style="color:red">Phụ Thu sau 6h (nếu có): {{number_format($sanBong->gia_thue->phu_thu_toi)}}VNĐ</p>
                        <a href="{{ route('dat-san.show', ['id' => $sanBong->id]) }}" class="btn btn-primary">Đặt sân</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>


<style>
    .card {
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: scale(1.03);
}
.card-img-top{
    width: 100%;
    height: 500px;
}
</style>
@endsection

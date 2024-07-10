@extends('master')

@section('content')
<div class="container">
    <h2 class="my-4" style="text-align:center;">Lịch sử đặt sân</h2>
    <div class="card">
        <div class="card-body">
            @if ($lichSuDatSan->isEmpty())
                <div class="empty-message">
                    <p>Chưa có đặt lần nào.</p>
                </div>
            @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Sân</th>
                            <th>Loại Sân</th>
                            <th>Ngày Đặt Sân</th>
                            <th>Thời gian bắt đầu</th>
                            <th>Thời gian kết thúc</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lichSuDatSan as $key => $datSan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $datSan->san_bong->ten_san }}</td>
                            <td>{{ $datSan->san_bong->loai_san->loai_san }}</td>
                            <td>{{ $datSan->ngay_dat }}</td>
                            <td>{{ $datSan->tg_bat_dau }}</td>
                            <td>{{ $datSan->tg_ket_thuc }}</td>
                            <td>{{ number_format($datSan->tong_tien) }} VNĐ</td>
                            <td>
                                @if ($datSan->trang_thai_dat_san_id == 1)
                                <span class="badge bg-warning text-dark">Đã Xác Nhận</span>
                                @elseif ($datSan->trang_thai_dat_san_id == 2)
                                <span class="badge bg-success">Đã hoàn thành</span>
                                @elseif ($datSan->trang_thai_dat_san_id == 3)
                                <span class="badge bg-danger">Đã hủy</span>
                                @else
                                <span class="badge bg-info">Đang chờ duyệt</span>
                                @endif
                            </td>
                            <td>
                                @if ($datSan->trang_thai_dat_san_id == 1) 
                                <form method="post" action="{{ route('user.huy-dat-san', ['id' => $datSan->id]) }}">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-danger btn-sm">Huỷ</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
<style>
    .empty-message {
    margin-top: 20px;
    padding: 20px;
    text-align: center;
    background-color: #f8f9fa;
    border: 1px solid #ddd; 
    border-radius: 5px; 
    font-size: 1.2rem; 
    color:black; 
}

</style>
@endsection

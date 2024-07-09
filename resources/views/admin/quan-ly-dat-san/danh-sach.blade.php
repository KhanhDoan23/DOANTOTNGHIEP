@extends('admin.index')
@section('content')
<div id="content">
    <div class="table-responsive">
        <table class="table table-striped table-sm" border="1">
        <form class="form-inline" action="{{route('admin.quan-ly-dat-san.search')}}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" style="max-width: 400px;" name="query" placeholder="Search for products">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Tìm</button>
                </div>
            </div>
        </form>
            <h3>Quản lý đặt sân</h3>
            <form class="form-inline" method="get" action="{{route('admin.danhsach')}}">
                <div class="form-group" style="max-width: 70px; text-align:center;">
                    <label for="Page" style="color :red;font-size: 13px;">Số lượng dòng trên mỗi trang:</label>
                    <select class="form-control" name="Page" id="Page" onchange="this.form.submit()">
                        <option value="5" {{ $Page == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $Page == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ $Page == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ $Page == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $Page == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </form>

            <thead>
                <tr>
                    <th>Khách Hàng</th>
                    <th>Tên Sân</th>
                    <th>Ngày Đặt</th>
                    <th>Thời Gian Bắt Đầu</th>
                    <th>Thời Gian Kết Thúc</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($dsDatSan as $datSan)
                <tr>
                    <td>{{ $datSan->user->ho_ten }}</td>
                    <td>{{ $datSan->san_bong->ten_san }}</td>
                    <td>{{ $datSan->ngay_dat }}</td>
                    <td>{{ $datSan->tg_bat_dau }}</td>
                    <td>{{ $datSan->tg_ket_thuc }}</td>
                    <td>{{ number_format($datSan->tong_tien) }}</td>
                    <td>
                        @if($datSan->trang_thai_dat_san_id == 1)
                        <span class="badge bg-info">Đã Xác Nhận</span>
                        @elseif($datSan->trang_thai_dat_san_id == 2)
                        <span class="badge bg-success">Đã Hoàn Thành</span>
                        @elseif($datSan->trang_thai_dat_san_id == 3)
                        <span class="badge bg-danger">Đã Hủy</span>
                        @else
                        <span class="badge bg-warning text-dark">Chờ Duyệt</span>
                        @endif
                    </td>
                    <td>
                        @if($datSan->trang_thai_dat_san->trang_thai !== 3 && $datSan->trang_thai_dat_san->trang_thai !== 2)
                        <form method="post" action="{{ route('admin.thay-doi-trang-thai', ['id' => $datSan->id]) }}">
                            @csrf
                            @method('put')
                            <select name="trangthai" onchange="this.form.submit()">
                                <option>Thay Đổi Trạng Thái đơn</option>
                                <option value="1">Xác Nhận</option>
                                <option value="2">Đã Hoàn Thành</option>
                                <option value="3">Đã Hủy</option>
                            </select>
                        </form>
                        @else
                        @if($datSan->trang_thai_dat_san->trang_thai == 2)
                        <label for="">Đã Hoàn Thành</label>
                        @elseif($datSan->trang_thai_dat_san->trang_thai == 3)
                        <label for="">Đã Hủy</label>
                        @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="container mt-3">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @if ($dsDatSan->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $dsDatSan->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Previous</span>
                </a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo; Previous</span>
            </li>
            @endif

            @for ($i = max(1, $dsDatSan->currentPage() - 1); $i <= min($dsDatSan->currentPage() + 1, $dsDatSan->lastPage()); $i++)
            <li class="page-item {{ $i == $dsDatSan->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $dsDatSan->url($i) }}">{{ $i }}</a>
            </li>
            @endfor

            @if ($dsDatSan->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $dsDatSan->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">Next &raquo;</span>
                </a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">Next &raquo;</span>
            </li>
            @endif
        </ul>
    </nav>
</div>
@endsection

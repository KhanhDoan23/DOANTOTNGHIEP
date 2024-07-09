@extends('admin.index')

@section('content')
<div id="content">
    <div class="table-responsive">
        <table class="table table-striped table-sm">
        <form class="form-inline" action="{{route('admin.thanh-toan.search')}}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" style="max-width: 400px;" name="query" placeholder="Search for products">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Tìm</button>
                </div>
            </div>
        </form>
        <h3>Danh Sách Hoá Đơn</h3>
        <form class="form-inline" method="get" action="{{ route('admin.thanh-toan-page') }}">
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
                    <th>Tên Khách Hàng</th>
                    <th>Tên Sân</th>
                    <th>Ngày Đặt Sân</th>
                    <th>Tổng Tiền</th>
                    <th>Ngày Thanh Toán</th>
                    <th>Trạng Thái Thanh Toán</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsDatSan as $datSan)
                    <tr>
                        <td>{{ $datSan->user->ho_ten }}</td>
                        <td>{{ $datSan->san_bong->ten_san }}</td>
                        <td>{{ $datSan->ngay_dat }}</td>
                        <td>{{ number_format($datSan->tong_tien) }}</td>
                        <td>{{ optional($datSan->thanhToan)->ngay_thanh_toan }}</td>
                        <td>
                            @if (optional($datSan->thanhToan)->trang_thai_thanh_toan_id == 1)
                                <span class="badge bg-success">Đã Thanh Toán</span>
                            @elseif (optional($datSan->thanhToan)->trang_thai_thanh_toan_id == 2)
                                <span class="badge bg-warning text-dark">Chưa Thanh Toán</span>
                            @else
                                <span class="badge bg-danger">Chờ duyệt</span>
                            @endif
                        </td>
                        <td>
                            @if ($datSan->trang_thai_thanh_toan_id !== 1)
                                <form method="post" action="{{ route('admin.thay-doi-trang-thai-thanh-toan', ['id' => $datSan->thanhToan->id]) }}">
                                    @csrf
                                    @method('put')
                                    <select class="form-select" name="trangthai" onchange="this.form.submit()">
                                        <option>Thay Đổi Trạng Thái</option>
                                        <option value="1">Đã Thanh Toán</option>
                                        <option value="2">Chưa Thanh Toán</option>
                                    </select>
                                </form>
                            @else
                                <label><span class="badge bg-success">Đã Thanh Toán</span></label>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container mt-3">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                @if ($cacLanThanhToan->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $cacLanThanhToan->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo; Previous</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&laquo; Previous</span>
                    </li>
                @endif

                @for ($i = max(1, $cacLanThanhToan->currentPage() - 1); $i <= min($cacLanThanhToan->currentPage() + 1, $cacLanThanhToan->lastPage()); $i++)
                    <li class="page-item {{ $i == $cacLanThanhToan->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $cacLanThanhToan->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($cacLanThanhToan->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $cacLanThanhToan->nextPageUrl() }}" aria-label="Next">
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
</div>
@endsection

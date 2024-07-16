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
        <form class="form-inline mb-3" action="{{ route('admin.thanh-toan-page') }}" method="GET">
            <div class="form-group">
            <i class="fas fa-filter"></i><label for="trangthai" class="mr-2">Lọc theo trạng thái:</label>
                <select class="form-control" name="trangthai" id="trangthai" onchange="this.form.submit()"
                        style="font-size: 14px; max-width: 150px;">
                    <option value="">Tất cả</option>
                    <option value="1" {{ request('trangthai') == '1' ? 'selected' : '' }}>Đã thanh toán</option>
                    <option value="2" {{ request('trangthai') == '2' ? 'selected' : '' }}>Chưa thanh toán</option>
                    <option value="3" {{ request('trangthai') == '3' ? 'selected' : '' }}>Chờ duyệt</option>
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
                        <td>
                        @if ($datSan->tong_tien)
                            {{ number_format($datSan->tong_tien) }}
                        @else
                        <span class="badge bg-danger">Đã bị huỷ</span>
                        @endif
                    </td>
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
                    @if ($datSan->trang_thai_dat_san_id !== 4)
                        @if ($datSan->trang_thai_dat_san_id !== 3)
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
                        @endif
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

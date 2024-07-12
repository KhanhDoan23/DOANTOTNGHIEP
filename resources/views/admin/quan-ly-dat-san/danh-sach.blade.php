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
            <form class="form-inline mb-3" action="{{ route('admin.danhsach') }}" method="GET">
                <div class="form-group">
                <i class="fas fa-filter"></i><label for="trangthai" class="mr-2">Lọc theo trạng thái:</label>
                    <select class="form-control" name="trangthai" id="trangthai" onchange="this.form.submit()"
                            style="font-size: 14px; max-width: 150px;">
                        <option value="">Tất cả</option>
                        <option value="1" {{ $trangThai == '1' ? 'selected' : '' }}>Đã xác nhận</option>
                        <option value="2" {{ $trangThai == '2' ? 'selected' : '' }}>Đã hoàn thành</option>
                        <option value="3" {{ $trangThai == '3' ? 'selected' : '' }}>Đã hủy</option>
                        <option value="4" {{ $trangThai == '4' ? 'selected' : '' }}>Chờ duyệt</option>
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
                    <th>Trạng Thái Thanh Toán</th>
                    <th>Trạng Thái Đặt Sân</th>
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
                    <td>{{ $datSan->trang_thai_thanh_toan->trang_thai }}</td>
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
                        @if($datSan->trang_thai_dat_san->trang_thai !== 3 && $datSan->trang_thai_dat_san->trang_thai !== 4)
                        <form method="post" action="{{ route('admin.thay-doi-trang-thai', ['id' => $datSan->id]) }}">
                            @csrf
                            @method('put')
                            <select name="trangthai" onchange="this.form.submit()">
                                <option>Thay Đổi Trạng Thái đơn</option>
                                <option value="1">Xác Nhận</option>
                                <option value="2">Đã Hoàn Thành</option>
                                <option value="3">Đã Hủy</option>
                                <option value="4">Chờ duyệt</option>
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

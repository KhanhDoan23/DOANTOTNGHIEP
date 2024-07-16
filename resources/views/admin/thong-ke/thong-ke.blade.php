@extends('admin.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bảng thống kê doanh thu</div>
                <div class="card-body">
                    <form action="{{ route('admin.thong-ke') }}" method="GET">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="ngayBatDau" class="form-label">Ngày bắt đầu</label>
                                <input type="date" class="form-control" id="ngayBatDau" name="ngayBatDau">
                            </div>
                            <div class="col-md-4">
                                <label for="ngayKetThuc" class="form-label">Ngày kết thúc</label>
                                <input type="date" class="form-control" id="ngayKetThuc" name="ngayKetThuc">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Lọc</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Doanh thu theo tháng</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tháng</th>
                                        <th>Doanh thu (VNĐ)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $tongDoanhThuThang = 0;
                                    @endphp
                                    @foreach($doanhThuTheoThang as $item)
                                    <tr>
                                        <td>{{ $item->thang }}</td>
                                        <td>{{ number_format($item->tong_doanh_thu, 0, ',', '.') }}</td>
                                    </tr>
                                    @php
                                        $tongDoanhThuThang += $item->tong_doanh_thu;
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td><strong>Tổng</strong></td>
                                        <td><strong>{{ number_format($tongDoanhThuThang, 0, ',', '.') }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Doanh thu theo ngày</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ngày</th>
                                        <th>Doanh thu (VNĐ)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $tongDoanhThuNgay = 0;
                                    @endphp
                                    @foreach($doanhThuTheoNgay as $item)
                                    <tr>
                                        <td>{{ $item->ngay }}</td>
                                        <td>{{ number_format($item->tong_doanh_thu, 0, ',', '.') }}</td>
                                    </tr>
                                    @php
                                        $tongDoanhThuNgay += $item->tong_doanh_thu;
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td><strong>Tổng</strong></td>
                                        <td><strong>{{ number_format($tongDoanhThuNgay, 0, ',', '.') }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.index')
@section('content')
<div id="content">
<div class="table-responsive">
    <table class="table table-striped table-sm" border="1">
    <h3>Chi Tiết Tài Khoản</h3>
        <thead>
            <tr>
                <th>Tên Tài Khoản</td>
                <th>Số Điện Thoại</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $KhachHang->ho_ten }}</td>
                <td>{{ $KhachHang->so_dien_thoai }}</td>
                <td>{{ $KhachHang->email }}</td>
                @if($KhachHang->email_verified_at === null)
                <td><span class="badge bg-warning text-dark">Tài Khoản Chưa xác Nhận</span></td>
                @endif
                @if($KhachHang->email_verified_at !== null)
                <td><span class="badge bg-success">Tài Khoản Đã Xác Nhận</span> </td>
                @endif
            </tr>
        </tbody>
    </table>
    <a href="{{route('admin.quan-ly-user')}}"><button type="submit" class="btn btn-info">Quay lại</button></a>
</div>
</div>
@endsection
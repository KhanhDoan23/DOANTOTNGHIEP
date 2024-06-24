@extends('index')
@section('context')
<div id="content">
  <div class="container-fluid">
    <h1 class="mt-4">Quản lý đặt sân</h1>
    <div class="row">
      <div class="col-lg-12">
        <h2>Danh sách đặt sân</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">STT</th>
              <th scope="col">Ngày đặt</th>
              <th scope="col">Khách hàng</th>
              <th scope="col">Sân bóng</th>
              <th scope="col">Thời gian</th>
              <th scope="col">Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>2023-06-01</td>
              <td>Nguyễn Văn A</td>
              <td>Sân A</td>
              <td>19:00 - 20:00</td>
              <td><span class="badge bg-success">Hoàn thành</span></td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>2023-06-02</td>
              <td>Trần Thị B</td>
              <td>Sân B</td>
              <td>18:00 - 19:00</td>
              <td><span class="badge bg-warning text-dark">Đang chờ</span></td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>2023-06-03</td>
              <td>Phạm Văn C</td>
              <td>Sân C</td>
              <td>20:00 - 21:00</td>
              <td><span class="badge bg-secondary">Hủy bỏ</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
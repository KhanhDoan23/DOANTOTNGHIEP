@extends('admin.index')
@section('content')
<div id="content">
      <div class="table-responsive">
        <table class="table table-striped table-sm" border="1">
        <form class="form-inline" action="" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" style="max-width: 400px;" name="query" placeholder="Search for customers">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <h3>Tài Khoản Khách Hàng</h3>
        <form class="form-inline" method="get" action="{{ route('admin.quan-ly-user') }}">
            <div class="form-group" style="max-width: 200px;">
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
                <th>Tên</td>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th></th>
            </tr>
          </thead>
            <tbody>
            @foreach($dsKhachHang as $KhachHang)
            <tr>
                <td>{{ $KhachHang->ho_ten }}</td>
                <td>{{ $KhachHang->email }}</td>
                <td>{{ $KhachHang->so_dien_thoai }}</td>
                <td><a href="{{ route('admin.chi-tiet',['id'=>$KhachHang->id])}}"><button type="button" class="btn btn-success">Xem Chi Tiết</button></a>|<a href="{{ route('admin.xoa',['id'=>$KhachHang->id])}}"><button type="button" class="btn btn-danger">Xóa</button></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
        </div>
        <div class="container mt-3">
          <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                  @if ($dsKhachHang->currentPage() > 1)
                      <li class="page-item">
                          <a class="page-link" href="{{ $dsKhachHang->previousPageUrl() }}" aria-label="Previous">
                              <span aria-hidden="true">&laquo; Previous</span>
                          </a>
                      </li>
                  @else
                      <li class="page-item disabled">
                          <span class="page-link" aria-hidden="true">&laquo; Previous</span>
                      </li>
                  @endif

                  @for ($i = max(1, $dsKhachHang->currentPage() - 1); $i <= min($dsKhachHang->currentPage() + 1, $dsKhachHang->lastPage()); $i++)
                      <li class="page-item {{ $i == $dsKhachHang->currentPage() ? 'active' : '' }}">
                          <a class="page-link" href="{{ $dsKhachHang->url($i) }}">{{ $i }}</a>
                      </li>
                  @endfor

                  @if ($dsKhachHang->hasMorePages())
                      <li class="page-item">
                          <a class="page-link" href="{{ $dsKhachHang->nextPageUrl() }}" aria-label="Next">
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
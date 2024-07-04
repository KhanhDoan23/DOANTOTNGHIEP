@extends('admin.index')
@section('content')
<div id="content">
<div class="table-responsive">
        <table class="table table-striped table-sm" border="1">
        <div> 
            <a href="{{route('them-moi')}}"><button type="button" class="btn btn-info">Thêm Mới</button></a>
        </div>
        <form class="form-inline" action="{{ route('admin.search') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" style="max-width: 400px;" name="query" placeholder="Search for products">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <h3>Danh Sách Tài Khoản Admin</h3>
        <form class="form-inline" method="get" action="{{ route('danh-sach') }}">
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
                <th>Tên Đăng Nhập</th>
                <th>Quyền</th>
                <th>Thao Tác</th>
            </tr>
          </thead>
            <tbody>
            @foreach($dsAdmin as $admin)
            <tr>
                <td>{{ $admin->ten }}</td>
                <td>{{ $admin->ten_dang_nhap }}</td>
                @if ($admin->quyen)
                    <td>{{ $admin->quyen->ten_quyen }}</td>
                @else
                    <td>Admin</td> 
                @endif
                @if ($admin->quyen->ten_quyen === 'Chủ')
                    <td><span class="badge bg-warning text-dark">Tài Khoản Gốc</span></td>
                @else
                <td><a href="{{route('cap-nhat',['id'=>$admin->id])}}"><button type="button" class="btn btn-success">Sửa</button></a>|<a href="{{route('xoa',['id'=>$admin->id])}}"><button type="button" class="btn btn-success">Xóa</button></a></td>
                @endif
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="container mt-3">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @if ($dsAdmin->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $dsAdmin->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&laquo; Previous</span>
                </li>
            @endif

            @for ($i = max(1, $dsAdmin->currentPage() - 1); $i <= min($dsAdmin->currentPage() + 1, $dsAdmin->lastPage()); $i++)
                <li class="page-item {{ $i == $dsAdmin->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $dsAdmin->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($dsAdmin->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $dsAdmin->nextPageUrl() }}" aria-label="Next">
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
</div>
@endsection
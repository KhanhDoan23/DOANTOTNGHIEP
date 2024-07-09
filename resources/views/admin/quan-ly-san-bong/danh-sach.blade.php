@extends('admin.index')
@section('content')
<div id="content">
<div class="table-responsive">
        <table class="table table-striped table-sm" border="1">
        <div> 
            <a href="{{route('admin.quan-ly-san-bong.them-moi')}}"><button type="button" class="btn btn-info">Thêm Mới</button></a>
        </div>
        <form class="form-inline" action="{{route('admin.quan-ly-san-bong.search')}}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" style="max-width: 400px;" name="query" placeholder="Search for products">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Tìm</button>
                </div>
            </div>
        </form>

        <h3>Danh Sách Sân Bóng</h3>
            <form class="form-inline" method="get" action="{{route('admin.quan-li-san-bong.danh-sach')}}">
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
                <th>Tên sân</td>
                <th>Loại sân</th>
                <th>Địa Chỉ</th>
                <th>Hình ảnh</th>
                <th>Thao Tác</th>
            </tr>
          </thead>
            <tbody>
            @foreach($dsSanBong as $sanbong)
            <tr>
                <td>{{ $sanbong->ten_san }}</td>
                <td>{{ $sanbong->loai_san->loai_san }}</td>
                <td>{{ $sanbong->dia_chi }}</td>
                <td>@if($sanbong->hinh_anh)
                <img src="{{ asset($sanbong->hinh_anh) }}" alt="Hình ảnh tin tức" style="width:100px;height:100px">
                @endif </td>               
                <td><a href="{{route('quan-li-san-bong.cap-nhat',['id'=>$sanbong->id])}}"><button type="button" class="btn btn-success">Sửa</button></a>|<a href="{{route('admin.quan-li-san-bong.xoa',['id'=>$sanbong->id])}}"><button type="button" class="btn btn-success">Xóa</button></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="container mt-3">
</div>
</div>
</div>
<div class="container mt-3">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @if ($dsSanBong->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $dsSanBong->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Previous</span>
                </a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo; Previous</span>
            </li>
            @endif

            @for ($i = max(1, $dsSanBong->currentPage() - 1); $i <= min($dsSanBong->currentPage() + 1, $dsSanBong->lastPage()); $i++)
            <li class="page-item {{ $i == $dsSanBong->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $dsSanBong->url($i) }}">{{ $i }}</a>
            </li>
            @endfor

            @if ($dsSanBong->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $dsSanBong->nextPageUrl() }}" aria-label="Next">
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
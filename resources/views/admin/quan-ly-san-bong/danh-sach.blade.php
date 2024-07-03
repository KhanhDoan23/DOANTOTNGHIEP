@extends('admin.index')
@section('content')
<div id="content">
<div class="table-responsive">
        <table class="table table-striped table-sm" border="1">
        <div> 
            <a href="{{route('quan-li-san-bong.them-moi')}}"><button type="button" class="btn btn-info">Thêm Mới</button></a>
        </div>
        <form class="form-inline" action="{{ route('search') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" style="max-width: 400px;" name="query" placeholder="Search for products">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Tìm</button>
                </div>
            </div>
        </form>

        <h3>Danh Sách Sân Bóng</h3>
          <thead>
            <tr>
                <th>Tên sân</td>
                <th>Loại sân</th>
                <th>Hình ảnh</th>
                <th>Thao Tác</th>
            </tr>
          </thead>
            <tbody>
            @foreach($dsSanBong as $sanbong)
            <tr>
                <td>{{ $sanbong->ten_san }}</td>
                <td>{{ $sanbong->loai_san }}</td>
                <td>{{$sanbong->hinh_anh}}</td>                
                <td><a href="{{route('cap-nhat',['id'=>$sanbong->id])}}"><button type="button" class="btn btn-success">Sửa</button></a>|<a href="{{route('xoa',['id'=>$dsSanBong->id])}}"><button type="button" class="btn btn-success">Xóa</button></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="container mt-3">
</div>
</div>
</div>
@endsection
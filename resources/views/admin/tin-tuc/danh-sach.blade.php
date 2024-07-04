@extends('admin.index')

@section('content')
<div id="content">
<div class="table-responsive">
        <table class="table table-striped table-sm" border="1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Danh sách tin tức</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('tin-tuc.them-moi') }}"> Tạo tin tức mới</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Thời gian tạo</th>
                <th width="280px">Thao tác</th>
            </tr>
            @foreach ($news as $new)
            <tr>
                <td>{{ $new->id }}</td>
                <td>{{ $new->tieu_de }}</td>
                <td>{{ $new->noi_dung }}</td>
                <td>{{ $new->created_at->format('d-m-Y H:i:s') }}</td>
                <td>
                    <form action="{{ route('tin-tuc.xoa',$new->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('tin-tuc.chi-tiet',$new->id) }}">Xem</a>
                        <a class="btn btn-primary" href="{{ route('tin-tuc.cap-nhat',$new->id) }}">Sửa</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        {!! $news->links() !!}
    </div>
    </table>
    </div>
    </div>
@endsection

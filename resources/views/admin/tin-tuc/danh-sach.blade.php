@extends('admin.index')

@section('content')
<div id="content">
<div class="table-responsive">
        <table class="table table-striped table-sm" border="1">
        <form class="form-inline" action="{{route('admin.tin-tuc.search')}}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" style="max-width: 400px;" name="query" placeholder="Search for products">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Tìm</button>
                </div>
            </div>
        </form>
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
    <div class="container mt-3">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @if ($news->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $news->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Previous</span>
                </a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo; Previous</span>
            </li>
            @endif

            @for ($i = max(1, $news->currentPage() - 1); $i <= min($news->currentPage() + 1, $news->lastPage()); $i++)
            <li class="page-item {{ $i == $news->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $news->url($i) }}">{{ $i }}</a>
            </li>
            @endfor

            @if ($news->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $news->nextPageUrl() }}" aria-label="Next">
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

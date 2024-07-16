@extends('master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thanh toán thành công</div>

                <div class="card-body text-center">
                    <h5 class="text-success"><i class="fas fa-check-circle fa-3x"></i></h5>
                    <p>Cảm ơn bạn đã thanh toán thành công!</p>
                    <a href="{{ route('user.index') }}" class="btn btn-primary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


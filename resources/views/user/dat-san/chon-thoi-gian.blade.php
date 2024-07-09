@extends('master')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chọn thời gian đặt sân - {{ $dsSanBong->ten_san }}</div>
               
                <div class="card-body">
                    <form method="POST" action="{{ route('dat-san.store', ['id' => $dsSanBong->id]) }}">
                        @csrf
                        
                        <div class="form-group">
                        <label for="thoi_gian_bat_dau">Thời gian bắt đầu</label>
                        <input type="datetime-local" id="thoi_gian_bat_dau" name="tg_bat_dau" class="form-control" step="1800" required>
                    </div>

                    <div class="form-group">
                        <label for="thoi_gian_ket_thuc">Thời gian kết thúc</label>
                        <input type="datetime-local" id="thoi_gian_ket_thuc" name="tg_ket_thuc" class="form-control" step="1800" required>
                    </div>
                    @if(auth('cus')->check())
                        <h5>Thời gian đã đặt</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Thời gian kết thúc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lichDatSan as $lich)
                                    <tr>
                                        <td>{{ $lich->tg_bat_dau }}</td>
                                        <td>{{ $lich->tg_ket_thuc }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                        <h5>Thời gian còn trống</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Thời gian kết thúc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tatCaThoiGian as $thoiGian)
                                    <tr>
                                        <td>{{ $thoiGian['bat_dau'] }}</td>
                                        <td>{{ $thoiGian['ket_thuc'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Đặt sân</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>

function formatDateToISO(date) {
    return date.toISOString().slice(0, 16);
}

function isPastDate(date) {
    var currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0);
    
    var selectedDate = new Date(date);
    selectedDate.setHours(0, 0, 0, 0);
    
    return selectedDate < currentDate;
}

document.getElementById('thoi_gian_bat_dau').addEventListener('change', function() {
    var selectedStartDate = new Date(this.value);
    
    if (isPastDate(selectedStartDate)) {
        alert('Không thể đặt sân cho ngày trong quá khứ.');
        this.value = ''; 
        return;
    }
    
    var selectedEndDate = new Date(document.getElementById('thoi_gian_ket_thuc').value);
    
    if (selectedStartDate >= selectedEndDate) {
        alert('Thời gian kết thúc phải sau thời gian bắt đầu.');
        return;
    }
    var lichDatSan = {!! json_encode($lichDatSan) !!};
    var conflictFound = false;
    
    lichDatSan.forEach(function(item) {
        var existingStartDate = new Date(item.tg_bat_dau);
        var existingEndDate = new Date(item.tg_ket_thuc);
        
        if ((selectedStartDate >= existingStartDate && selectedStartDate < existingEndDate) ||
            (selectedEndDate > existingStartDate && selectedEndDate <= existingEndDate)) {
            conflictFound = true;
            return;
        }
    });
    
    if (conflictFound) {
        alert('Thời gian này đã có người đặt sân. Vui lòng chọn thời gian khác.');
        this.value = ''; 
        return;
    }
    updateEndTimeOptions(selectedStartDate, selectedEndDate);
});

document.getElementById('thoi_gian_ket_thuc').addEventListener('change', function() {
    var selectedEndDate = new Date(this.value);
    var selectedStartDate = new Date(document.getElementById('thoi_gian_bat_dau').value);
    
    if (selectedStartDate >= selectedEndDate) {
        alert('Thời gian kết thúc phải sau thời gian bắt đầu.');
        return;
    }
    

    if (isPastDate(selectedEndDate)) {
        alert('Không thể đặt sân cho ngày trong quá khứ.');
        this.value = ''; 
        return;
    }
});

window.onload = function() {
    var selectedStartDate = new Date(document.getElementById('thoi_gian_bat_dau').value);
    var selectedEndDate = new Date(document.getElementById('thoi_gian_ket_thuc').value);
    
    if (isPastDate(selectedStartDate)) {
        alert('Không thể đặt sân cho ngày trong quá khứ.');
        document.getElementById('thoi_gian_bat_dau').value = ''; 
    }
    
    if (isPastDate(selectedEndDate)) {
        alert('Không thể đặt sân cho ngày trong quá khứ.');
        document.getElementById('thoi_gian_ket_thuc').value = ''; 
    }
};
    </script>
@endsection

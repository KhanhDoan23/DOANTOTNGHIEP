@extends('admin.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Biểu đồ thống kê doanh thu</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="myChartThang"></canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="myChartNgay"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctxThang = document.getElementById('myChartThang').getContext('2d');
        var myChartThang = new Chart(ctxThang, {
            type: 'bar',
            data: {
                labels: {!! $doanhThuTheoThang->pluck('thang')->toJson() !!},
                datasets: [{
                    label: 'Doanh thu theo tháng (VNĐ)',
                    data: {!! $doanhThuTheoThang->pluck('tong_doanh_thu')->toJson() !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('en-US', { style: 'currency', currency: 'VND' });
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel.toLocaleString('en-US', { style: 'currency', currency: 'VND' });
                            }
                        }
                    }
                }
            }
        });

        var ctxNgay = document.getElementById('myChartNgay').getContext('2d');
        var myChartNgay = new Chart(ctxNgay, {
            type: 'bar',
            data: {
                labels: {!! $doanhThuTheoNgay->pluck('ngay')->toJson() !!},
                datasets: [{
                    label: 'Doanh thu theo ngày (VNĐ)',
                    data: {!! $doanhThuTheoNgay->pluck('tong_doanh_thu')->toJson() !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('en-US', { style: 'currency', currency: 'VND' });
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel.toLocaleString('en-US', { style: 'currency', currency: 'VND' });
                            }
                        }
                    }
                }
            }
        });
        
    });
</script>
@endsection

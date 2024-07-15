@extends('admin.index')

@section('content')
    <div class="row row-card-no-pd">
    <div class="col-md-12">
            <form action="{{ route('admin.thong-ke-san') }}" method="GET">
                <div class="form-group">
                    <label for="ngay_thang_nam">Lọc ngày tháng năm:</label>
                    <input type="date" id="ngay_thang_nam" name="ngay_thang_nam" class="form-control" value="{{ $ngayThangNam ?? '' }}">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i>Lọc</button>
                <a href="{{ route('admin.thong-ke-san') }}" class="btn btn-secondary"><i class="fas fa-sync"></i>Hiển thị thống kê tháng</a>
            </form>
        </div>
              <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h6><b>Sân đã đặt</b></h6>
                        <p class="text-muted">Số lượng sân đã đặt</p>
                      </div>
                      <h4 class="text-info fw-bold">{{ $sanDaDat }}</h4>
                      @if($sanDaDat > 0)
                      <a href="{{ route('admin.danhsach') }}">
                          <button class="btn btn-primary">Xem</button>
                      </a>
                      @endif
                    </div>
                    <div class="progress progress-sm">
                      <div
                        class="progress-bar bg-info w-100"
                        role="progressbar"
                        aria-valuenow="100"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                      <p class="text-muted mb-0"></p>
                      <p class="text-muted mb-0"></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h6><b>Người đã đặt</b></h6>
                        <p class="text-muted">Số lượng người đã đặt</p>
                      </div>
                      <h4 class="text-success fw-bold">{{ $nguoiDatSan }}</h4>
                      @if($nguoiDatSan > 0)
                      <a href="{{ route('admin.danhsach') }}">
                          <button class="btn btn-success">Xem</button>
                      </a>
                      @endif
                    </div>
                    <div class="progress progress-sm">
                      <div
                        class="progress-bar bg-success w-100"
                        role="progressbar"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                      <p class="text-muted mb-0"></p>
                      <p class="text-muted mb-0"></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h6><b>Sân đã huỷ</b></h6>
                        <p class="text-muted">Số lượng sân bị huỷ</p>
                      </div>
                      <h4 class="text-danger fw-bold">{{ $sanDaHuy }}</h4>
                      @if($sanDaHuy > 0)
                      <a href="{{ route('admin.danhsach') }}">
                          <button class="btn btn-danger">Xem</button>
                      </a>
                      @endif
                    </div>
                    <div class="progress progress-sm">
                      <div
                        class="progress-bar bg-danger w-100"
                        role="progressbar"
                        aria-valuenow="50"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                      <p class="text-muted mb-0"></p>
                      <p class="text-muted mb-0"></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h6><b>Tổng số thành viên</b></h6>
                        <p class="text-muted">Tổng số thành viên đã đăng ký</p>
                      </div>
                      <h4 class="text-secondary fw-bold">{{ $userDangKy}}</h4>
                      @if($userDangKy > 0)
                      <a href="{{ route('admin.quan-ly-user') }}">
                          <button class="btn btn-secondary">Xem</button>
                      </a>
                      @endif
                    </div>
                    <div class="progress progress-sm">
                      <div
                        class="progress-bar bg-secondary w-100"
                        role="progressbar"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                      <p class="text-muted mb-0"></p>
                      <p class="text-muted mb-0"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection

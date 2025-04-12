@extends('admins.layouts.main')

@section('title', 'Tạo mới khách hàng')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-user-plus"></i> Tạo khách hàng </h3>
</div>

<div class="row mt-3">
    <div class="col-12 mb-4 mb-lg-0">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('admins.customers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Họ tên -->
                        <div class="mb-3 row">
                            <label for="ho_ten" class="col-4 col-form-label">Họ và tên</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="ho_ten" id="ho_ten" value="{{ old('ho_ten') }}" />
                            </div>
                            @error('ho_ten')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3 row">
                            <label for="email" class="col-4 col-form-label">Email</label>
                            <div class="col-8">
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" />
                            </div>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Số điện thoại -->
                        <div class="mb-3 row">
                            <label for="so_dien_thoai" class="col-4 col-form-label">Số điện thoại</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="so_dien_thoai" id="so_dien_thoai" value="{{ old('so_dien_thoai') }}" />
                            </div>
                            @error('so_dien_thoai')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Địa chỉ -->
                        <div class="mb-3 row">
                            <label for="dia_chi" class="col-4 col-form-label">Địa chỉ</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="dia_chi" id="dia_chi" value="{{ old('dia_chi') }}" />
                            </div>
                            @error('dia_chi')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hình ảnh -->
                        <div class="mb-3 row">
                            <label for="hinh_anh" class="col-4 col-form-label">Hình ảnh</label>
                            <div class="col-8">
                                <input type="file" class="form-control" name="hinh_anh" id="hinh_anh" />
                            </div>
                            @error('hinh_anh')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit buttons -->
                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-info">
                                    Tạo mới
                                </button>

                                <a href="/admins/customers" class="btn btn-warning">
                                    Quay lại trang danh sách
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.25.0/ckeditor.js"></script>

<script>
    CKEDITOR.replace('mo_ta');
</script>
@endsection

@extends('admins.layouts.main')

@section('title')

@endsection

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Tạo sản phẩm </h3>
</div>

<div class="row mt-3">
    <div class="col-12 mb-4 mb-lg-0">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('admins.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Mã sản phẩm -->
                        <div class="mb-3 row">
                            <label for="ma_san_pham" class="col-4 col-form-label">Mã sản phẩm</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="ma_san_pham" id="ma_san_pham" value="{{ old('ma_san_pham') }}" />
                            </div>
                            @error('ma_san_pham')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tên sản phẩm -->
                        <div class="mb-3 row">
                            <label for="ten_san_pham" class="col-4 col-form-label">Tên sản phẩm</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="ten_san_pham" id="ten_san_pham" value="{{ old('ten_san_pham') }}" />
                            </div>
                            @error('ten_san_pham')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Danh mục -->
                        <div class="mb-3 row">
                            <label for="ma_danh_muc" class="col-4 col-form-label">Danh mục</label>
                            <div class="col-8">
                                <select class="form-select" name="ma_danh_muc" id="ma_danh_muc">
                                    <option selected>Chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}" {{ old('ma_danh_muc') == $category['id'] ? 'selected' : '' }}>
                                            {{ $category['ten_danh_muc'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ma_danh_muc')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3 row">
                            <label for="mo_ta" class="col-4 col-form-label">Mô tả</label>
                            <div class="col-8">
                                <textarea class="form-control" name="mo_ta" id="mo_ta">{{ old('mo_ta') }}</textarea>
                            </div>
                            @error('mo_ta')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ngày nhập -->
                        <div class="mb-3 row">
                            <label for="ngay_nhap" class="col-4 col-form-label">Ngày nhập</label>
                            <div class="col-8">
                                <input type="date" class="form-control" name="ngay_nhap" id="ngay_nhap" value="{{ old('ngay_nhap') }}" />
                            </div>
                            @error('ngay_nhap')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hình ảnh -->
                        <div class="mb-3 row">
                            <label for="hinh_anh" class="col-4 col-form-label">Hình ảnh</label>
                            <div class="col-8">
                                <input type="file" class="form-control" name="hinh_anh" id="hinh_anh">
                            </div>
                            @error('hinh_anh')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Giá -->
                        <div class="mb-3 row">
                            <label for="gia" class="col-4 col-form-label">Giá</label>
                            <div class="col-8">
                                <input type="number" class="form-control" name="gia" id="gia" value="{{ old('gia') }}" min="0" max="99999999" />
                            </div>
                            @error('gia')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Giá khuyến mãi -->
                        <div class="mb-3 row">
                            <label for="gia_khuyen_mai" class="col-4 col-form-label">Giá khuyến mãi</label>
                            <div class="col-8">
                                <input type="number" class="form-control" name="gia_khuyen_mai" id="gia_khuyen_mai" value="{{ old('gia_khuyen_mai') }}" min="0" />
                            </div>
                            @error('gia_khuyen_mai')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Số lượng -->
                        <div class="mb-3 row">
                            <label for="so_luong" class="col-4 col-form-label">Số lượng</label>
                            <div class="col-8">
                                <input type="number" class="form-control" name="so_luong" id="so_luong" value="{{ old('so_luong') }}" min="1" />
                            </div>
                            @error('so_luong')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3 row">
                            <label for="trang_thai" class="col-4 col-form-label">Trạng thái</label>
                            <div class="col-8">
                                <input type="checkbox" class="form-checkbox" name="trang_thai" id="trang_thai" value="1" {{ old('trang_thai') ? 'checked' : '' }} /> Còn hàng
                                <input type="checkbox" class="form-checkbox ml-2" name="trang_thai" id="trang_thai" value="0" {{ old('trang_thai') ? 'checked' : '' }} /> Hết hàng
                            </div>
                            @error('trang_thai')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit buttons -->
                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-info">
                                    Tạo mới
                                </button>

                                <a href="/admin/products" class="btn btn-warning">
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

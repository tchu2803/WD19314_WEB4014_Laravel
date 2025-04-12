@extends('admins.layouts.main')

@section('title')
    Tạo danh mục
@endsection

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Tạo danh mục </h3>
</div>

<div class="row mt-3">
    <div class="col-12 mb-4 mb-lg-0">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('admins.categories.store') }}" method="POST">
                        @csrf
                        <!-- Tên danh mục -->
                        <div class="mb-3 row">
                            <label for="ten_danh_muc" class="col-4 col-form-label">Tên danh mục</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="ten_danh_muc" id="ten_danh_muc" value="{{ old('ten_danh_muc') }}" />
                            </div>
                            @error('ten_danh_muc')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3 row">
                            <label for="trang_thai" class="col-4 col-form-label">Trạng thái</label>
                            <div class="col-8">
                                <input type="checkbox" class="form-checkbox" name="trang_thai" id="trang_thai" value="1" {{ old('trang_thai') ? 'checked' : '' }} /> Hoạt động
                                <input type="checkbox" class="form-checkbox ml-2" name="trang_thai" id="trang_thai" value="0" {{ old('trang_thai') ? 'checked' : '' }} /> Không hoạt động
                            </div>
                            @error('trang_thai')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-info">
                                    Tạo mới
                                </button>

                                <a href="/admins/categories" class="btn btn-warning">
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

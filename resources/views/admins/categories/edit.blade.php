@extends('admins.layouts.main')

@section('title', 'Cập nhật danh mục')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-edit"></i> Sửa danh mục </h3>
</div>

<div class="row mt-3">
    <div class="col-12 mb-4 mb-lg-0">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('admins.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Tên danh mục -->
                        <div class="mb-3 row">
                            <label for="ten_danh_muc" class="col-4 col-form-label">Tên danh mục</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="ten_danh_muc" id="ten_danh_muc" value="{{ old('ten_danh_muc', $category->ten_danh_muc) }}" />
                            </div>
                            @error('ten_danh_muc')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3 row">
                            <label for="trang_thai" class="col-4 col-form-label">Trạng thái</label>
                            <div class="col-8">
                                <input type="checkbox" class="form-checkbox" name="trang_thai" id="trang_thai" value="1" {{ old('trang_thai', $category->trang_thai) == 1 ? 'checked' : '' }} /> Hoạt động
                                <input type="checkbox" class="form-checkbox ml-2" name="trang_thai" id="trang_thai" value="0" {{ old('trang_thai', $category->trang_thai) == 0 ? 'checked' : '' }} /> Không hoạt động
                            </div>
                            @error('trang_thai')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit buttons -->
                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-info">
                                    Cập nhật danh mục
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
    
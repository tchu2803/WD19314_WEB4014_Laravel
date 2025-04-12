@extends('admins.layouts.main')

@section('title', 'Cập nhật banner')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-edit"></i> Sửa banner</h3>
</div>

<div class="row mt-3">
    <div class="col-12 mb-4 mb-lg-0">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('admins.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Tên banner -->
                        <div class="mb-3 row">
                            <label for="ten_banner" class="col-4 col-form-label">Tên banner</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="ten_banner" id="ten_banner" value="{{ old('ten_banner', $banner->ten_banner) }}" />
                            </div>
                            @error('ten_banner')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3 row">
                            <label for="mo_ta" class="col-4 col-form-label">Mô tả</label>
                            <div class="col-8">
                                <textarea class="form-control" name="mo_ta" id="mo_ta">{{ old('mo_ta', $banner->mo_ta) }}</textarea>
                            </div>
                            @error('mo_ta')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hình ảnh -->
                        <div class="mb-3 row">
                            <label for="hinh_anh" class="col-4 col-form-label">Hình ảnh</label>
                            <div class="col-8">
                                <input type="file" class="form-control" name="hinh_anh" id="hinh_anh">
                                <br>
                                @if($banner->hinh_anh)
                                    <img src="{{ asset('storage/' . $banner->hinh_anh) }}" class="mt-2" width="100">
                                @endif
                            </div>
                            @error('hinh_anh')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit buttons -->
                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-info">
                                    Cập nhật banner
                                </button>

                                <a href="/admins/banners" class="btn btn-warning">
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

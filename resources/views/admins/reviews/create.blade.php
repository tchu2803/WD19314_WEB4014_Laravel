@extends('admins.layouts.main')

@section('title')
    Tạo đánh giá
@endsection

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Tạo đánh giá </h3>
</div>

<div class="row mt-3">
    <div class="col-12 mb-4 mb-lg-0">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('admins.reviews.store') }}" method="POST">
                        @csrf
                        
                        <!-- Đánh giá -->
                        <div class="mb-3 row">
                            <label for="danh_gia" class="col-4 col-form-label">Đánh giá</label>
                            <div class="col-8">
                                <textarea class="form-control" name="danh_gia" id="danh_gia">{{ old('danh_gia') }}</textarea>
                            </div>
                            @error('danh_gia')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Số sao -->
                        <div class="mb-3 row">
                            <label for="so_sao" class="col-4 col-form-label">Số sao</label>
                            <div class="col-8">
                                <input type="number" class="form-control" name="so_sao" id="so_sao" value="{{ old('so_sao') }}" min="1" max="5" />
                            </div>
                            @error('so_sao')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-info">
                                    Tạo mới
                                </button>

                                <a href="/admins/reviews" class="btn btn-warning">
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

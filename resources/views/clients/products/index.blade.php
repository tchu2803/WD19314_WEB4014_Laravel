@extends('clients.layouts.main')

@section('content')
<div class="container px-4 px-lg-5 mt-4">

    <h2 class="fw-bold mb-4">Danh sách sản phẩm</h2>

    <!-- Bộ lọc -->
    <form method="GET" action="{{ route('clients.products.index') }}" class="mb-4">
        <div class="row g-3">
            <!-- Tìm kiếm theo tên -->
            <div class="col-md-3">
                <input type="text" name="ten_san_pham" class="form-control" placeholder="Tên sản phẩm" value="{{ request('ten_san_pham') }}">
            </div>

            <!-- Lọc theo danh mục -->
            <div class="col-md-3">
                <select name="ma_danh_muc" class="form-control">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('ma_danh_muc') == $category->id ? 'selected' : '' }}>
                            {{ $category->ten_danh_muc }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Lọc theo khoảng giá -->
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="Giá thấp nhất" value="{{ request('min_price') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control" placeholder="Giá cao nhất" value="{{ request('max_price') }}">
            </div>
            
            {{-- Sắp xếp theo giá --}}
            <div class="col-md-2">
                <select name="sort_price" class="form-control">
                    <option value="">Sắp xếp theo giá</option>
                    <option value="asc" {{ request('sort_price') == 'asc' ? 'selected' : '' }}>Giá tăng dần</option>
                    <option value="desc" {{ request('sort_price') == 'desc' ? 'selected' : '' }}>Giá giảm dần</option>
                </select>
            </div>

            <!-- Nút tìm kiếm -->
            <div class="col-md-2 d-flex">
                <button type="submit" class="btn btn-dark w-100 me-1">
                    <i class="fas fa-search"></i> Tìm
                </button>
                <a href="{{ route('clients.products.index') }}" class="btn btn-secondary w-100 ms-1">
                    <i class="fas fa-sync"></i> Reset
                </a>
            </div>
        </div>
    </form>

    <!-- Danh sách sản phẩm -->
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        @foreach ($products as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Hình ảnh -->
                    <div style="height: 200px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $product->hinh_anh) }}" class="card-img-top" style="object-fit: cover; height: 100%; width: 100%;">
                    </div>

                    <!-- Thông tin sản phẩm -->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $product->ten_san_pham }}</h5>
                            @if ($product->gia_khuyen_mai > 0)
                                <span class="text-muted text-decoration-line-through">{{ number_format($product->gia) }} VNĐ</span>
                                <span class="ms-2 text-danger">{{ number_format($product->gia_khuyen_mai) }} VNĐ</span>
                            @else
                                <span>{{ number_format($product->gia) }} VNĐ</span>
                            @endif
                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-outline-dark mt-auto" href="{{ route('clients.products.show', $product->id) }}">Xem</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

<!-- Phân trang -->
@if ($products->hasPages())
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            {{-- Nút Previous --}}
            @if ($products->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Trước</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">Trước</a></li>
            @endif

            {{-- Các trang --}}
            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Nút Next --}}
            @if ($products->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">Sau</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Sau</span></li>
            @endif
        </ul>
    </nav>
@endif

</div>
@endsection

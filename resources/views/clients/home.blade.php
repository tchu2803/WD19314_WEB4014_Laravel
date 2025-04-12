@extends('clients.layouts.main')

@section('content')
    <section class="py-3">
        <div class="container px-4 px-lg-5">
            <div class="banner-container">
                <style>
                    .carousel-item {
                        height: 400px;
                    }
                    .carousel-item img {
                        object-fit: cover;
                        height: 100%;
                        width: 100%;
                        border-radius: 10px; 
                    }
                </style>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($banners as $key => $banner)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach($banners as $key => $banner)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $banner->hinh_anh) }}" class="d-block w-100" alt="{{ $banner->name ?? 'Banner' }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <h2 class="fw-bold mb-4">Sản phẩm nổi bật</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                    {{-- @if($product->hinh_anh) --}}
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <div style="height: 200px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $product->hinh_anh) }}" class="card-img-top" style="object-fit: cover; height: 100%; width: 100%;">
                            </div>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->ten_san_pham }}</h5>
                                    <!-- Product price-->
                                    @if (isset($product->gia_khuyen_mai) && $product->gia_khuyen_mai > 0)
                                        <span class="text-muted text-decoration-line-through">{{ number_format($product->gia) }} VNĐ</span>
                                        <span class="ms-2 text-danger mr-2">{{ number_format($product->gia_khuyen_mai) }} VNĐ</span>
                                    @else
                                        <span>{{ number_format($product->gia) }} VNĐ</span>
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="{{ route('clients.products.show', $product->id) }}">Xem</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endif --}}
                @endforeach
            </div>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5">
            <h2 class="fw-bold mb-4">Bài viết mới nhất</h2>
            <div class="row">
                @foreach ($posts as $post)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->tieu_de }}</h5>
                            <a href="#" class="btn btn-sm btn-outline-primary mt-2">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <h2 class="fw-bold mb-4">Đánh giá từ khách hàng</h2>
            <div class="row">
                @foreach ($reviews as $review)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title">{{ $review->user->name ?? 'Ẩn danh'}}</h5>
                                <div>
                                    @if ($review->so_sao)
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->so_sao)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-warning"></i>
                                            @endif
                                        @endfor
                                    @else
                                        <span class="text-muted">Chưa có đánh giá</span>
                                    @endif
                                </div>
                            </div>
                            <h5 class="card-title">{{ $review->product->ten_san_pham ?? 'Ẩn danh'}}</h5>
                            <p class="card-text">{{ $review->danh_gia }}</p>
                            <div class="text-muted small">{{ $review->created_at }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@extends('clients.layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Chi tiết sản phẩm -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="border rounded shadow-sm p-2" style="max-width: 100%; max-height: 500px;">
                <img src="{{ asset('storage/' . $product->hinh_anh) }}" 
                     class="img-fluid rounded" 
                     style="max-height: 480px; object-fit: contain;">
            </div>
        </div>        
        <div class="col-md-6 fst-italic">
            <div class="product-info">
                <h2 class="fw-bold mb-3">{{ $product->ten_san_pham }}</h2>
            
                <p class="mb-2">
                    <strong>Danh mục:</strong> 
                    <span class="text-primary">{{ $product->category->ten_danh_muc ?? 'Không có' }}</span>
                </p>
            
                <p class="mb-2">
                    <strong>Giá:</strong>
                    @if ($product->gia_khuyen_mai > 0)
                        <span class="text-muted text-decoration-line-through">{{ number_format($product->gia) }} VNĐ</span>
                        <span class="text-danger fw-bold ms-2">{{ number_format($product->gia_khuyen_mai) }} VNĐ</span>
                    @else
                        <span class="fw-bold text-dark">{{ number_format($product->gia) }} VNĐ</span>
                    @endif
                </p>
            
                <p class="mb-2">
                    <strong>Trạng thái:</strong>
                    @if($product->trang_thai == 1)
                        <span class="badge bg-success">Còn hàng</span>
                    @else
                        <span class="badge bg-danger">Hết hàng</span>
                    @endif
                </p>

                @if($product->trang_thai == 1)
                    <form action="#" method="POST" class="mt-3">
                        @csrf

                        <div class="form-group mb-0">
                            <label for="so_luong" class="form-label mb-1"><strong>Số lượng:</strong></label>
                            <input type="number" name="so_luong" id="so_luong" class="form-control" value="1" min="1" max="99" style="width: 100px;">
                        </div>
                        <button type="submit" class="btn btn-dark btn-lg mt-3">
                            <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ hàng
                        </button>
                    </form>
                @else
        <button class="btn btn-secondary btn-lg" disabled>
            <i class="bi bi-cart-x"></i> Tạm hết hàng
        </button>
    @endif
            </div>
            
        </div>
        <div class="mt-4 fst-italic">
            <h4 class="fw-bold mb-3">Mô tả sản phẩm</h4>
            <div class="card shadow-sm">
                <div class="card-body">
                    {!! nl2br(e($product->mo_ta)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Sản phẩm liên quan -->
    <h3 class="mt-5 fst-italic">Sản phẩm cùng danh mục</h3>
    <div class="row mt-3">
        @foreach ($relatedProducts as $item)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $item->hinh_anh) }}" class="card-img-top" alt="{{ $item->ten_san_pham }}" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->ten_san_pham }}</h5>
                        <p>{{ number_format($item->gia_khuyen_mai > 0 ? $item->gia_khuyen_mai : $item->gia) }} VNĐ</p>
                        <a href="{{ route('clients.products.show', $item->id) }}" class="btn btn-outline-dark btn-sm">Xem</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Đánh giá sản phẩm -->
<!-- Đánh giá sản phẩm -->
<hr>
<h3 class="mt-5">Đánh giá sản phẩm</h3>

@auth
    <!-- Form gửi đánh giá -->
    <form action="{{ route('clients.products.store' , ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="row">
            <div class="col-md-3">
                <label for="so_sao" class="form-label"><strong>Chọn số sao:</strong></label>
                <select name="so_sao" id="so_sao" class="form-select" required>
                    <option value="">-- Chọn --</option>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }} sao</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-9">
                <label for="danh_gia" class="form-label"><strong>Nhận xét của bạn:</strong></label>
                <textarea name="danh_gia" id="danh_gia" class="form-control" rows="3" placeholder="Nhập đánh giá..." required></textarea>
            </div>
        </div>
        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-send me-1"></i> Gửi đánh giá
            </button>
        </div>
    </form>
@endauth

@guest
    <div class="alert alert-warning">
        <i class="bi bi-lock-fill"></i> Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đánh giá sản phẩm.
    </div>
@endguest

{{-- Danh sách đánh giá --}}
@forelse ($reviews as $review)
    <div class="card mb-3">
        <div class="card-body">
            <strong class="fst-italic">{{ $review->user->name ?? 'Ẩn danh' }}</strong> 
            <span class="text-warning ml-2">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="bi {{ $i <= $review->so_sao ? 'bi-star-fill' : 'bi-star' }}"></i>
                @endfor
            </span>
            <p class="mb-1 mt-2 fst-italic">{{ $review->danh_gia }}</p>
            <small class="text-muted fst-italic">{{ $review->created_at->format('d/m/Y H:i') }}</small>
        </div>
    </div>
@empty
    <p>Chưa có đánh giá nào.</p>
@endforelse

</div>
@endsection

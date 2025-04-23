@extends('clients.layouts.main')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold fst-italic text-primary">🛒 Giỏ hàng của bạn</h2>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn btn-outline-success btn-close ml-2" data-bs-dismiss="alert" aria-label="Close">Đóng</button>
        </div>
    @endif
    
    @php
        // Lấy ID của người dùng đang đăng nhập
        $currentUserId = Auth::id();
        // Lọc danh sách giỏ hàng theo ID người dùng
        $userCartItems = $cartItems->where('ma_khach_hang', $currentUserId);
    @endphp
    
    @if($userCartItems->count() > 0)
        <div class="cart-items-container mb-4">
            <div class="row bg-primary bg-opacity-10 py-3 mb-3 rounded d-none d-md-flex">
                <div class="col-md-6 fw-bold text-primary">Sản phẩm</div>
                <div class="col-md-2 text-center fw-bold text-primary">Giá</div>
                <div class="col-md-2 text-center fw-bold text-primary">Số lượng</div>
                <div class="col-md-2 text-end fw-bold text-primary">Thành tiền</div>
            </div>
            
            @php $total = 0; @endphp
            @foreach($userCartItems as $item)
                @php
                    $price = $item->gia_khuyen_mai ?? $item->gia;
                    $subtotal = $price * $item->so_luong;
                    $total += $subtotal;
                @endphp
                <div class="card mb-3 border-0 shadow-sm hover-shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="me-3" style="width: 80px;">
                                        <img src="{{ asset('storage/' . $item->product->hinh_anh) }}" 
                                             alt="{{ $item->product->ten_san_pham }}" 
                                             class="img-fluid rounded shadow-sm" 
                                             style="max-height: 80px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fst-italic fw-bold text-primary">{{ $item->product->ten_san_pham }}</h5>
                                        <div class="d-md-none mt-2">
                                            <span class="badge bg-primary bg-opacity-10 text-primary">{{ number_format($price, 0, ',', '.') }}đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 text-md-center my-2 my-md-0">
                                <div class="d-md-none text-muted">Giá:</div>
                                <div class="text-secondary">{{ number_format($price, 0, ',', '.') }}đ</div>
                            </div>
                            <div class="col-md-2 text-md-center my-2 my-md-0">
                                <div class="d-md-none text-muted">Số lượng:</div>
                                <div class="quantity-control d-flex align-items-center justify-content-md-center">
                                    <form action="{{ route('clients.carts.update' , $item->id)}}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="decrease" value="1" class="btn btn-sm btn-outline-primary rounded-circle">-</button>
                                        <span class="mx-2 fw-medium">{{ $item->so_luong }}</span>
                                        <button type="submit" name="increase" value="1" class="btn btn-sm btn-outline-primary rounded-circle">+</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-2 text-md-end my-2 my-md-0">
                                <div class="d-md-none text-muted">Thành tiền:</div>
                                <div class="fw-bold text-danger">{{ number_format($subtotal, 0, ',', '.') }}đ</div>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <form action="{{ route('clients.carts.delete' , $item->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                    <i class="bi bi-trash"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <div class="card border-0 shadow mt-4">
                <div class="card-body bg-light bg-opacity-50 rounded">
                    <div class="row">
                        <div class="col-md-8 col-lg-9">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('clients.products.index') }}" class="btn btn-outline-primary rounded-pill">
                                    <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                                </a>
                                <button class="btn btn-outline-primary rounded-pill d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#orderSummary">
                                    <i class="bi bi-receipt"></i> Xem tổng đơn hàng
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3 mt-3 mt-md-0 collapse d-md-block" id="orderSummary">
                            <div class="border-start ps-md-3">
                                <h5 class="fw-bold text-primary">Tổng tiền đơn hàng</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tạm tính:</span>
                                    <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Tổng cộng:</span>
                                    <span class="fw-bold text-primary fs-5">{{ number_format($total, 0, ',', '.') }}đ</span>
                                </div>
                                <form action="{{ route('clients.orders.index')}}" method="GET" class="mt-3">
                                    <button type="submit" class="btn btn-primary w-100 shadow rounded-pill">
                                        <i class="bi bi-bag-check-fill me-1"></i> Tiến hành đặt hàng
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body py-5 text-center bg-light bg-opacity-50 rounded">
                <i class="bi bi-cart-x fs-1 text-primary mb-3"></i>
                <h4 class="fst-italic mb-3 text-primary">Giỏ hàng của bạn đang trống</h4>
                <p class="text-secondary">Hãy thêm sản phẩm vào giỏ hàng để tiến hành đặt hàng</p>
                <a href="{{ route('clients.products.index') }}" class="btn btn-primary rounded-pill">
                    <i class="bi bi-bag"></i> Tiếp tục mua sắm
                </a>
            </div>
        </div>
    @endif
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-3px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transition: all .3s ease;
    }
    
    .btn-outline-primary, .btn-primary {
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary:hover {
        transform: translateY(-2px);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #4e73df, #5a85eb);
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(45deg, #3a64d8, #4e73df);
        transform: translateY(-2px);
    }
    
    .card {
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    @media (max-width: 767.98px) {
        .cart-items-container .card-body {
            padding: 1rem;
        }
    }
</style>
@endsection
@extends('admins.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Quản lý sản phẩm</h3>
</div>
    {{-- Hiển thị thông báo --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn btn-outline-dark btn-close ml-2" data-bs-dismiss="alert"  aria-label="Close">Đóng</button>
        </div>
    
    @endif
    <a href="{{ route('admins.products.create') }}" class="btn btn-info mt-3">Thêm sản phẩm</a>
    <form action="{{ route('admins.products.thungrac') }}" method="GET" class="d-inline">
        @csrf

        <button type="submit" class="btn btn-outline btn-danger mt-3">Thùng rác</button>
    </form>
    <!-- Form tìm kiếm -->
    <div class="card shadow-sm mb-4 mt-3">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm sản phẩm</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admins.products.index') }}">
                <div class="row g-3">
                    <!-- Mã sản phẩm -->
                    <div class="col-md-3">
                        <label class="form-label">Mã sản phẩm</label>
                        <input type="text" name="ma_san_pham" class="form-control" placeholder="Nhập mã sản phẩm bạn cần tìm"
                            value="{{ request('ma_san_pham') }}">
                    </div>

                    <!-- Nút tìm kiếm & Làm mới -->
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100 me-1">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admins.products.index') }}" class="btn btn-secondary w-100 ms-1 ml-2">
                            <i class="fas fa-sync m"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h1 class="h3">Danh sách sản phẩm</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Mã sản phẩm</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Giá khuyến mãi</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Ngày nhập</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr class="">
                    <td scope="row">{{ $product->ma_san_pham }}</td>
                    <td>
                        @if (isset($product->hinh_anh))
                        <img src="{{ asset('storage/' . $product->hinh_anh) }}" width="100px" alt="{{ $product->ten_san_pham }}">
                        @else
                        <img src="" alt="">
                        @endif
                    </td>
                    <td>{{ $product->ten_san_pham }}</td>
                    <td>{{ $product->gia }} đ</td>
                    <td>{{ $product->gia_khuyen_mai }} đ</td>
                    <td>{{ $product->so_luong }}</td>
                    <td>{{ $product->ngay_nhap }}</td>
                    <td>
                        <a href="{{ route('admins.products.show', $product->id) }}" class="btn btn-success btn-sm">Xem</a>
                        <a href="{{ route('admins.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admins.products.destroy', $product->id) }}" method="post" class="d-inline" onsubmit="return confirm('Bạn có muốn xóa không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

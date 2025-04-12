@extends('admins.layouts.main')

@section('title', 'Danh sách đánh giá')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Quản lý đánh giá</h3>
</div>
    {{-- Hiển thị thông báo --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn btn-outline-dark btn-close ml-2" data-bs-dismiss="alert"  aria-label="Close">Đóng</button>
        </div>
    
    @endif
    <a href="{{ route('admins.reviews.create') }}" class="btn btn-info mt-3">Thêm đánh giá</a>
    <form action="{{ route('admins.reviews.thungrac') }}" method="GET" class="d-inline">
        @csrf

        <button type="submit" class="btn btn-outline btn-danger mt-3">Thùng rác</button>
    </form>
    <!-- Form tìm kiếm -->
    <div class="card shadow-sm mb-4 mt-3">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm đánh giá</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admins.reviews.index') }}">
                <div class="row g-3">
                    <!-- Mã sản phẩm -->
                    <div class="col-md-3">
                        <label class="form-label">Số sao</label>
                        <input type="text" name="so_sao" class="form-control" placeholder="Nhập đánh giá bạn cần tìm"
                            value="{{ request('so_sao') }}">
                    </div>

                    <!-- Nút tìm kiếm & Làm mới -->
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100 me-1">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admins.reviews.index') }}" class="btn btn-secondary w-100 ms-1 ml-2">
                            <i class="fas fa-sync m"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h1 class="h3">Danh sách đánh giá</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Đánh giá</th>
                    <th scope="col">Số sao</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                <tr class="">
                    <td scope="row">{{ $review->id }}</td>
                    <td>{{ $review->danh_gia }}</td>
                    <td>{{ $review->so_sao }}</td>
                    <td>{{ $review->created_at }}</td>
                    <td>
                        <a href="{{ route('admins.reviews.show', $review->id) }}" class="btn btn-success btn-sm">Xem</a>
                        <a href="{{ route('admins.reviews.edit', $review->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admins.reviews.destroy', $review->id) }}" method="post" class="d-inline" onsubmit="return confirm('Bạn có muốn xóa không?')">
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

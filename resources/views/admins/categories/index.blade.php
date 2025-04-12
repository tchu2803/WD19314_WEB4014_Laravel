@extends('admins.layouts.main')

@section('title')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Quản lý danh mục</h3>
</div>
    {{-- Hiển thị thông báo --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn btn-outline-dark btn-close ml-2" data-bs-dismiss="alert"  aria-label="Close">Đóng</button>
        </div>
    
    @endif
    <a href="{{ route('admins.categories.create') }}" class="btn btn-info mt-3">Thêm danh mục</a>
    <form action="{{ route('admins.categories.thungrac') }}" method="GET" class="d-inline">
        @csrf

        <button type="submit" class="btn btn-outline btn-danger mt-3">Thùng rác</button>
    </form>
    <!-- Form tìm kiếm -->
    <div class="card shadow-sm mb-4 mt-3">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm danh mục</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admins.categories.index') }}">
                <div class="row g-3">
                    <!-- Mã sản phẩm -->
                    <div class="col-md-3">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" name="ten_danh_muc" class="form-control" placeholder="Nhập tên danh mục bạn cần tìm"
                            value="{{ request('ten_danh_muc') }}">
                    </div>

                    <!-- Nút tìm kiếm & Làm mới -->
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100 me-1">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admins.categories.index') }}" class="btn btn-secondary w-100 ms-1 ml-2">
                            <i class="fas fa-sync m"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h1 class="h3">Danh sách danh mục</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="">
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->ten_danh_muc}}</td>
                    <td>
                        @if($category->trang_thai == 1)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-danger">Không hoạt động</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admins.categories.show', $category->id) }}" class="btn btn-success btn-sm">Xem</a>
                        <a href="{{ route('admins.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admins.categories.destroy', $category->id) }}" method="post" class="d-inline" onsubmit="return confirm('Bạn có muốn xóa không?')">
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

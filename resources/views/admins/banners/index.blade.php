@extends('admins.layouts.main')

@section('title', 'Danh sách Banner')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-image"></i> Quản lý Banner</h3>
</div>

{{-- Hiển thị thông báo --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn btn-outline-dark btn-close ml-2" data-bs-dismiss="alert" aria-label="Close">Đóng</button>
    </div>
@endif

<a href="{{ route('admins.banners.create') }}" class="btn btn-info mt-3">Thêm Banner</a>
<form action="{{ route('admins.banners.thungrac') }}" method="GET" class="d-inline">
    @csrf

    <button type="submit" class="btn btn-outline btn-danger mt-3">Thùng rác</button>
</form>

<!-- Form tìm kiếm -->
<div class="card shadow-sm mb-4 mt-3">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm Banner</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admins.banners.index') }}">
            <div class="row g-3">
                <!-- Tên Banner -->
                <div class="col-md-3">
                    <label class="form-label">Tên Banner</label>
                    <input type="text" name="ten_banner" class="form-control" placeholder="Nhập tên banner bạn cần tìm"
                        value="{{ request('ten_banner') }}">
                </div>

                <!-- Nút tìm kiếm & Làm mới -->
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-dark w-100 me-1">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                    <a href="{{ route('admins.banners.index') }}" class="btn btn-secondary w-100 ms-1 ml-2">
                        <i class="fas fa-sync m"></i> Làm mới
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<h1 class="h3">Danh sách Banner</h1>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
            <tr class="">
                <td scope="row">{{ $banner->id }}</td>
                <td>{{ $banner->ten_banner }}</td>
                <td>
                    @if (isset($banner->hinh_anh))
                        <img src="{{ asset('storage/' . $banner->hinh_anh) }}" width="100px" alt="{{ $banner->ten_banner }}">
                    @else
                        <img src="" alt="">
                    @endif
                </td>
                <td>{{ $banner->mo_ta }}</td>
                <td>{{ $banner->created_at }}</td>
                <td>
                    <a href="{{ route('admins.banners.show', $banner->id) }}" class="btn btn-success btn-sm">Xem</a>
                    <a href="{{ route('admins.banners.edit', $banner->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admins.banners.destroy', $banner->id) }}" method="post" class="d-inline" onsubmit="return confirm('Bạn có muốn xóa không?')">
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

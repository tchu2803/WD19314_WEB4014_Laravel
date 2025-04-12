@extends('admins.layouts.main')

@section('title', 'Quản lý bài viết')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Quản lý bài viết</h3>
</div>

{{-- Hiển thị thông báo --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn btn-outline-dark btn-close ml-2" data-bs-dismiss="alert"  aria-label="Close">Đóng</button>
    </div>
@endif

<a href="{{ route('admins.posts.create') }}" class="btn btn-info mt-3">Thêm bài viết</a>
<form action="{{ route('admins.posts.thungrac') }}" method="GET" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-outline btn-danger mt-3">Thùng rác</button>
</form>

<!-- Form tìm kiếm -->
<div class="card shadow-sm mb-4 mt-3">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm bài viết</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admins.posts.index') }}">
            <div class="row g-3">
                <!-- Tên bài viết -->
                <div class="col-md-3">
                    <label class="form-label">Tiêu đề bài viết</label>
                    <input type="text" name="tieu_de" class="form-control" placeholder="Nhập tiêu đề bài viết bạn cần tìm"
                        value="{{ request('tieu_de') }}">
                </div>

                <!-- Nút tìm kiếm & Làm mới -->
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-dark w-100 me-1">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                    <a href="{{ route('admins.posts.index') }}" class="btn btn-secondary w-100 ms-1 ml-2">
                        <i class="fas fa-sync m"></i> Làm mới
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<h1 class="h3">Danh sách bài viết</h1>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tiêu đề bài viết</th>
                <th scope="col">Tác giả</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Nội dung</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->tieu_de }}</td>
                <td>{{ $post->tac_gia }}</td>
                <td>
                    @if (isset($post->hinh_anh))
                    <img src="{{ asset('storage/' . $post->hinh_anh) }}" width="100px" alt="{{ $post->ten_san_pham }}">
                    @else
                    <img src="" alt="">
                    @endif
                </td>
                <td>
                    {{ $post->noi_dung }}
                </td>
                <td>{{ $post->created_at }}</td>
                <td>
                    @if($post->trang_thai == 1)
                        <span class="badge bg-success">Đã đăng</span>
                    @else
                        <span class="badge bg-danger">Chưa đăng</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admins.posts.show', $post->id) }}" class="btn btn-success btn-sm">Xem</a>
                    <a href="{{ route('admins.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admins.posts.destroy', $post->id) }}" method="post" class="d-inline" onsubmit="return confirm('Bạn có muốn xóa không?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

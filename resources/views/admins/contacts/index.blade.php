@extends('admins.layouts.main')

@section('title', 'Quản lý liên hệ')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Quản lý liên hệ</h3>
</div>

{{-- Hiển thị thông báo --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn btn-outline-dark btn-close ml-2" data-bs-dismiss="alert"  aria-label="Close">Đóng</button>
    </div>
@endif

<a href="{{ route('admins.contacts.create') }}" class="btn btn-info mt-3">Thêm liên hệ</a>
<form action="{{ route('admins.contacts.thungrac') }}" method="GET" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-outline btn-danger mt-3">Thùng rác</button>
</form>

<!-- Form tìm kiếm -->
<div class="card shadow-sm mb-4 mt-3">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm liên hệ</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admins.contacts.index') }}">
            <div class="row g-3">
                <!-- Tên người liên hệ -->
                <div class="col-md-3">
                    <label class="form-label">Số điện thoại người liên hệ</label>
                    <input type="text" name="so_dien_thoai" class="form-control" placeholder="Nhập số điện thoại liên hệ bạn cần tìm"
                        value="{{ request('so_dien_thoai') }}">
                </div>

                <!-- Nút tìm kiếm & Làm mới -->
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-dark w-100 me-1">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                    <a href="{{ route('admins.contacts.index') }}" class="btn btn-secondary w-100 ms-1 ml-2">
                        <i class="fas fa-sync m"></i> Làm mới
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<h1 class="h3">Danh sách liên hệ</h1>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên người liên hệ</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Tin nhắn</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->ho_ten }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->so_dien_thoai }}</td>
                <td>
                    {{ $contact->tin_nhan }}
                </td>
                <td>{{ $contact->created_at }}</td>
                <td>
                    @if($contact->trang_thai == 1)
                        <span class="badge bg-success">Đã phản hồi</span>
                    @else
                        <span class="badge bg-danger">Chưa phản hồi</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admins.contacts.show', $contact->id) }}" class="btn btn-success btn-sm">Xem</a>
                    <a href="{{ route('admins.contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admins.contacts.destroy', $contact->id) }}" method="post" class="d-inline" onsubmit="return confirm('Bạn có muốn xóa không?')">
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

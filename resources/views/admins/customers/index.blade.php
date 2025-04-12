@extends('admins.layouts.main')

@section('title', 'Danh sách khách hàng')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-users"></i> Quản lý khách hàng</h3>
</div>

{{-- Hiển thị thông báo --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn btn-outline-dark btn-close ml-2" data-bs-dismiss="alert"  aria-label="Close">Đóng</button>
    </div>
@endif

<a href="{{ route('admins.customers.create') }}" class="btn btn-info mt-3">Thêm khách hàng</a>
<form action="{{ route('admins.customers.thungrac') }}" method="GET" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-outline btn-danger mt-3">Thùng rác</button>
</form>

<!-- Form tìm kiếm -->
<div class="card shadow-sm mb-4 mt-3">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm khách hàng</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admins.customers.index') }}">
            <div class="row g-3">
                <!-- Tìm kiếm theo tên -->
                <div class="col-md-3">
                    <label class="form-label">Tên khách hàng</label>
                    <input type="text" name="ho_ten" class="form-control" placeholder="Nhập tên khách hàng"
                        value="{{ request('ho_ten') }}">
                </div>

                <!-- Nút tìm kiếm & Làm mới -->
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-dark w-100 me-1">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                    <a href="{{ route('admins.customers.index') }}" class="btn btn-secondary w-100 ms-1 ml-2">
                        <i class="fas fa-sync m"></i> Làm mới
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<h1 class="h3">Danh sách khách hàng</h1>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Mã khách hàng</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Ngày tham gia</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td scope="row">{{ $customer->id }}</td>
                <td>
                    @if (isset($customer->hinh_anh))
                    <img src="{{ asset('storage/' . $customer->hinh_anh) }}" width="100px" alt="{{ $customer->ho_ten }}">
                    @else
                    <img src="" alt="">
                    @endif
                </td>
                <td>{{ $customer->ho_ten }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->so_dien_thoai }}</td>
                <td>{{ $customer->dia_chi }}</td>
                <td>{{ $customer->created_at }}</td>
                <td>
                    <a href="{{ route('admins.customers.show', $customer->id) }}" class="btn btn-success btn-sm">Xem</a>
                    <a href="{{ route('admins.customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admins.customers.destroy', $customer->id) }}" method="post" class="d-inline" onsubmit="return confirm('Bạn có muốn xóa không?')">
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

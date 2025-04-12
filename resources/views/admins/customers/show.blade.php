@extends('admins.layouts.main')

@section('title', 'Chi tiết khách hàng')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Chi tiết khách hàng</h3>
</div>
<div>
    <table class="table table-striped mt-3">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $customer->id }}</td>
            </tr>
            <tr>
                <th>Tên khách hàng</th>
                <td>{{ $customer->ho_ten }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $customer->email }}</td>
            </tr>
            <tr>
                <th>Số điện thoại</th>
                <td>{{ $customer->so_dien_thoai }}</td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td>{{ $customer->dia_chi }}</td>
            </tr>
            <tr>
                <th>Hình ảnh</th>
                <td>
                    @if (isset($customer->hinh_anh))
                    <img src="{{ asset('storage/' . $customer->hinh_anh) }}" width="100px" alt="{{ $customer->ho_ten }}">
                    @else
                    <img src="" alt="">
                    @endif
                </td>
            </tr>
            <tr>
                <th>Ngày tham gia</th>
                <td>{{ $customer->created_at }}</td>
            </tr>
            <tr>
                <th>Ngày cập nhật</th>
                <td>{{ $customer->updated_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
<a href="/admins/customers" class="btn btn-info">Quay lại trang danh sách</a>
@endsection

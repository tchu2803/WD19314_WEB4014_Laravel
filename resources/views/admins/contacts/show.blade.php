@extends('admins.layouts.main')

@section('title', 'Chi tiết liên hệ')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Chi tiết liên hệ</h3>
</div>
<div>
    <table class="table table-striped mt-3">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $contact->id }}</td>
            </tr>
            <tr>
                <th>Tên khách hàng</th>
                <td>{{ $contact->ho_ten }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $contact->email }}</td>
            </tr>
            <tr>
                <th>Số điện thoại</th>
                <td>{{ $contact->so_dien_thoai }}</td>
            </tr>
            <tr>
                <th>Tin nhắn</th>
                <td>{{ $contact->tin_nhan }}</td>
            </tr>
            <tr>
                <th>Trạng thái</th>
                <td>
                    @if($contact->trang_thai == 1)
                        <span class="badge bg-success">Đã đọc</span>
                    @else
                        <span class="badge bg-danger">Chưa đọc</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Ngày tạo</th>
                <td>{{ $contact->created_at }}</td>
            </tr>
            <tr>
                <th>Ngày cập nhật</th>
                <td>{{ $contact->updated_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
<a href="/admins/contacts" class="btn btn-info">Quay lại trang danh sách</a>
@endsection

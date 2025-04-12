@extends('admins.layouts.main')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Chi tiết sản phẩm</h3>
</div>
<div>
    <table class="table table-striped mt-3">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $category->id }}</td>
            </tr>
            <tr>
                <th>Tên danh mục</th>
                <td>{{ $category->ten_danh_muc }}</td> <!-- Assuming you have a relationship between Product and Category -->
            </tr>
            <tr>
                <th>Trạng thái</th>
                <td>
                    @if($category->trang_thai == 1)
                        <span class="badge bg-success">Còn hàng</span>
                    @else
                        <span class="badge bg-danger">Hết hàng</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Ngày tạo</th>
                <td>{{ $category->created_at }}</td>
            </tr>
            <tr>
                <th>Ngày cập nhật</th>
                <td>{{ $category->updated_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
<a href="/admins/categories" class="btn btn-info">Quay lại trang danh sách</a>
@endsection

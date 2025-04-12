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
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <th>Mã sản phẩm</th>
                <td>{{ $product->ma_san_pham }}</td>
            </tr>
            <tr>
                <th>Mã danh mục</th>
                <td>{{ $product->ma_danh_muc }}</td>
            </tr>
            <tr>
                <th>Hình ảnh</th>
                <td>
                    @if (isset($product->hinh_anh))
                    <img src="{{ asset('storage/' . $product->hinh_anh) }}" width="100px" alt="{{ $product->ten_san_pham }}">
                    @else
                    <img src="" alt="">
                    @endif
                </td>
            </tr>
            <tr>
                <th>Tên sản phẩm</th>
                <td>{{ $product->ten_san_pham }}</td>
            </tr>
            <tr>
                <th>Giá</th>
                <td>{{ $product->gia }} đ</td>
            </tr>
            <tr>
                <th>Giá khuyến mãi</th>
                <td>{{ $product->gia_khuyen_mai }} đ</td>
            </tr>
            <tr>
                <th>Số lượng</th>
                <td>{{ $product->so_luong }}</td>
            </tr>
            <tr>
                <th>Ngày nhập</th>
                <td>{{ $product->ngay_nhap }}</td>
            </tr>
            <tr>
                <th>Mô tả</th>
                <td>{{ $product->mo_ta }}</td>
            </tr>
            <tr>
                <th>Trạng thái</th>
                <td>
                    @if($product->trang_thai == 1)
                        <span class="badge bg-success">Còn hàng</span>
                    @else
                        <span class="badge bg-danger">Hết hàng</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Ngày tạo</th>
                <td>{{ $product->created_at }}</td>
            </tr>
            <tr>
                <th>Ngày cập nhật</th>
                <td>{{ $product->updated_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
<a href="/admins/products" class="btn btn-info">Quay lại trang danh sách</a>
@endsection
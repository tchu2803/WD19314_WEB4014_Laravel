@extends('admins.layouts.main')

@section('title', 'Chi tiết đánh giá')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-search"></i> Chi tiết đánh giá</h3>
</div>
<div>
    <table class="table table-striped mt-3">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $review->id }}</td>
            </tr>
            <tr>
                <th>Sản phẩm</th>
                <td>{{ $review->ma_san_pham }}</td>
            </tr>
            <tr>
                <th>Khách hàng</th>
                <td>{{ $review->ma_khach_hang }}</td>
            </tr>
            <tr>
                <th>Đánh giá</th>
                <td>{{ $review->danh_gia }}</td>
            </tr>
            <tr>
                <th>Số sao</th>
                <td>{{ $review->so_sao }} / 5</td>
            </tr>
            <tr>
                <th>Ngày tạo</th>
                <td>{{ $review->created_at }}</td>
            </tr>
            <tr>
                <th>Ngày cập nhật</th>
                <td>{{ $review->updated_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
<a href="/admins/reviews" class="btn btn-info">Quay lại trang danh sách</a>
@endsection

@extends('admins.layouts.main')

@section('title', 'Chi tiết Banner')

@section('content')
<div class="card-header bg-primary text-white">
    <h3 class="mb-0"><i class="fas fa-image"></i> Chi tiết Banner</h3>
</div>
<div>
    <table class="table table-striped mt-3">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $banner->id }}</td>
            </tr>
            <tr>
                <th>Tên Banner</th>
                <td>{{ $banner->ten_banner }}</td>
            </tr>
            <tr>
                <th>Hình ảnh</th>
                <td>
                    @if (isset($banner->hinh_anh))
                        <img src="{{ asset('storage/' . $banner->hinh_anh) }}" width="100px" alt="{{ $banner->ten_banner }}">
                    @else
                        <img src="" alt="">
                    @endif
                </td>
            </tr>
            <tr>
                <th>Mô tả</th>
                <td>{{ $banner->mo_ta }}</td>
            </tr>
            <tr>
                <th>Ngày tạo</th>
                <td>{{ $banner->created_at }}</td>
            </tr>
            <tr>
                <th>Ngày cập nhật</th>
                <td>{{ $banner->updated_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
<a href="/admins/banners" class="btn btn-info">Quay lại trang danh sách</a>
@endsection

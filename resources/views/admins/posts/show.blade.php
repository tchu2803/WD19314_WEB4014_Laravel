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
                <th>{{ $post->id }}</th>
            </tr>
            <tr>
                <th>Tiêu đề</th>
                <td>{{ $post->tieu_de }}</td>
            </tr>
            <tr>
                <th>Tác giả</th>
                <td>{{ $post->tac_gia }}</td>
            </tr>
            <tr>
                <th>Hình ảnh</th>
                <td>
                    @if (isset($post->hinh_anh))
                    <img src="{{ asset('storage/' . $post->hinh_anh) }}" width="100px" alt="{{ $post->tieu_de }}">
                    @else
                    <img src="" alt="">
                    @endif
                </td>
            </tr>
            <tr>
                <th>Nội dung</th>
                <td>{{ $post->noi_dung }}</td>
            </tr>
            <tr>
                <th>Trạng thái</th>
                <td>
                    @if($post->trang_thai == 1)
                        <span class="badge bg-success">Đã đăng</span>
                    @else
                        <span class="badge bg-danger">Chưa đăng</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Ngày tạo</th>
                <td>{{ $post->created_at }}</td>
            </tr>
            <tr>
                <th>Ngày cập nhật</th>
                <td>{{ $post->updated_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
<a href="/admins/posts" class="btn btn-info">Quay lại trang danh sách</a>
@endsection
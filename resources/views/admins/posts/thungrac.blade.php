@extends('admins.layouts.main')

@section('title', 'Thùng rác bài viết')

@section('content')
    <h1 class="mb-4">Thùng rác bài viết</h1>
    
    {{-- Hiển thị thông báo --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn btn-outline-dark btn-close ml-2" data-bs-dismiss="alert" aria-label="Close">Đóng</button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Tác giả</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Ngày xóa</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->tieu_de }}</td>
                        <td>{{ $post->tac_gia }}</td>
                        <td>
                            @if (isset($post->hinh_anh))
                            <img src="{{ asset('storage/' . $post->hinh_anh) }}" width="100px" alt="{{ $post->tieu_de }}">
                            @else
                            <img src="" alt="">
                            @endif
                        </td>
                        <td>{{ $post->noi_dung }}</td>
                        <td>{{ $post->deleted_at }}</td>
                        <td>
                            <form action="{{ route('admins.posts.restore', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                            </form>
                            <form action="{{ route('admins.posts.forceDelete', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

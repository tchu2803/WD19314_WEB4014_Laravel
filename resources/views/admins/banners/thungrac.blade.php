@extends('admins.layouts.main')

@section('title', 'Thùng rác banner')

@section('content')
    <h1 class="mb-4">Thùng rác banner</h1>
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
                    <th scope="col">ID</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>{{ $banner->ten_banner }}</td>
                        <td>
                            @if ($banner->hinh_anh)
                                <img src="{{ asset('storage/' . $banner->hinh_anh) }}" width="100px" alt="Hình ảnh banner">
                            @else
                                <img src="" alt="">
                            @endif
                        </td>
                        <td>
                            {{ $banner->mo_ta }}
                        </td>
                        <td>{{ $banner->deleted_at }}</td>
                        <td>
                            <form action="{{ route('admins.banners.restore', $banner->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                            </form>
                            <form action="{{ route('admins.banners.forceDelete', $banner->id) }}" method="POST" class="d-inline">
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

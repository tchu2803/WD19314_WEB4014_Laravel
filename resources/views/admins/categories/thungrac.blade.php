@extends('admins.layouts.main')

@section('title', 'Thùng rác danh mục')

@section('content')
    <h1 class="mb-4">Thùng rác danh mục</h1>
    
    {{-- Hiển thị thông báo --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn btn-outline-dark btn-close ml-2" data-bs-dismiss="alert" aria-label="Close">Đóng</button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày xóa</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->ten_danh_muc }}</td>
                        <td>
                            @if ($category->trang_thai == 1)
                                Hoạt động
                            @else
                                Không hoạt động
                            @endif
                        </td>
                        <td>{{ $category->deleted_at }}</td>
                        <td>
                            <!-- Khôi phục -->
                            <form action="{{ route('admins.categories.restore', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                            </form>

                            <!-- Xóa vĩnh viễn -->
                            <form action="{{ route('admins.categories.forceDelete', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE') <!-- Correct HTTP method for force delete -->
                                <button type="submit" class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

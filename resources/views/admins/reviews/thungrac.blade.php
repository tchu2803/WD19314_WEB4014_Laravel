@extends('admins.layouts.main')

@section('title', 'Thùng rác đánh giá')

@section('content')
    <h1 class="mb-4">Thùng rác đánh giá</h1>
    
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
                    <th scope="col">Đánh giá</th>
                    <th scope="col">Số sao</th>
                    <th scope="col">Ngày xóa</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->danh_gia }}</td> <!-- Hiển thị đánh giá -->
                        <td>{{ $review->so_sao }} / 5</td> <!-- Hiển thị số sao -->
                        <td>{{ $review->deleted_at }}</td> <!-- Ngày xóa -->
                        <td>
                            <form action="{{ route('admins.reviews.restore', $review->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                            </form>
                            <form action="{{ route('admins.reviews.forceDelete', $review->id) }}" method="POST" class="d-inline">
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

@extends('admins.layouts.main')

@section('title', 'Thùng rác sản phẩm')

@section('content')
    <h1 class="mb-4">Thùng rác sản phẩm</h1>
        {{-- Hiển thị thông báo --}}
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn btn-outline-dark btn-close ml-2" data-bs-dismiss="alert"  aria-label="Close">Đóng</button>
        </div>
    
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Mã sản phẩm</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Ngày xóa</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->ma_san_pham }}</td>
                        <td>{{ $product->ten_san_pham }}</td>
                        <td>
                            @if ($product->hinh_anh)
                                <img src="{{ asset('storage/' . $product->hinh_anh) }}" width="100px" alt="Hình ảnh sản phẩm">
                            @else
                                Không có hình ảnh
                            @endif
                        </td>
                        <td>{{ $product->deleted_at }}</td>
                        <td>
                            <form action="{{ route('admins.products.restore', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                            </form>
                            <form action="{{ route('admins.products.forceDelete', $product->id) }}" method="POST" class="d-inline">
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
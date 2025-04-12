@extends('clients.layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Tất cả bài viết</h2>

    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $post->hinh_anh) }}" 
                         class="card-img-top" alt="Hình ảnh" 
                         style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->tieu_de }}</h5>
                        <p class="text-muted">Tác giả: {{ $post->tac_gia }}</p>
                        <div class="card-text">{!! Str::limit(strip_tags($post->noi_dung), 150) !!}</div>
                        <a href="#" class="btn btn-outline-primary btn-sm mt-2">Đọc tiếp</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

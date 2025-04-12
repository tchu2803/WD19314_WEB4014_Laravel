@extends('admins.layouts.main')

@section('title', 'Cập nhật bài viết')

@section('content')
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="fas fa-edit"></i> Cập nhật bài viết</h3>
    </div>

    <div class="row mt-3">
        <div class="col-12 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('admins.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Tiêu đề bài viết -->
                            <div class="mb-3 row">
                                <label for="tieu_de" class="col-4 col-form-label">Tiêu đề bài viết</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="tieu_de" id="tieu_de" value="{{ old('tieu_de', $post->tieu_de) }}" />
                                </div>
                                @error('tieu_de')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nội dung bài viết -->
                            <div class="mb-3 row">
                                <label for="noi_dung" class="col-4 col-form-label">Nội dung bài viết</label>
                                <div class="col-8">
                                    <textarea class="form-control" name="noi_dung" id="noi_dung">{{ old('noi_dung', $post->noi_dung) }}</textarea>
                                </div>
                                @error('noi_dung')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tác giả bài viết -->
                            <div class="mb-3 row">
                                <label for="tac_gia" class="col-4 col-form-label">Tác giả bài viết</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="tac_gia" id="tac_gia" value="{{ old('tac_gia', $post->tac_gia) }}" />
                                </div>
                                @error('tac_gia')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </div>
                            <div class="mb-3 row">
                                <label for="hinh_anh" class="col-4 col-form-label">Hình ảnh</label>
                                <div class="col-8">
                                    <input type="file" class="form-control" name="hinh_anh" id="hinh_anh">
                                    <br>
                                    @if($post->hinh_anh)
                                        <img src="{{ asset('storage/' . $post->hinh_anh) }}" class="mt-2" width="100">
                                    @endif
                                </div>
                                @error('hinh_anh')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Trạng thái bài viết -->
                            <div class="mb-3 row">
                                <label for="trang_thai" class="col-4 col-form-label">Trạng thái bài viết</label>
                                <div class="col-8">
                                    <input type="checkbox" class="form-checkbox" name="trang_thai" id="trang_thai" value="1" {{ old('trang_thai', $post->trang_thai) ? 'checked' : '' }} /> Đã đăng
                                    <input type="checkbox" class="form-checkbox ml-2" name="trang_thai" id="trang_thai" value="0" {{ old('trang_thai', $post->trang_thai) ? '' : 'checked' }} /> Chưa đăng
                                </div>
                                @error('trang_thai')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit buttons -->
                            <div class="mb-3 row">
                                <div class="offset-sm-4 col-sm-8">
                                    <button type="submit" class="btn btn-info">
                                        Cập nhật bài viết
                                    </button>

                                    <a href="/admins/posts" class="btn btn-warning">
                                        Quay lại trang danh sách
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.25.0/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('noi_dung');
    </script>
@endsection

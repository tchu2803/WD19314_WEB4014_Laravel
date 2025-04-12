@extends('clients.layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center rounded-top-4">
                    <h3 class="mb-0"><i class="bi bi-envelope-paper-heart-fill me-2"></i>Liên hệ với chúng tôi</h3>
                </div>
                <div class="card-body p-4">

                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="ho_ten" class="form-label fw-semibold">Họ và tên</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input type="text" class="form-control" id="ho_ten" name="ho_ten" placeholder="Nhập họ tên của bạn" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="so_dien_thoai" class="form-label fw-semibold">Số điện thoại</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" placeholder="0912xxxxxx" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tin_nhan" class="form-label fw-semibold">Tin nhắn</label>
                            <textarea class="form-control" id="tin_nhan" name="tin_nhan" rows="5" placeholder="Nội dung tin nhắn của bạn..." required></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-send-fill me-1"></i> Gửi liên hệ
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

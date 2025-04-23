@extends('clients.layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body text-center p-5">
                    <!-- Icon thành công -->
                    <div class="mb-4">
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="fa fa-check-circle fa-4x"></i>
                        </div>
                    </div>
                    
                    <!-- Thông báo chính -->
                    <h2 class="fw-bold text-success mb-3">Đặt hàng thành công!</h2>
                    <p class="lead mb-4">Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xác nhận.</p>
                    
                    <!-- Thông tin đơn hàng -->
                    <div class="card bg-light border-0 rounded-3 mb-4">
                        <div class="card-body p-4">
                            <div class="row g-3 text-start">
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Mã đơn hàng:</p>
                                    <p class="fw-bold fs-5 mb-0">{{ $order->id }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Ngày đặt hàng:</p>
                                    <p class="fw-bold mb-0">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Tổng thanh toán:</p>
                                    <p class="fw-bold text-primary fs-5 mb-0">{{ number_format($order->tong_tien, 0, ',', '.') }}đ</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Phương thức thanh toán:</p>
                                    <p class="fw-bold mb-0">
                                        @if($order->phuong_thuc_thanh_toan == 'cod')
                                            Thanh toán khi nhận hàng (COD)  
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Thông tin giao hàng -->
                    <div class="card border-0 rounded-3 mb-4">
                        <div class="card-header bg-white border-bottom-0 text-start">
                            <h5 class="mb-0">Thông tin giao hàng</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3 text-start">
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Người nhận:</p>
                                    <p class="fw-bold mb-0">{{ $order->ho_ten }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Số điện thoại:</p>
                                    <p class="fw-bold mb-0">{{ $order->so_dien_thoai }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Email:</p>
                                    <p class="fw-bold mb-0">{{ $order->email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Trạng thái đơn hàng:</p>
                                    <p class="fw-bold mb-0">
                                        <span class="badge bg-warning text-dark">{{ ucfirst($order->trang_thai) }}</span>
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="text-muted mb-1">Địa chỉ giao hàng:</p>
                                    <p class="fw-bold mb-0">{{ $order->dia_chi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Thông tin bổ sung -->
                    <div class="alert alert-info mb-4">
                        <i class="fa fa-info-circle me-2"></i>
                        Chúng tôi đã gửi email xác nhận đơn hàng đến <strong>{{ $order->email }}</strong>. 
                        Nhân viên của chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận đơn hàng.
                    </div>
                    
                    <!-- Liên hệ hỗ trợ -->
                    <div class="alert alert-light border mb-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fa fa-headset fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3 text-start">
                                <h6 class="fw-bold mb-1">Bạn cần hỗ trợ?</h6>
                                <p class="mb-0">Gọi cho chúng tôi: <strong>0123 456 789</strong> (8:00 - 21:00)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Một số CSS bổ sung để làm đẹp trang -->
<style>
    .card {
        transition: all 0.3s ease;
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        padding: 10px 20px;
    }
    
    .btn-outline-primary:hover {
        transform: translateY(-2px);
    }
    
    .bg-success {
        background: linear-gradient(45deg, #28a745, #20c997) !important;
    }
</style>
@endsection
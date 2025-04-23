@extends('clients.layouts.main')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0"><i class="fa fa-credit-card me-2"></i>Thông tin thanh toán</h4>
                    </div>
                    <form action="{{ route('clients.orders.placeOrder') }}" method="POST">
                        @csrf
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <h5 class="border-bottom pb-2 mb-4">Thông tin người nhận</h5>

                                    <div class="row g-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="ho_ten" class="form-label fw-semibold">Họ tên người nhận</label>
                                            <input type="text"
                                                class="form-control form-control-lg @error('ho_ten') is-invalid @enderror"
                                                name="ho_ten" id="ho_ten" required
                                                value="{{ old('ho_ten', Auth::user()->name ?? '') }}">
                                            @error('ho_ten')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label fw-semibold">Email</label>
                                            <input type="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                name="email" id="email" required
                                                value="{{ old('email', Auth::user()->email ?? '') }}">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="so_dien_thoai" class="form-label fw-semibold">Số điện thoại</label>
                                            <input type="text"
                                                class="form-control form-control-lg @error('so_dien_thoai') is-invalid @enderror"
                                                name="so_dien_thoai" id="so_dien_thoai" required
                                                value="{{ old('so_dien_thoai', Auth::user()->phone ?? '') }}">
                                            @error('so_dien_thoai')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="dia_chi" class="form-label fw-semibold">Địa chỉ giao hàng</label>
                                            <textarea class="form-control form-control-lg @error('dia_chi') is-invalid @enderror" name="dia_chi" id="dia_chi"
                                                rows="3" required>{{ old('dia_chi', Auth::user()->address ?? '') }}</textarea>
                                            @error('dia_chi')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 mb-4">Phương thức thanh toán</h5>

                                    <div class="card mb-3 border rounded-3">
                                        <div class="card-body">
                                            <div class="form-check d-flex align-items-center ps-0">
                                                <input class="form-check-input me-3" type="radio"
                                                    name="phuong_thuc_thanh_toan" value="cod" id="cod"
                                                    style="width: 20px; height: 20px;" checked>
                                                <label class="form-check-label w-100" for="cod">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <span class="fs-5 fw-medium">Thanh toán khi nhận hàng
                                                                (COD)</span>
                                                            <p class="text-muted mb-0 mt-1">Quý khách sẽ thanh toán bằng
                                                                tiền mặt khi nhận hàng</p>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="banking-details" class="card mb-4 border bg-light d-none">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3">Thông tin tài khoản:</h6>
                                            <ul class="list-unstyled mb-0">
                                                <li class="mb-2"><strong>Ngân hàng:</strong> MB Bank</li>
                                                <li class="mb-2"><strong>Số tài khoản:</strong> 0862837030</li>
                                                <li class="mb-2"><strong>Chủ tài khoản:</strong> CHU QUANG TUNG</li>
                                                <li><strong>Nội dung:</strong> [Họ tên] thanh toán đơn hàng</li>
                                                <li>
                                                    <img class="mt-3"
                                                        src="{{ asset('storage/images/banks/z6532245446826_ca798273819c94c44ef387077c65e690-removebg-preview.png') }}"
                                                        alt="Banking">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-top p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Tổng tiền sản phẩm:</span>
                                <span class="fw-bold">{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Phí vận chuyển:</span>
                                <span class="fw-bold">{{ number_format($shippingFee, 0, ',', '.') }}đ</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="fs-5 fw-bold">Tổng thanh toán:</span>
                                <span
                                    class="fs-4 fw-bold text-primary">{{ number_format($tongThanhToan, 0, ',', '.') }}đ</span>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold">
                                    <i class="fa fa-check-circle me-2"></i>Hoàn tất đặt hàng
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-3 mb-4 sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0"><i class="fa fa-shopping-cart me-2"></i>Đơn hàng của bạn</h4>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($cartItems as $item)
                            @if($item->ma_khach_hang == Auth::user()->id)
                                <li class="list-group-item py-3">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('storage/' . $item->product->hinh_anh) }}" class="rounded"
                                                alt="{{ $item->product->ten_san_pham }}" width="60">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ $item->product->ten_san_pham }}</h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted">SL: {{ $item['so_luong'] }}</span>
                                                @if ($item['gia_khuyen_mai'])
                                                    <span
                                                        class="fw-bold">{{ number_format($item['gia_khuyen_mai'] * $item['so_luong'], 0, ',', '.') }}đ</span>
                                                @else
                                                    <span
                                                        class="fw-bold">{{ number_format($item['gia'] * $item['so_luong'], 0, ',', '.') }}đ</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tổng sản phẩm:</span>
                        <span>
                            {{ $cartItems->filter(function ($item) {
                                return $item->ma_khach_hang == Auth::user()->id;
                            })->sum('so_luong') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bankingRadio = document.getElementById('banking');
            const codRadio = document.getElementById('cod');
            const bankingDetails = document.getElementById('banking-details');

            bankingRadio.addEventListener('change', function() {
                if (this.checked) {
                    bankingDetails.classList.remove('d-none');
                }
            });

            codRadio.addEventListener('change', function() {
                if (this.checked) {
                    bankingDetails.classList.add('d-none');
                }
            });
        });
    </script>
@endsection

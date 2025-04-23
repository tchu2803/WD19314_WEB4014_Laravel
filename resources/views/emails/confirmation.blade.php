<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng {{ $order->id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #4e73df, #5a85eb);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .content {
            padding: 30px;
        }
        .thank-you {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #4e73df;
        }
        .order-details {
            background-color: #f8f9fc;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .order-items {
            margin-top: 30px;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eaeaea;
        }
        th {
            background-color: #f8f9fc;
            color: #4e73df;
        }
        .total {
            font-weight: bold;
            color: #4e73df;
            font-size: 18px;
            text-align: right;
            margin-top: 15px;
        }
        .shipping {
            background-color: #f8f9fc;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .footer {
            background-color: #f8f9fc;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #eaeaea;
        }
        .button {
            display: inline-block;
            background-color: #4e73df;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 20px;
        }
        .contact-info {
            margin-top: 30px;
            color: #666;
        }
        .highlight {
            color: #4e73df;
            font-weight: bold;
        }
        @media only screen and (max-width: 600px) {
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Shop của chúng tôi</div>
            <div>Xác nhận đơn hàng {{ $order->id }}</div>
        </div>
        
        <div class="content">
            <div class="thank-you">Cảm ơn {{ $order->ho_ten }} đã đặt hàng!</div>
            
            <p>Đơn hàng của bạn đã được tiếp nhận và đang được xử lý. Dưới đây là chi tiết đơn hàng của bạn:</p>
            
            <div class="order-details">
                <h3>Thông tin đơn hàng</h3>
                <p><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
                <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Phương thức thanh toán:</strong> {{ $order->phuong_thuc_thanh_toan ?? 'Thanh toán khi nhận hàng' }}</p>
                <p><strong>Trạng thái:</strong> <span class="highlight">Đang xử lý</span></p>
            </div>

            <!-- Phần này sẽ hiển thị nếu có chi tiết đơn hàng -->
            @if(isset($orderItems) && count($orderItems) > 0)
            <div class="order-items">
                <h3>Chi tiết sản phẩm</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item)
                        <tr>
                            <td>{{ $item->ten_san_pham }}</td>
                            <td>{{ $item->so_luong }}</td>
                            <td>{{ number_format($item->gia, 0, ',', '.') }}₫</td>
                            <td>{{ number_format($item->so_luong * $item->gia, 0, ',', '.') }}₫</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="total">Tổng tiền: {{ number_format($order->tong_tien, 0, ',', '.') }}₫</div>
            </div>
            @else
            <div class="total">Tổng tiền đơn hàng: {{ number_format($order->tong_tien, 0, ',', '.') }}₫</div>
            @endif
            
            <div class="shipping">
                <h3>Thông tin giao hàng</h3>
                <p><strong>Người nhận:</strong> {{ $order->ho_ten }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->so_dien_thoai ?? 'Chưa cung cấp' }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->dia_chi }}</p>
                <p><strong>Ghi chú:</strong> {{ $order->ghi_chu ?? 'Không có' }}</p>
            </div>
            
            <p>Chúng tôi sẽ thông báo cho bạn khi đơn hàng được giao cho đơn vị vận chuyển. Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.</p>
            
            <div style="text-align: center;">
                <a href="#" class="button">Theo dõi đơn hàng</a>
            </div>
            
            <div class="contact-info">
                <p>Trân trọng,<br><strong>Đội ngũ hỗ trợ khách hàng</strong></p>
                <p>
                    <strong>Hotline:</strong> 1900.xxx.xxx<br>
                    <strong>Email:</strong> hotro@tencuahang.com<br>
                    <strong>Địa chỉ:</strong> Số xx Đường xxx, Quận/Huyện xxx, Thành phố xxx
                </p>
            </div>
        </div>
        
        <div class="footer">
            <p>© 2025 Shop của chúng tôi. Tất cả các quyền được bảo lưu.</p>
            <p>Nếu bạn không phải là người đặt hàng này, vui lòng bỏ qua email này.</p>
        </div>
    </div>
</body>
</html>
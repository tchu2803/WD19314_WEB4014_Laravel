<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chào mừng bạn đến với hệ thống!</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .header h1 {
            color: #0d6efd;
            margin: 0;
        }
        .content {
            padding: 20px 0;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            background-color: #0d6efd;
            color: #fff;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🎉 Chào mừng {{ $user->name }}!</h1>
        </div>

        <div class="content">
            <p>Xin chào <strong>{{ $user->name }}</strong>,</p>

            <p>Cảm ơn bạn đã đăng ký tài khoản tại <strong>{{ config('app.name') }}</strong>. Chúng tôi rất vui mừng khi có bạn đồng hành cùng hệ thống!</p>

            <p>Dưới đây là thông tin tài khoản của bạn:</p>
            <ul>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Ngày đăng ký:</strong> {{ now()->format('d/m/Y') }}</li>
            </ul>

            <p>Hãy truy cập hệ thống và bắt đầu trải nghiệm ngay:</p>
            <a href="{{ url('/') }}" class="button">🔗 Truy cập hệ thống</a>

            <p>Nếu bạn có bất kỳ câu hỏi hoặc cần hỗ trợ, đừng ngần ngại liên hệ với chúng tôi.</p>

            <p>Trân trọng,<br>Đội ngũ {{ config('app.name') }}</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Mọi quyền được bảo lưu.
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Xác thực email</title>
</head>
<body>
    <p>Chào {{ $user->fullname }},</p>
    <p>Cảm ơn bạn đã đăng ký tài khoản trên website của chúng tôi.</p>
    <p>Vui lòng <a href="{{ $url }}">nhấp vào đây</a> để xác thực email của bạn và kích hoạt tài khoản.</p>
    <p>Trân trọng,</p>
    <p>Đội ngũ hỗ trợ</p>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2 class="text-center text-primary mb-4">Đăng nhập Admin</h2>

    @if(isset($_SESSION['errors']))
    <div class="alert alert-danger">
        @foreach($_SESSION['errors'] as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    <?php unset($_SESSION['errors']); ?>
@endif

    <form action="{{ $_ENV['BASE_URL'] }}/login" method="POST" class="border p-4 rounded bg-light">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Nhập email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
    </form>
</body>

</html>
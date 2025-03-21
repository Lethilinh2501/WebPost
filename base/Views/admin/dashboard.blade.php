<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar a {
            color: white;
            text-decoration: none;
        }

        .navbar a:hover {
            color: #f8f9fa;
        }
    </style>
</head>

<body>

    <!-- Thanh điều hướng -->
    <nav class="navbar navbar-expand-lg navbar-dark px-4">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="ms-auto">
            <span class="text-white me-3">Xin chào, <strong>{{ $user['name'] ?? 'Admin' }}</strong></span>
            <a href="/PHP2/base/logout" class="btn btn-danger btn-sm"><i class="fa-solid fa-right-from-bracket"></i>
                Đăng xuất</a>
        </div>
    </nav>

    <!-- Nội dung Dashboard -->
    <div class="container mt-4">
        <h1 class="text-primary text-center">QUẢN TRỊ VIÊN</h1>
        <p class="lead text-center">Chào mừng đến với trang quản trị!</p>

        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card shadow p-3 text-center">
                    <h5 class="text-success"><i class="fa-solid fa-users"></i> Người dùng</h5>
                    <a href="/WebPost/base/admin/users" class="btn btn-outline-success">Xem chi tiết</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow p-3 text-center">
                    <h5 class="text-warning"><i class="fa-solid fa-list"></i> Danh mục</h5>
                    <a href="/WebPost/base/admin/categories" class="btn btn-outline-warning">Xem chi tiết</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow p-3 text-center">
                    <h5 class="text-info"><i class="fa-solid fa-box"></i> Bài viết</h5>
                    <a href="/WebPost/base/admin/posts" class="btn btn-outline-info">Xem chi tiết</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow p-3 text-center">
                    <h5 class="text-danger"><i class="fa-solid fa-list"></i> Banner</h5>
                    <a href="/WebPost/base/admin/banners" class="btn btn-outline-danger">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

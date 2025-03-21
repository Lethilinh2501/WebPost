<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Banner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

    <header class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Thêm Banner</h1>
        <a href="{{ $_ENV['BASE_URL'] }}admin/banners" class="btn btn-secondary">⬅ Quay lại danh sách</a>
    </header>

    <!-- Hiển thị lỗi nếu có -->
    @if (isset($_SESSION['error']) && is_array($_SESSION['error']))
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($_SESSION['error'] as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        <?php unset($_SESSION['error']); ?>
    @endif

    <form action="{{ $_ENV['BASE_URL'] }}admin/banners/store" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ảnh banner:</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Banner</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới bài viết</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <h1 class="text-success mb-4">Thêm mới bài viết</h1>

    <?php
    if (isset($_SESSION['error'])) {
        foreach ($_SESSION['error'] as $value) {
            echo "<p class='text-danger'>$value</p>";
        }
        unset($_SESSION['error']);
    }
    ?>

    <form action="<?= $_ENV['BASE_URL'] ?>admin/posts/store" method="POST" enctype="multipart/form-data"
        class="border p-4 rounded shadow-sm bg-light">
        <div class="mb-3">
            <label class="form-label">Tiêu đề bài viết</label>
            <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề bài viết" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug (URL bài viết)</label>
            <input type="text" name="slug" class="form-control" placeholder="Nhập slug bài viết (nếu có)">
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục bài viết</label>
            <select name="category_id" class="form-select" required>
                @if (is_array($categories) && count($categories) > 0)
                    @foreach ($categories as $value)
                        <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                    @endforeach
                @else
                    <option disabled>Không có danh mục nào</option>
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh bài viết</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Nội dung bài viết</label>
            <textarea name="content" class="form-control" placeholder="Nhập nội dung bài viết" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Thêm mới</button>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

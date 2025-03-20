<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật danh mục</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <h1 class="text-success mb-4">Cập nhật danh mục</h1>

    <form action="{{ $_ENV['BASE_URL'] }}admin/categories/{{ $categories['id'] }}/update" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow-sm bg-light">
        
    <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ $categories['name'] }}">
            <input type="hidden" name="id" value="{{ $categories['id'] }}">

        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
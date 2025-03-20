<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

    <header class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Danh sách bài viết</h1>
        <a href="{{ $_ENV['BASE_URL'] }}admin/dashboard" class="btn btn-secondary">⬅ Quay lại Dashboard</a>
    </header>

    <a href="{{ $_ENV['BASE_URL'] }}admin/posts/create" class="btn btn-primary mb-3">Thêm bài viết</a>

    <form action="{{ $_ENV['BASE_URL'] }}admin/posts/search" method="GET" class="mb-3 d-flex">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control me-2" placeholder="Tìm kiếm bài viết..." value="{{ $keyword ?? '' }}">
            <button type="submit" class="btn btn-info">
                <i class="fa fa-search"></i> Tìm kiếm
            </button>
        </div>
    </form>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Danh mục</th>
                <th>Ảnh</th>
                <th>Ngày đăng</th>
                <th>Ngày sửa</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post['id'] }}</td>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post['categoryName'] }}</td>
                <td>
                    @if($post['img_thumbnail'] != null)
                    <img src="{{ $_ENV['BASE_URL'] . $post['img_thumbnail'] }}" alt="Ảnh bài viết" class="img-thumbnail" width="80">
                    @endif
                </td>
                <td>{{ date('d-m-Y H:i:s', strtotime($post['created_at'])) }}</td>
                <td>{{ date('d-m-Y H:i:s', strtotime($post['updated_at'])) }}</td>
                <td>
                    <a href="{{ $_ENV['BASE_URL'] }}admin/posts/{{ $post['id'] }}/edit" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="{{ $_ENV['BASE_URL'] }}admin/posts/{{ $post['id'] }}/delete" class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

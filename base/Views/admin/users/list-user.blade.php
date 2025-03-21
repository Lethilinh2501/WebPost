<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

    <header class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Danh sách người dùng</h1>
        <a href="{{ $_ENV['BASE_URL'] }}admin/dashboard" class="btn btn-secondary">⬅ Quay lại Dashboard</a>
    </header>

    <form action="{{ $_ENV['BASE_URL'] }}admin/users/search" method="GET" class="mb-3 d-flex">
        <input type="text" name="keyword" class="form-control me-2" placeholder="Tìm kiếm sản phẩm..."
            value="{{ $keyword ?? '' }}">
        <button type="submit" class="btn btn-info">Tìm kiếm</button>
    </form>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mật khẩu</th>
                <th>Người dùng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['username'] }}</td>
                    <td>{{ $value['email'] }}</td>
                    <td>{{ $value['password'] }}</td>
                    <td>{{ $value['role'] }}</td>
                    <td>
                        <a href="{{ $_ENV['BASE_URL'] }}admin/users/{{ $value['id'] }}/delete"
                            class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
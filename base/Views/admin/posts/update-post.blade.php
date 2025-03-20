<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật bài viết</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <h1 class="text-success mb-4">Cập nhật bài viết</h1>

    @php
    if(isset($_SESSION['error'])){
        foreach($_SESSION['error'] as $value){
            echo "<p class='text-danger'>$value</p>";
        unset($_SESSION['error']);
        }
    }
    @endphp
    
    <form action="{{ $_ENV['BASE_URL'] }}admin/posts/{{ $post['id'] }}/update" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow-sm bg-light">
        <div class="mb-3">
            <label class="form-label">Tiêu đề bài viết</label>
            <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề bài viết" value="{{ $post['title'] }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $value)
                <option
                    @if($post['category_id'] == $value['id']) selected
                    @endif
                    value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh bài viết</label>
            @if($post['img_thumbnail'] != null)
            <img src="{{ $_ENV['BASE_URL'] . $post['img_thumbnail'] }}" alt="Ảnh bài viết" class="img-thumbnail" width="80">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Nội dung bài viết</label>
            <textarea name="content" class="form-control" placeholder="Nhập nội dung bài viết" rows="5">{{ $post['content'] }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

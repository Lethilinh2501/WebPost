<?php
namespace App\Controllers;

use App\Models\PostModel;
use Rakit\Validation\Validator;

class PostController extends Controller
{
    private $postModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = new PostModel();
    }

    // Danh sách bài viết
    public function index()
    {
        $posts = $this->postModel->getPosts();
        echo $this->blade->run("admin.posts.list-post", ["posts" => $posts]);
    }

    // Hiển thị form thêm bài viết
    public function create()
    {
        $categories = $this->postModel->getCategories(); // Lấy danh sách danh mục
        echo $this->blade->run("admin.posts.add-post", ["categories" => $categories]);
    }

    // Lưu bài viết mới
    public function store()
{
    $validator = new Validator;

    $validation = $validator->make($_POST, [
        'title' => 'required|min:1|max:100',
        'content' => 'required|min:10',
        'category_id' => 'required|numeric'
    ]);

    $validation->validate();
    if ($validation->fails()) {
        $_SESSION['error'] = $validation->errors()->firstOfAll();
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/posts/create');
        exit;
    }

    // Lấy user_id từ session (hoặc thay đổi theo hệ thống xác thực của bạn)
    $user_id = $_SESSION['user_id'] ?? null;
    
    if (!$user_id) {
        $_SESSION['error'] = "User ID không hợp lệ.";
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/posts/create');
        exit;
    }

    // Lưu bài viết
    $this->postModel->addPost(
        $user_id, 
        $_POST['title'], 
        $_POST['content'], 
        $_POST['category_id'], 
        $_POST['img_thumbnail'] ?? null
    );

    header('Location: ' . $_ENV['BASE_URL'] . 'admin/posts');
}

    // Hiển thị form sửa bài viết
    public function edit($id)
    {
        $post = $this->postModel->findPost($id);
        $categories = $this->postModel->getCategories();
        echo $this->blade->run("admin.posts.update-post", ["post" => $post, "categories" => $categories]);
    }

    // Cập nhật bài viết
    public function update($id)
    {
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'title' => 'required|min:1|max:100',
            'category_id' => 'required|integer',
            'content' => 'required|min:10',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['error'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . "admin/posts/$id/edit");
            exit;
        }

        $post = $this->postModel->findPost($id);
        $image_url = $post['img_thumbnail'];

        if (!empty($_FILES['image']['name'])) {
            if ($image_url) unlink($image_url);
            $imageName = time() . "_" . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$imageName");
            $image_url = "uploads/$imageName";
        }

        $this->postModel->updatePost($id, $_POST['category_id'], $_POST['title'], $_POST['content'], $image_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/posts');
    }

    // Xóa bài viết
    public function delete($id)
    {
        $post = $this->postModel->findPost($id);
        if ($post['img_thumbnail']) unlink($post['img_thumbnail']);
        $this->postModel->deletePost($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/posts');
    }

    // Tìm kiếm bài viết
    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $posts = $this->postModel->searchPosts($keyword);
        echo $this->blade->run("admin.posts.list-post", ["posts" => $posts, "keyword" => $keyword]);
    }
}

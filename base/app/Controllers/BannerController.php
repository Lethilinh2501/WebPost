<?php

namespace App\Controllers;

use App\Models\BannerModel;
use Rakit\Validation\Validator;

class BannerController extends Controller
{
    private $bannerModel;

    public function __construct()
    {
        parent::__construct();
        $this->bannerModel = new BannerModel();
    }

    // Danh sách banner
    public function index()
    {
        $banners = $this->bannerModel->getBanners();
        echo $this->blade->run("admin.banners.list-banner", ["banners" => $banners]);
    }

    // Hiển thị form thêm banner
    public function create()
    {
        echo $this->blade->run("admin.banners.add-banner");
    }

    // Lưu banner mới
    public function store()
    {
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'title' => 'required|min:1|max:255'
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['error'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'admin/banners/create');
            exit;
        }

        $image_url = null;
        if (!empty($_FILES['image']['name'])) {
            $imageName = time() . "_" . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$imageName");
            $image_url = "uploads/$imageName";
        }

        $this->bannerModel->addBanner($_POST['title'], $image_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/banners');
    }

    // Hiển thị form sửa banner
    public function edit($id)
    {
        $banner = $this->bannerModel->findBanner($id);
        echo $this->blade->run("admin.banners.update-banner", ["banner" => $banner]);
    }

    // Cập nhật banner
    public function update($id)
    {
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'title' => 'required|min:1|max:255',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['error'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . "admin/banners/$id/edit");
            exit;
        }

        $banner = $this->bannerModel->findBanner($id);
        $image_url = $banner['image'];

        if (!empty($_FILES['image']['name'])) {
            if ($image_url) unlink($image_url);
            $imageName = time() . "_" . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$imageName");
            $image_url = "uploads/$imageName";
        }

        $this->bannerModel->updateBanner($id, $_POST['title'], $image_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/banners');
    }

    // Xóa banner
    public function delete($id)
    {
        $banner = $this->bannerModel->findBanner($id);
        if ($banner['image']) unlink($banner['image']);
        $this->bannerModel->deleteBanner($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/banners');
    }
}

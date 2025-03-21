<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends Controller
{
    private $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $user = $this->userModel->getUsers();
        echo $this->blade->run("admin.users.list-user", ["users" => $user]);
    }

    public function delete($id)
    {
        $this->userModel->deleteUsers($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/users');
    }

    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';

        $user = $this->userModel->searchUsers($keyword);

        echo $this->blade->run("admin.users.list-user", [
            "users" => $user,
            "keyword" => $keyword
        ]);
    }
}

<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    private $categoryModel;
    public function __construct()
    {
        parent::__construct();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        echo $this->blade->run("admin.categories.list-category", ["categories" => $categories]);
    }

    public function create()
    {
        $categories = $this->categoryModel->getCategories();
        echo $this->blade->run("admin.categories.add-category", ["categories" => $categories]);
    }

    public function store()
    {
        $this->categoryModel->addCategories();
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/categories');
    }

    public function edit($id)
    {
        $categories = $this->categoryModel->findCategories($id);
        echo $this->blade->run("admin.categories.update-category", ["categories" => $categories]);
    }

    public function update($id)
    {

        $this->categoryModel->updateCategories($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/categories');
    }

    public function delete($id)
    {
        $this->categoryModel->deleteCategories($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/categories');
    }
    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';

        $categories = $this->categoryModel->searchCategories($keyword);

        echo $this->blade->run("admin.categories.list-category", [
            "categories" => $categories,
            "keyword" => $keyword
        ]);
    }
}

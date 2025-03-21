<?php

use Bramus\Router\Router;
use App\Controllers\CategoryController;
use App\Controllers\BannerController;
use App\Controllers\UserController;
use App\Controllers\DashboardController;
use App\Controllers\PostController;

$router = new Router();

// Định nghĩa base URL
$router->setBasePath('/WebPost/base');

// Dashboard
$router->get('/admin/dashboard', function () {
    $controller = new DashboardController();
    return $controller->index();
});

// posts
$router->mount('/admin/posts', function () use ($router) {
    $router->get('/', PostController::class . '@index');
    $router->get('/create', PostController::class . '@create');
    $router->post('/store', PostController::class . '@store');
    $router->get('/{id}/edit', PostController::class . '@edit');
    $router->post('/{id}/update', PostController::class . '@update');
    $router->get('/{id}/delete', PostController::class . '@delete');
    $router->get('/search', PostController::class . '@search');
});

// Categories
$router->mount('/admin/categories', function () use ($router) {
    $router->get('/', CategoryController::class . '@index');
    $router->get('/create', CategoryController::class . '@create');
    $router->post('/store', CategoryController::class . '@store');
    $router->get('/{id}/edit', CategoryController::class . '@edit');
    $router->post('/{id}/update', CategoryController::class . '@update');
    $router->get('/{id}/delete', CategoryController::class . '@delete');
    $router->get('/search', CategoryController::class . '@search');
});

// Banners
$router->mount('/admin/banners', function () use ($router) {
    $router->get('/', BannerController::class . '@index');
    $router->get('/create', BannerController::class . '@create');
    $router->post('/store', BannerController::class . '@store');
    $router->get('/{id}/edit', BannerController::class . '@edit');
    $router->post('/{id}/update', BannerController::class . '@update');
    $router->get('/{id}/delete', BannerController::class . '@delete');
    $router->get('/search', BannerController::class . '@search');
});

// Users
$router->mount('/admin/users', function () use ($router) {
    $router->get('/', UserController::class . '@index');
    $router->get('/{id}/delete', UserController::class . '@delete');
    $router->get('/search', UserController::class . '@search');
});

$router->run();

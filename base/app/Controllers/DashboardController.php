<?php

namespace App\Controllers;

use App\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Trang Dashboard"; // Đặt tiêu đề trang
        $user = $_SESSION['user'] ?? null; // Lấy user từ SESSION (nếu có)
        return $this->view('admin.dashboard', compact('title', 'user'));

    }
}

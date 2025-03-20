<?php
// đc cấu hình ở nhà
namespace App\Controllers;

use eftec\bladeone\BladeOne;

class Controller
{

    protected $blade;
    public function __construct()
    {
        $views = ROOT_PATH . '/Views'; // Thư mục chứa file .blade.php
        $cache = ROOT_PATH . '/cache'; // Thư mục chứa file cache
        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
    }

    public function view($view, $data = [])
    {
        echo $this->blade->run($view, $data);
    }
}

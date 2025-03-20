<?php
// đầu tiên khai báo
session_start();
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__); //__DIR__ là thư mục gốc
$dotenv->load(); // TẠO ĐỐI TƯỢNG ENV LOAD NỘI DUNG TRONG ENV

const ROOT_PATH = __DIR__;

require 'router.php';

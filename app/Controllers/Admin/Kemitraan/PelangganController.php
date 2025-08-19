<?php

namespace App\Controllers\Admin\Kemitraan;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class PelangganController extends BaseController
{
    private $db, $UserInfo;
    public function __construct()
    {
        $this->db = Config::connect();
    }

    public function index()
    {
        return view('pages/user/mitra/pelanggan_mitra');
    }
}

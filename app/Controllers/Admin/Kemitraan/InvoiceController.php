<?php

namespace App\Controllers\Admin\Kemitraan;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class InvoiceController extends BaseController
{
    private $db, $UserInfo;
    public function __construct()
    {
        $this->db = Config::connect();
    }

    public function index()
    {
        return view('pages/user/mitra/invoice');
    }

    public function get_code_mitra()
    {
        $query = $this->db
            ->table('profile_mitra')
            ->select('kode_mitra')
            ->get()
            ->getResultArray();
        return $this->response->setJSON($query);
    }

}

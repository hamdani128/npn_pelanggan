<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class UsersManagement extends BaseController
{

    private $db, $UserInfo;
    public function __construct()
    {
        $this->db = Config::connect();
    }

    public function index()
    {
        return view('pages/su/users_management');
    }

    public function getdata()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->db->table("users_account")->get()->getResult();
        return $this->response->setJSON($data);
    }

    public function insert()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = json_decode(file_get_contents('php://input'), true);
        $data = [
            'name' => $input['nama'],
            'email' => $input['email'],
            'level' => $input['level'],
            'username' => $input['username'],
            'status_account' => '0',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        // var_dump($data);
        $query = $this->db->table('users_account')->insert($data);
        if ($query) {
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data gagal disimpan',
            ];
        }
        return $this->response->setJSON($response);
    }

}
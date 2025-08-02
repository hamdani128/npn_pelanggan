<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class EmployeeController extends BaseController
{
    private $db, $UserInfo;
    public function __construct()
    {
        $this->db = Config::connect();
    }

    public function index()
    {
        return view('pages/su/employee');
    }

    public function employee_getdata()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = $this->db->table('employee')
            ->where('jabatan !=', 'Programmer')
            ->get()
            ->getResultObject();

        return $this->response->setJSON($data);
    }

    public function employee_insert()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = json_decode(file_get_contents('php://input'), true);
        $data = [
            'fullname' => $input['nama_lengkap'],
            'email' => $input['email'],
            'jabatan' => $input['jabatan'],
            'no_kontak' => $input['no_kontak'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session('username'),
        ];

        $query1 = $this->db->table('employee')->insert($data);
        if ($query1) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal disimpan']);
        }
    }

}

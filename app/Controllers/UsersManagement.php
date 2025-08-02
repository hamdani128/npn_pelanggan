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
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $input = json_decode(file_get_contents('php://input'), true);
        $data = [
            'name' => $input['nama'],
            'email' => $input['email'],
            'level' => $input['level'],
            'username' => $input['username'],
            'status_account' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $session->get('username'),
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

    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'];
        $data = [
            'name' => $input['nama'],
            'email' => $input['email'],
            'level' => $input['level'],
            'username' => $input['username'],
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => session()->get('username'),
        ];
        // var_dump($data);
        $query = $this->db->table('users_account')->where('id', $id)->update($data);
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

    public function delete()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'];
        $query = $this->db->table('users_account')->where('id', $id)->delete();
        if ($query) {
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data gagal dihapus',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function activate()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'];
        $status = $input['status'];
        $row = $this->db->table('users_account')->where('id', $id)->get()->getRow();
        $data_insert = [
            'name' => $row->name,
            'email' => $row->email,
            'level' => $row->level,
            'username' => $row->username,
            'password' => md5($row->username),
            'valid' => '0',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $data_update = [
            'status_account' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $query1 = $this->db->table('users')->insert($data_insert);
        $query2 = $this->db->table('users_account')->where('id', $id)->update($data_update);

        if ($query1 && $query2) {
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil diaktifkan',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data gagal diaktifkan',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function deactivate()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'];
        $status = $input['status'];
        $row = $this->db->table('users_account')->where('id', $id)->get()->getRow();
        $data_update = [
            'status_account' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $query1 = $this->db->table('users_account')->where('id', $id)->update($data_update);
        $query2 = $this->db->table('users')->where('username', $row->username)->delete();
        if ($query1 && $query2) {
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil dinonaktifkan',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data gagal dinonaktifkan',
            ];
        }
        return $this->response->setJSON($response);
    }
}

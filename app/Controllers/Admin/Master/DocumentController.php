<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class DocumentController extends BaseController
{
    private $db, $UserInfo;
    public function __construct()
    {
        $this->db = Config::connect();
        $session = session();
    }

    public function index()
    {
        return view('pages/su/supported_document');
    }

    public function getdata()
    {
        $data = $this->db->table('support_doc_types')->get()->getResultObject();
        return $this->response->setJSON($data);
    }

    public function insert()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = json_decode(file_get_contents('php://input'), true);
        $data = [
            'type_name' => $input['nama'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session('loggedUser'),
        ];
        $query = $this->db->table('support_doc_types')->insert($data);
        if ($query) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal disimpan']);
        }
    }

    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = json_decode(file_get_contents('php://input'), true);
        $data = [
            'type_name' => $input['nama'],
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => session('loggedUser'),
        ];
        $query = $this->db->table('support_doc_types')->where('id', $input['id'])->update($data);
        if ($query) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diubah']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal diubah']);
        }
    }

    public function delete()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'];
        $query = $this->db->table('support_doc_types')->where('id', $id)->delete();
        if ($query) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal dihapus']);
        }
    }

}
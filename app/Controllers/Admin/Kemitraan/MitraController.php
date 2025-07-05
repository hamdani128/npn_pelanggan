<?php

namespace App\Controllers\Admin\Kemitraan;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class MitraController extends BaseController
{

    private $db, $UserInfo;
    public function __construct()
    {
        $this->db = Config::connect();
    }

    public function index()
    {
        return view('pages/user/kemitraan');
    }

    public function getdata()
    {
        date_default_timezone_set('Asia/Jakarta');
        $query = $this->db->table('profile_mitra')->get()->getResult();
        return $this->response->setJSON($query);
    }

    public function getmitra_id()
    {
        date_default_timezone_set('Asia/Jakarta');

        $query = $this->db->query("SELECT MAX(RIGHT(kode_mitra,5)) as KD_MAX FROM profile_mitra");
        $kd = "00001";

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $n = (int) $row->KD_MAX + 1;
            $kd = sprintf("%05s", $n);
        }

        $kode_mitra = date('YmdHi') . $kd;

        return $this->response->setJSON(['kode_mitra' => $kode_mitra]);
    }

    public function insert()
    {
        helper(['form', 'url']);
        try {
            // Ambil data utama
            $mitra_id = $this->request->getPost("mitra_id");
            $perusahaan = $this->request->getPost("perusahaan");
            $email = $this->request->getPost("email");
            $no_kontak = $this->request->getPost("no_kontak");
            $alamat_perusahaan = $this->request->getPost("alamat_perusahaan");
            $alamat_instalasi = $this->request->getPost("alamat_instalasi");
            $struktural = json_decode($this->request->getPost("struktural"), true);
            $tambahan_file = json_decode($this->request->getPost("tambahan_file_data"), true);

            // Buat folder berdasarkan mitra_id
            $uploadPath = FCPATH . 'upload/mitra/' . $mitra_id . '/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Simpan data perusahaan (contoh, modif sesuai model/database kamu)
            $data_mitra = [
                'kode_mitra' => $mitra_id,
                'nama_perusahaan' => $perusahaan,
                'email' => $email,
                'no_hp' => $no_kontak,
                'alamat' => $alamat_perusahaan,
                'alamat_instalasi' => $alamat_instalasi,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('username'),
            ];
            $this->db->table('profile_mitra')->insert($data_mitra);

            // Simpan detail struktural
            foreach ($struktural as $index => $row) {
                $data_row = [
                    'kode_mitra' => $mitra_id,
                    'nik' => $row['nik'] ?? '',
                    'nama' => $row['nama'] ?? '',
                    'no_wa' => $row['no_wa'] ?? '',
                    'email' => $row['email'] ?? '',
                    'npwp' => $row['npwp'] ?? '',
                    'posisi' => $row['posisi'] ?? '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => session()->get('username'),
                ];

                $file = $this->request->getFile("struktural_file_" . $index);
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move($uploadPath, $newName);
                    $data_row['filename'] = $newName;
                }

                $this->db->table("profile_mitra_detail")->insert($data_row);
            }

            // Simpan tambahan dokumen
            foreach ($tambahan_file as $index => $row) {
                $data_row = [
                    'kode_mitra' => $mitra_id,
                    'doc_type_id' => $row['dokumen_id'] ?? '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => session()->get('username'),
                ];

                $file = $this->request->getFile("tambahan_file_" . $index);
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move($uploadPath, $newName);
                    $data_row['file_name'] = $newName;
                }

                $this->db->table("profile_mitra_document")->insert($data_row);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
            ]);

        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

}
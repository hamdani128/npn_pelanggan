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

        $builder = $this->db->table('profile_mitra a');
        $builder->select('a.*');
        $builder->select(
            'CASE WHEN b.username IS NULL THEN "0" ELSE "1" END AS status_account',
            false// jangan escape, biarkan raw SQL
        );
        $builder->join('users b', 'a.kode_mitra = b.username', 'left');

        $query = $builder->get()->getResult();
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

            // layanan
            $jenis_layanan = $this->request->getPost("jenis_layanan");
            $kapasitas_layanan = $this->request->getPost("kapasitas_layanan");
            $satuan_layanan = $this->request->getPost("satuan_layanan");
            $vendor_media = $this->request->getPost("vendor_media");
            $deskripsi_month = $this->request->getPost("harga_dasar_price_month");
            $price_dasar_price_month = $this->request->getPost("price_dasar_price_month");
            $harga_jual_price_month = $this->request->getPost("harga_jual_price_month");
            $ppn_price_mont = $this->request->getPost("ppn_price_month");
            $periode_start_price_month = $this->request->getPost("periode_start_price_month");
            $periode_end_price_month = $this->request->getPost("periode_end_price_month");

            $data_temp = [
                'kode_mitra' => $mitra_id,
                'jenis_layanan' => $jenis_layanan,
                'kapasitas' => $kapasitas_layanan,
                'quantity' => $satuan_layanan,
                'vendor' => $vendor_media,
                'deskripsi_price' => $deskripsi_month,
                'harga_dasar' => $price_dasar_price_month,
                'harga_dasar' => $price_dasar_price_month,
                'ppn_text' => $ppn_price_mont,
                'periode_start' => $periode_start_price_month,
                'periode_end' => $periode_end_price_month,
            ];

            // otc_data
            $otc = json_decode($this->request->getPost("otc_data"), true);
            foreach ($otc as $index => $row) {
                $data_row = [
                    'kode_mitra' => $mitra_id,
                    'deskripsi_price' => $row['deskripsi'] ?? '',
                    'harga_dasar' => $row['harga_dasar'] ?? '',
                    'harga_jual' => $row['harga_jual'] ?? '',
                    'ppn_text' => $row['ppn'] ?? '',
                    'ppn' => $row['harga_jual'] * ($row['ppn'] / 100) ?? '',
                    'subtotal' => $row['subtotal'] ?? '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => session()->get('username'),
                ];
                $this->db->table("profile_mitra_data_layanan_otc")->insert($data_row);
            }

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

    public function getmitra_detail()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = json_decode(file_get_contents('php://input'), true);
        $kode_mitra = $input['kode_mitra'];
        $query = $this->db->table('profile_mitra_detail')->where('kode_mitra', $kode_mitra)->get()->getResult();
        return $this->response->setJSON($query);
    }

    public function getmitra_detail_document()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON(true); // atau getJSON() jika tidak ingin sebagai array
        $kode_mitra = $input['kode_mitra'];
        $builder = $this->db->table('profile_mitra_document a');
        $builder->select('a.*, b.type_name');
        $builder->join('support_doc_types b', 'a.doc_type_id = b.id');
        $builder->where('a.kode_mitra', $kode_mitra);
        $query = $builder->get()->getResult();
        return $this->response->setJSON($query);
    }

    public function getrefcode()
    {
        date_default_timezone_set('Asia/Jakarta');
        $query = $this->db->table('cg_ref_codes')->where('domain', 'OTC')->get()->getResult();
        return $this->response->setJSON($query);
    }

}

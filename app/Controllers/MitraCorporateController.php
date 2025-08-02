<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegisterModel;
use CodeIgniter\Database\Config;

class MitraCorporateController extends BaseController
{

    private $db, $UserInfo;
    public function __construct()
    {
        $this->db = Config::connect();
    }

    public function index()
    {
        return view('pages/landing/landing');
    }

    public function supported_document()
    {
        $data = $this->db->table('support_doc_types')->get()->getResultObject();
        return $this->response->setJSON($data);
    }

    public function register()
    {
        return view('auth/register');
    }

    public function register_id()
    {
        date_default_timezone_set('Asia/Jakarta');
        $query = $this->db->query("SELECT MAX(RIGHT(kode_register,5)) as KD_MAX FROM mitra_by_register");
        $kd = "00001";

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $n = (int) $row->KD_MAX + 1;
            $kd = sprintf("%05s", $n);
        }
        return $kode_mitra = "REG-" . date('Ymd') . $kd;
    }

    public function register_insert()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON(true);
        $perusahaan = $input['nama_perusahaan'];
        $email = $input['email'];
        $no_kontak = $input['no_kontak'];
        $alamat_perusahaan = $input['alamat_perusahaan'];
        $alamat_instalasi = $input['alamat_instalasi'];

        $row1 = $this->db->table('profile_mitra')->where('nama_perusahaan', $perusahaan)->get()->getRow();
        $row2 = $this->db->table('mitra_by_register')->where('nama_perusahaan', $perusahaan)->get()->getRow();

        if ($row1 !== null || $row2 !== null) {
            return $this->response->setJSON([
                'status' => 'company_already',
                'message' => 'Perusahaan sudah terdaftar',
            ]);
        } else {
            $kode_register = $this->register_id(); // pastikan ini return string

            $data = [
                'kode_register' => $kode_register,
                'nama_perusahaan' => $perusahaan,
                'email' => $email,
                'no_hp' => $no_kontak,
                'alamat' => $alamat_perusahaan,
                'alamat_instalasi' => $alamat_instalasi,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $kode_register,
            ];

            $registerModel = new RegisterModel();
            $emailSent = $registerModel->blast_mitra_register_for_register($email, $data);
            $emailSentForManajemen = $registerModel->blast_mitra_register_for_manajemen($data);

            if ($emailSent & $emailSentForManajemen) {
                // Simpan ke database jika email sukses
                $query = $this->db->table('mitra_by_register')->insert($data);

                if ($query) {
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'Registrasi berhasil, silakan cek email Anda untuk melakukan verifikasi.',
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Data tidak dapat disimpan ke database.',
                    ])->setStatusCode(500);
                }
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Email gagal dikirim.',
                ])->setStatusCode(500);
            }
        }
    }

    public function register_view_admin()
    {
        return view('pages/user/kemitraan_register');
    }

    public function register_admin_getdata()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->db->table('mitra_by_register')->where('deleted_at', null)->get()->getResultObject();
        return $this->response->setJSON($data);
    }

    public function register_approval()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON(true);
        $kode_register = $input['kode_register'];
        $RegisterModel = new RegisterModel();
        $kode_mitra = $RegisterModel->getmitra_id();
        $row = $this->db->table('mitra_by_register')->where('kode_register', $kode_register)->get()->getRow();
        $data_mitra = [
            'kode_mitra' => $kode_mitra,
            'nama_perusahaan' => $row->nama_perusahaan,
            'email' => $row->email,
            'no_hp' => $row->no_hp,
            'alamat' => $row->alamat,
            'alamat_instalasi' => $row->alamat_instalasi,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('username'),
        ];
        $data_temp = [
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => session()->get('username'),
        ];

        $query1 = $this->db->table('profile_mitra')->insert($data_mitra);
        $query2 = $this->db->table('mitra_by_register')->where('kode_register', $kode_register)->update($data_temp);
        if ($query1 && $query2) {
            $response = [
                'status' => 'success',
                'message' => 'Registrasi berhasil, data mitra telah disimpan.',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Registrasi gagal, data mitra tidak disimpan.',
            ];
        }
        return $this->response->setJSON($response);
    }

}

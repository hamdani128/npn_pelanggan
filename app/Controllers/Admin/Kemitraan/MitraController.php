<?php

namespace App\Controllers\Admin\Kemitraan;

use App\Controllers\BaseController;
use App\Models\MitraModel;
use CodeIgniter\Database\Config;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;

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
        $builder->where('a.deleted_at', null);
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

        $kode_mitra = date('Ymd') . $kd;

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
            $npwp = $this->request->getPost("npwp");

            $struktural = json_decode($this->request->getPost("struktural"), true);
            $tambahan_file = json_decode($this->request->getPost("tambahan_file_data"), true);
            $data_layanan = json_decode($this->request->getPost("data_layanan"), true);

            $start_date_price_month = $this->request->getPost("start_date_price_month");
            $end_date_price_month = $this->request->getPost("end_date_price_month");
            $tgl_lambat = $this->request->getPost("pembayaran_paling_lama_month");

            foreach ($data_layanan as $index => $row) {
                $start = new DateTime($start_date_price_month);
                $end = new DateTime($end_date_price_month);

                // Simpan data utama layanan
                $data_temp = [
                    'kode_mitra' => $mitra_id,
                    'jenis_layanan' => $row['jenis_layanan'],
                    'kapasitas' => $row['kapasitas_layanan'],
                    'quantity' => $row['satuan_layanan'],
                    'vendor' => $row['vendor_media'],
                    'alamat_instalasi' => $row['alamat_instalasi_layanan'],
                    'status_layanan' => $row['status_layanan'],
                    'deskripsi_price' => $row['deskripsi_price_month'],
                    'harga_dasar' => $row['harga_dasar_price_month'],
                    'harga_jual' => $row['harga_jual_price_month'],
                    'ppn_text' => $row['combo_ppn_price_month'],
                    'ppn' => $row['nominal_ppn_price_month'],
                    'subtotal' => $row['subtotal_price_month'],
                    'period_start' => $start_date_price_month,
                    'period_end' => $end_date_price_month,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => session()->get('username'),
                ];

                $this->db->table("profile_mitra_data_layanan")->insert($data_temp);

                // Simpan data per bulan
                while ($start <= $end) {
                    $period_start = $start->format('Y-m-01'); // awal bulan

                    // Gunakan tgl_lambat jika valid, jika tidak pakai akhir bulan
                    $last_day_of_month = $start->format('t');
                    $tgl_akhir = is_numeric($tgl_lambat) && $tgl_lambat <= $last_day_of_month ? $tgl_lambat : $last_day_of_month;
                    $period_end = $start->format("Y-m-") . str_pad($tgl_akhir, 2, "0", STR_PAD_LEFT);

                    $data_temp_periode = [
                        'kode_mitra' => $mitra_id,
                        'deskripsi_price' => $row['deskripsi_price_month'] ?? '',
                        'harga_dasar' => $row['harga_dasar_price_month'] ?? '',
                        'harga_jual' => $row['harga_jual_price_month'],
                        'ppn_text' => $row['combo_ppn_price_month'],
                        'ppn' => $row['nominal_ppn_price_month'],
                        'subtotal' => $row['subtotal_price_month'] ?? '',
                        'periode' => $period_start,
                        'last_pay_periode' => $period_end,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => session()->get('username'),
                    ];

                    $this->db->table("profile_mitra_data_layanan_periode")->insert($data_temp_periode);

                    // Tambah 1 bulan
                    $start->modify('+1 month');
                }
            }

            // otc_data
            $otc = json_decode($this->request->getPost("otc_data"), true);
            // var_dump($otc);
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

            // // Periode Price Month

            // $refrencedata = json_decode($this->request->getPost("refrencedata"), true);
            // // var_dump($refrencedata);
            // foreach ($refrencedata as $index => $row) {
            //     $harga_jual = is_numeric($row['harga_jual']) ? floatval($row['harga_jual']) : 0;
            //     $ppn_persen = is_numeric($row['ppn_text']) ? floatval($row['ppn_text']) : 0;
            //     $ppn_nominal = $harga_jual * ($ppn_persen / 100);
            //     $data_row_layanan = [
            //         'kode_mitra' => $mitra_id,
            //         'deskripsi_price' => $row['deskripsi'] ?? '',
            //         'harga_dasar' => $row['harga_dasar'] ?? '',
            //         'harga_jual' => $harga_jual,
            //         'ppn_text' => $ppn_persen,
            //         'ppn' => $ppn_nominal,
            //         'subtotal' => $row['subtotal'] ?? '',
            //         'periode' => $row['periode'] ?? '',
            //         'last_pay_periode' => $row['payment_late_date'] ?? '',
            //         'denda' => $row['denda'] ?? '',
            //         'created_at' => date('Y-m-d H:i:s'),
            //         'created_by' => session()->get('username'),
            //     ];
            //     // Simpan ke database
            //     $this->db->table("profile_mitra_data_layanan_periode")->insert($data_row_layanan);
            // }

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
                'npwp' => $npwp,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('username'),
            ];

            // var_dump($data_mitra);
            $this->db->table('profile_mitra')->insert($data_mitra);

            // // Simpan detail struktural
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

            // // Simpan tambahan dokumen
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

    public function update()
    {
        helper(['form', 'url']);

        try {
            $mitra_id = $this->request->getPost("mitra_id");
            $perusahaan = $this->request->getPost("perusahaan");
            $email = $this->request->getPost("email");
            $no_kontak = $this->request->getPost("no_kontak");
            $alamat_perusahaan = $this->request->getPost("alamat_perusahaan");
            $npwp = $this->request->getPost("npwp");
            $struktural = json_decode($this->request->getPost("struktural"), true);
            $tambahan_file = json_decode($this->request->getPost("tambahan_file_data"), true);

            $data_layanan = json_decode($this->request->getPost("data_layanan"), true);

            $start_date_price_month = $this->request->getPost("start_date_price_month");
            $end_date_price_month = $this->request->getPost("end_date_price_month");
            $tgl_lambat = $this->request->getPost("pembayaran_paling_lama_month");

            $this->db->table("profile_mitra_data_layanan")->where("kode_mitra", $mitra_id)->delete();
            $this->db->table("profile_mitra_data_layanan_periode")->where("kode_mitra", $mitra_id)->delete();
            foreach ($data_layanan as $index => $row) {
                $start = new DateTime($start_date_price_month);
                $end = new DateTime($end_date_price_month);

                // Simpan data utama layanan
                $data_temp = [
                    'kode_mitra' => $mitra_id,
                    'jenis_layanan' => $row['jenis_layanan'],
                    'kapasitas' => $row['kapasitas_layanan'],
                    'quantity' => $row['satuan_layanan'],
                    'vendor' => $row['vendor_media'],
                    'alamat_instalasi' => $row['alamat_instalasi_layanan'],
                    'status_layanan' => $row['status_layanan'],
                    'deskripsi_price' => $row['deskripsi_price_month'],
                    'harga_dasar' => $row['harga_dasar_price_month'],
                    'harga_jual' => $row['harga_jual_price_month'],
                    'ppn_text' => $row['combo_ppn_price_month'],
                    'ppn' => $row['nominal_ppn_price_month'],
                    'subtotal' => $row['subtotal_price_month'],
                    'period_start' => $start_date_price_month,
                    'period_end' => $end_date_price_month,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => session()->get('username'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => session()->get('username'),
                ];

                $this->db->table("profile_mitra_data_layanan")->insert($data_temp);

                // Simpan data per bulan
                while ($start <= $end) {
                    $period_start = $start->format('Y-m-01'); // awal bulan

                    // Gunakan tgl_lambat jika valid, jika tidak pakai akhir bulan
                    $last_day_of_month = $start->format('t');
                    $tgl_akhir = is_numeric($tgl_lambat) && $tgl_lambat <= $last_day_of_month ? $tgl_lambat : $last_day_of_month;
                    $period_end = $start->format("Y-m-") . str_pad($tgl_akhir, 2, "0", STR_PAD_LEFT);

                    $data_temp_periode = [
                        'kode_mitra' => $mitra_id,
                        'deskripsi_price' => $row['deskripsi_price_month'] ?? '',
                        'harga_dasar' => $row['harga_dasar_price_month'] ?? '',
                        'harga_jual' => $row['harga_jual_price_month'],
                        'ppn_text' => $row['combo_ppn_price_month'],
                        'ppn' => $row['nominal_ppn_price_month'],
                        'subtotal' => $row['subtotal_price_month'] ?? '',
                        'periode' => $period_start,
                        'last_pay_periode' => $period_end,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => session()->get('username'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => session()->get('username'),
                    ];

                    $this->db->table("profile_mitra_data_layanan_periode")->insert($data_temp_periode);

                    // Tambah 1 bulan
                    $start->modify('+1 month');
                }
            }

            // Update profile mitra
            $data_mitra = [
                'kode_mitra' => $mitra_id,
                'nama_perusahaan' => $perusahaan,
                'email' => $email,
                'no_hp' => $no_kontak,
                'alamat' => $alamat_perusahaan,
                'npwp' => $npwp,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => session()->get('username'),
            ];
            $this->db->table('profile_mitra')->where('kode_mitra', $mitra_id)->update($data_mitra);

            // Hapus dan simpan ulang OTC
            $otc = json_decode($this->request->getPost("otc_data"), true);
            $this->db->table("profile_mitra_data_layanan_otc")->where("kode_mitra", $mitra_id)->delete();
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
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => session()->get('username'),
                ];
                $this->db->table("profile_mitra_data_layanan_otc")->insert($data_row);
            }

            // Pastikan folder upload ada
            $uploadPath = FCPATH . 'upload/mitra/' . $mitra_id . '/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // ✅ Smart update STRUKTURAL
            foreach ($struktural as $index => $row) {
                $nik = $row['nik'];
                $data_row = [
                    'kode_mitra' => $mitra_id,
                    'nik' => $nik,
                    'nama' => $row['nama'] ?? '',
                    'no_wa' => $row['no_wa'] ?? '',
                    'email' => $row['email'] ?? '',
                    'npwp' => $row['npwp'] ?? '',
                    'posisi' => $row['posisi'] ?? '',
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => session()->get('username'),
                ];

                $file = $this->request->getFile("struktural_file_" . $index);
                $existing = $this->db->table("profile_mitra_detail")
                    ->where("kode_mitra", $mitra_id)
                    ->where("nik", $nik)
                    ->get()->getRow();

                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move($uploadPath, $newName);

                    if ($existing && !empty($existing->filename) && file_exists($uploadPath . $existing->filename)) {
                        @unlink($uploadPath . $existing->filename);
                    }

                    $data_row['filename'] = $newName;
                }

                if ($existing) {
                    $this->db->table("profile_mitra_detail")
                        ->where("kode_mitra", $mitra_id)
                        ->where("nik", $nik)
                        ->update($data_row);
                } else {
                    $data_row['created_at'] = date('Y-m-d H:i:s');
                    $data_row['created_by'] = session()->get('username');
                    $this->db->table("profile_mitra_detail")->insert($data_row);
                }
            }

            // ✅ Smart update TAMBAHAN FILE
            foreach ($tambahan_file as $index => $row) {
                $doc_id = $row['dokumen_id'];
                $data_row = [
                    'kode_mitra' => $mitra_id,
                    'doc_type_id' => $doc_id,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => session()->get('username'),
                ];

                $file = $this->request->getFile("tambahan_file_" . $index);
                $existing = $this->db->table("profile_mitra_document")
                    ->where("kode_mitra", $mitra_id)
                    ->where("doc_type_id", $doc_id)
                    ->get()->getRow();

                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move($uploadPath, $newName);

                    if ($existing && !empty($existing->file_name) && file_exists($uploadPath . $existing->file_name)) {
                        @unlink($uploadPath . $existing->file_name);
                    }

                    $data_row['file_name'] = $newName;
                }

                if ($existing) {
                    $this->db->table("profile_mitra_document")
                        ->where("kode_mitra", $mitra_id)
                        ->where("doc_type_id", $doc_id)
                        ->update($data_row);
                } else {
                    $data_row['created_at'] = date('Y-m-d H:i:s');
                    $data_row['created_by'] = session()->get('username');
                    $this->db->table("profile_mitra_document")->insert($data_row);
                }
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

    public function delete()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON(true); // true = return as array
        $kode_mitra = $input['kode_mitra'];
        $data = [
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => session()->get('username'),
        ];
        $query1 = $this->db->table("profile_mitra")->where('kode_mitra', $kode_mitra)->update($data);
        $query2 = $this->db->table("profile_mitra_data_layanan")->where('kode_mitra', $kode_mitra)->update($data);
        $query3 = $this->db->table("profile_mitra_data_layanan_otc")->where('kode_mitra', $kode_mitra)->update($data);
        $query4 = $this->db->table("profile_mitra_data_layanan_periode")->where('kode_mitra', $kode_mitra)->update($data);
        $query5 = $this->db->table("profile_mitra_document")->where('kode_mitra', $kode_mitra)->update($data);
        $query6 = $this->db->table("profile_mitra_detail")->where('kode_mitra', $kode_mitra)->update($data);

        if ($query1 && $query2 && $query3 && $query4 && $query5 && $query6) {
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
        $builder->orderBy('b.squence', 'ASC');
        $query = $builder->get()->getResult();
        return $this->response->setJSON($query);
    }

    public function getrefcode()
    {
        date_default_timezone_set('Asia/Jakarta');
        $query = $this->db->table('cg_ref_codes')->where('domain', 'OTC')->get()->getResult();
        return $this->response->setJSON($query);
    }

    public function getmitra_data_layanan()
    {
        date_default_timezone_set('Asia/Jakarta');

        $input = $this->request->getJSON(true); // true = return as array
        $kode_mitra = $input['kode_mitra'];

        $builder = $this->db->table("profile_mitra_data_layanan")
            ->where('kode_mitra', $kode_mitra)
            ->get()
            ->getResultObject();
        return $this->response->setJSON($builder);
    }

    public function getmitra_data_layanan_refrence_table()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON(true); // true = return as array
        $kode_mitra = $input['kode_mitra'];
        $builder = $this->db->table("profile_mitra_data_layanan_periode")
            ->where('kode_mitra', $kode_mitra)
            ->get()
            ->getResult();
        return $this->response->setJSON($builder);
    }

    public function getmitra_data_layanan_otc()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON(true); // true = return as array
        $kode_mitra = $input['kode_mitra'];
        $builder = $this->db->table("profile_mitra_data_layanan_otc")->where('kode_mitra', $kode_mitra)->get()->getResult();
        return $this->response->setJSON($builder);
    }

    public function print_document($kode_mitra)
    {
        // Path logo dan encode base64
        $imgPath = FCPATH . 'assets/images/header-npn.png';
        $imgData = base64_encode(file_get_contents($imgPath));
        $imgSrc = 'data:image/png;base64,' . $imgData;

        // Ambil data mitra
        $profile_mitra = $this->db->table('profile_mitra')
            ->where('kode_mitra', $kode_mitra)
            ->get()->getRow();

        // Ambil struktur organisasi (misalnya HR line dan jabatan lain)
        $profile_struktural = $this->db->table('profile_mitra_detail')
            ->where('kode_mitra', $kode_mitra)
            ->get()->getResult();

        // Ambil data tambahan file
        $profile_dokumen = $this->db->table('profile_mitra_document a')
            ->select('a.*, b.type_name')
            ->join('support_doc_types b', 'a.doc_type_id = b.id', 'LEFT')
            ->where('a.kode_mitra', $kode_mitra)
            ->orderBy('a.squence', 'ASC')
            ->get()->getResult();

        // Path folder foto profil
        $PathURLimage = FCPATH . 'upload/mitra/' . $kode_mitra . '/';
        $PathURLPublicimage = FCPATH . 'assets/images/';

        $data = [
            'judul' => 'Laporan Struktur Mitra',
            'logo_base64' => $imgSrc,
            'profile' => $profile_mitra,
            'profile_struktural' => $profile_struktural,
            'path_url_image' => $PathURLimage,
            'profile_dokumen' => $profile_dokumen,
            'path_url_public_image' => $PathURLPublicimage,
        ];

        // Render HTML view
        $html = view('pages/user/kemitraan_invoice', $data);

        // Setup Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Stream ke browser (inline PDF)
        $dompdf->stream('laporan-struktur-mitra.pdf', ['Attachment' => false]);
    }

    public function pelanggan_detail($kode_mitra)
    {
        $profile_mitra = $this->db->table('profile_mitra')
            ->where('kode_mitra', $kode_mitra)
            ->get()->getRow();

        // Ambil struktur organisasi (misalnya HR line dan jabatan lain)
        $profile_struktural = $this->db->table('profile_mitra_detail')
            ->where('kode_mitra', $kode_mitra)
            ->get()->getResult();

        $profile_data_layanan = $this->db->table('profile_mitra_data_layanan')
            ->where('kode_mitra', $kode_mitra)
            ->get()->getResult();

        $profile_data_layanan_otc = $this->db->table('profile_mitra_data_layanan_otc')
            ->where('kode_mitra', $kode_mitra)
            ->get()->getResult();

        $profile_data_layanan_periode = $this->db->table('profile_mitra_data_layanan_periode')
            ->where('kode_mitra', $kode_mitra)
            ->get()->getResult();

        // Ambil data tambahan file
        $profile_dokumen = $this->db->table('profile_mitra_document a')
            ->select('a.*, b.type_name')
            ->join('support_doc_types b', 'a.doc_type_id = b.id', 'LEFT')
            ->where('a.kode_mitra', $kode_mitra)
            ->orderBy('b.squence', 'ASC')
            ->get()->getResult();

        $data = [
            'profile' => $profile_mitra,
            'profile_struktural' => $profile_struktural,
            'profile_dokumen' => $profile_dokumen,
            'profile_data_layanan' => $profile_data_layanan,
            'profile_data_otc' => $profile_data_layanan_otc,
            'profile_data_periode' => $profile_data_layanan_periode,
        ];
        return view('pages/user/kemitraan_detail', $data);
    }

    public function activate_account()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON(true); // true = return as array
        $kode_mitra = $input['kode_mitra'];
        $row = $this->db->table('profile_mitra')->where('kode_mitra', $kode_mitra)->get()->getRow();
        $insert_users = [
            'name' => $row->nama_perusahaan,
            'email' => $row->email,
            'level' => 'Mitra',
            'username' => $row->kode_mitra,
            'password' => md5($row->kode_mitra),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $data_informasi = [
            'mitra' => $row->nama_perusahaan,
            'username' => $row->kode_mitra,
            'password' => $row->kode_mitra,
        ];
        $ModelMitra = new MitraModel();
        $ModelMitra->blast_mitra_account_activation("hamdaniversi12@gmail.com", $data_informasi);
        $query = $this->db->table('users')->insert($insert_users);
        if ($query) {
            $response = [
                'status' => 'success',
                'message' => 'Akun mitra berhasil diaktifkan',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Akun mitra gagal diaktifkan',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function nonactive_account()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON(true); // true = return as array
        $kode_mitra = $input['kode_mitra'];
        $row = $this->db->table('profile_mitra')->where('kode_mitra', $kode_mitra)->get()->getRow();
        $data_informasi = [
            'mitra' => $row->nama_perusahaan,
            'username' => $row->kode_mitra,
            'password' => $row->kode_mitra,
        ];
        $MitraModel = new MitraModel();
        $MitraModel->blast_mitra_disable_account_mitra("hamdaniversi12@gmail.com", $data_informasi);
        $query = $this->db->table('users')->where('username', $row->kode_mitra)->delete();
        if ($query) {
            $response = [
                'status' => 'success',
                'message' => 'Akun mitra berhasil dinonaktifkan',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Akun mitra gagal dinonaktifkan',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function kemitraan_deleted_history()
    {
        return view('pages/user/kemitraan_deleted_history');
    }

    public function get_deleted_history()
    {
        date_default_timezone_set('Asia/Jakarta');

        $builder = $this->db->table('profile_mitra a');
        $builder->select('a.*');
        $builder->select(
            'CASE WHEN b.username IS NULL THEN "0" ELSE "1" END AS status_account',
            false// jangan escape, biarkan raw SQL
        );
        $builder->join('users b', 'a.kode_mitra = b.username', 'left');
        $builder->where('a.deleted_at IS NOT NULL', null, false); // raw SQL condition
        $query = $builder->get()->getResult();

        return $this->response->setJSON($query);
    }

}

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

    public function get_data_invoice_otc()
    {
        date_default_timezone_set('Asia/Jakarta');
        $SQL = "SELECT a.*, b.*
            FROM profile_mitra_invoice_otc a
            LEFT JOIN profile_mitra b ON a.kode_mitra = b.kode_mitra";
        $query = $this->db->query($SQL)->getResultObject();
        return $this->response->setJSON($query);
    }

    public function get_code_mitra()
    {
        $SQL = "SELECT a.kode_mitra AS kode_mitra
                FROM profile_mitra a
                WHERE NOT EXISTS (
                    SELECT 1
                    FROM profile_mitra_invoice_otc b
                    WHERE b.kode_mitra COLLATE utf8mb4_general_ci = a.kode_mitra COLLATE utf8mb4_general_ci
                )
                ORDER BY a.kode_mitra ASC";

        $query = $this->db->query($SQL)->getResultArray();
        return $this->response->setJSON($query);
    }

    public function generate_invoice_code_otc()
    {
        $SQL = "SELECT MAX(RIGHT(invoice, 4)) AS KD_MAX
            FROM profile_mitra_invoice_otc";
        $query = $this->db->query($SQL);

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $n = ((int) $row->KD_MAX) + 1;
            $no = sprintf("%04s", $n);
        } else {
            $no = "0001";
        }

        $kode = "OTC" . date('y') . $no;

        return $this->response->setJSON(['invoice' => $kode]);
    }

    public function insert_otc()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON(true);
        $invoice_otc = $input['invoice_otc'];
        $kode_mitra = $input['kode_mitra'];
        $tgl_faktur = $input['tgl_faktur'];
        $tgl_faktur_tempo = $input['tgl_faktur_tempo'];
        $subtotal = $input['amount'];
        $ppn = $input['ppn'];
        $grand_total = $input['grand_total'];
        $terbilang = $input['terbilang'];
        $detail = $input['detail'];
        $this->db->table('profile_mitra_data_layanan_otc')->where('kode_mitra', $kode_mitra)->delete();
        foreach ($detail as $value) {
            // Ambil data dengan proteksi undefined key
            $deskripsi_price = isset($value['deskripsi_otc_add']) ? $value['deskripsi_otc_add'] : '';
            $harga_dasar = isset($value['price_dasar']) ? (int) str_replace('.', '', $value['price_dasar']) : 0;
            $price_jual = isset($value['price_jual']) ? (int) str_replace('.', '', $value['price_jual']) : 0;
            $combo_ppn = isset($value['combo_ppn']) ? (float) str_replace(',', '.', str_replace('%', '', $value['combo_ppn'])) : 0;
            $subtotal_otc = isset($value['subtotal']) ? (int) str_replace('.', '', $value['subtotal']) : 0;
            // Hitung PPN
            $ppn_value = ($combo_ppn / 100) * $price_jual;
            // Data untuk insert
            $datatemp = [
                'kode_mitra' => $kode_mitra,
                'deskripsi_price' => $deskripsi_price,
                'harga_dasar' => $harga_dasar,
                'harga_jual' => $price_jual,
                'ppn_text' => $value['combo_ppn'],
                'ppn' => $ppn_value,
                'subtotal' => $ppn_value + $price_jual,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session('username'),
            ];
            // Insert ke database
            $this->db->table('profile_mitra_data_layanan_otc')->insert($datatemp);
        }

        $data = [
            'invoice' => $invoice_otc,
            'kode_mitra' => $kode_mitra,
            'inv_date' => $tgl_faktur,
            'inv_date_tempo' => $tgl_faktur_tempo,
            'ppn' => $ppn,
            'amount' => $subtotal,
            'amount_total' => $grand_total,
            'amount_word' => $terbilang,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session('username'),
        ];

        $query = $this->db->table('profile_mitra_invoice_otc')->insert($data);
        if ($query) {
            $response = [
                'status' => 'success',
                'messages' => 'Data berhasil disimpan',
            ];
        } else {
            $response = [
                'status' => 'Error',
                'messages' => 'Data gagal disimpan',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function print_invoice_otc($invoice)
    {
        $invoice_data = $this->db->table('profile_mitra_invoice_otc')->where('invoice', $invoice)->get()->getRowObject();
        $mitra = $this->db->table('profile_mitra')->where('kode_mitra', $invoice_data->kode_mitra)->get()->getRowObject();
        $otc = $this->db->table('profile_mitra_data_layanan_otc')->where('kode_mitra', $invoice_data->kode_mitra)->get()->getResultObject();
        $data = [
            'invoice' => $invoice,
            'mitra' => $mitra,
            'invoice_data' => $invoice_data,
            'otc' => $otc,
        ];
        return view('pages/user/mitra/invoice_otc', $data);
    }

    public function get_data_invoice_otc_by_kode_mitra()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON(true);
        $kode_mitra = $input['kode_mitra'];
        $result = $this->db->table('profile_mitra_data_layanan_otc')->where('kode_mitra', $kode_mitra)->get()->getResultObject();
        return $this->response->setJSON($result);
    }

    public function update_otc()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON(true);
        $invoice_otc = $input['invoice_otc'];
        $kode_mitra = $input['kode_mitra'];
        $tgl_faktur = $input['tgl_faktur'];
        $tgl_faktur_tempo = $input['tgl_faktur_tempo'];
        $subtotal = $input['amount'];
        $ppn = $input['ppn'];
        $grand_total = $input['grand_total'];
        $terbilang = $input['terbilang'];
        $detail = $input['detail'];
        $this->db->table('profile_mitra_data_layanan_otc')->where('kode_mitra', $kode_mitra)->delete();
        foreach ($detail as $value) {
            // Ambil data dengan proteksi undefined key
            $deskripsi_price = isset($value['deskripsi_otc_edit']) ? $value['deskripsi_otc_edit'] : '';
            $harga_dasar = isset($value['price_dasar_edit']) ? (int) str_replace('.', '', $value['price_dasar_edit']) : 0;
            $price_jual = isset($value['price_jual_edit']) ? (int) str_replace('.', '', $value['price_jual_edit']) : 0;
            $combo_ppn = isset($value['combo_ppn_edit']) ? (float) str_replace(',', '.', str_replace('%', '', $value['combo_ppn_edit'])) : 0;
            $subtotal_otc = isset($value['subtotal_edit']) ? (int) str_replace('.', '', $value['subtotal_edit']) : 0;
            // Hitung PPN
            $ppn_value = ($combo_ppn / 100) * $price_jual;
            // Data untuk insert
            $datatemp = [
                'kode_mitra' => $kode_mitra,
                'deskripsi_price' => $deskripsi_price,
                'harga_dasar' => $harga_dasar,
                'harga_jual' => $price_jual,
                'ppn_text' => $value['combo_ppn_edit'],
                'ppn' => $ppn_value,
                'subtotal' => $ppn_value + $price_jual,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session('username'),
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => session('username'),
            ];
            // Insert ke database
            $this->db->table('profile_mitra_data_layanan_otc')->insert($datatemp);
        }

        $data = [
            'inv_date' => $tgl_faktur,
            'inv_date_tempo' => $tgl_faktur_tempo,
            'ppn' => $ppn,
            'amount' => $subtotal,
            'amount_total' => $grand_total,
            'amount_word' => $terbilang,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => session('username'),
        ];

        $query = $this->db->table('profile_mitra_invoice_otc')->where('invoice', $invoice_otc)->update($data);
        if ($query) {
            $response = [
                'status' => 'success',
                'messages' => 'Data berhasil diubah',
            ];
        } else {
            $response = [
                'status' => 'Error',
                'messages' => 'Data gagal diubah',
            ];
        }
        return $this->response->setJSON($response);
    }

}

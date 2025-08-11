<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;

class Home extends BaseController
{

    private $db, $UserInfo;
    public function __construct()
    {
        $this->db = Config::connect();
        $this->UserInfo = $this->db->table('users')->where('id', session()->get('loggedUser'))->get()->getRowObject();
        if ($this->UserInfo && session_id() !== $this->UserInfo->session_id) {
            $data = [
                'ip' => 0,
                'browser' => "",
                'valid' => 0,
                'date_logout' => date('Y-m-d H:i:s'),
                'session_id' => "",
            ];
            $this->db->table('users')->where('id', session('loggedUser'))->update($data);
            session()->remove('loggedUser');
            session_destroy();
            header('Location: ' . base_url('auth/login'));
            exit;
        }
    }

    public function index()
    {
        return view('pages/su/index');
    }

    public function mitra()
    {
        $kode_mitra = session('username');
        $profile_mitra = $this->db->table('profile_mitra')
            ->where('kode_mitra', $kode_mitra)
            ->get()->getRow();
        $profile_struktural = $this->db->table('profile_mitra_detail')
            ->where('kode_mitra', $kode_mitra)
            ->get()->getResult();

        $profile_data_layanan = $this->db->table('profile_mitra_data_layanan')
            ->where('kode_mitra', $kode_mitra)
            ->get()->getRow();

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
            'profile' => $profile_mitra,
            'profile_struktural' => $profile_struktural,
            'profile_dokumen' => $profile_dokumen,
            'profile_data_layanan' => $profile_data_layanan,
            'profile_data_otc' => $profile_data_layanan_otc,
            'profile_data_periode' => $profile_data_layanan_periode,
        ];
        return view('pages/user/index', $data);
    }
}

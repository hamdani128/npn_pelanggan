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
        if (session()->get('level') === "super admin") {
            return view('pages/su/index');
        } else {
            return view('pages/user/index');
        }
    }
}

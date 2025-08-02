<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class LoginController extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = Config::connect();
    }

    public function index()
    {
        return view('auth/login');
    }

    public function forgot_password()
    {
        return view('auth/forgot_password');
    }

    public function check_login()
    {
        date_default_timezone_set('Asia/Kolkata');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $browser = $this->request->getPost("browser");
        $ip = file_get_contents("https://api.ipify.org");
        $hash_password = md5($password);
        $userInfo = $this->db->table('users')->where('username', $username)->where('password', $hash_password)->get()->getRowObject();
        if (!empty($userInfo)) {
            $sessionData = [
                'loggedUser' => $userInfo->id,
                'user_id' => $userInfo->id,
                'username' => $userInfo->username,
                'email' => $userInfo->email,
                'ip' => $ip,
                'name' => $userInfo->name,
                'level' => $userInfo->level,
                'login_time' => date('Y-m-d H:i:s'),
            ];
            session()->set($sessionData);
            $data = [
                'ip' => $ip,
                'browser' => $browser,
                'valid' => 1,
                'date_login' => date('Y-m-d H:i:s'),
                'session_id' => session_id(),
            ];
            $query = $this->db->table('users')->where('id', $userInfo->id)->update($data);
            if ($query) {
                $response = [
                    'status' => 'success',
                    'message' => 'Login Successfull',
                    'data' => $sessionData,
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Something went wrong',
                ];
            }
        } else {
            $response = [
                'status' => 'user not found',
                'message' => 'Invalid Username or Password',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function send_email()
    {
        date_default_timezone_set('Asia/Jakarta');
        $input = $this->request->getJSON();
        $email = $input->email;
        echo $email;
        // return $this->response->setJSON([
        //     'status' => 'success',
        //     'message' => 'Email berhasil dikirim ke ' . $email,
        // ]);
    }
    public function logout()
    {
        helper(['url', 'form']);
        if (session()->has('loggedUser')) {
            $data = [
                'ip' => 0,
                'browser' => "",
                'valid' => 0,
                'date_logout' => date('Y-m-d H:i:s'),
                'session_id' => "",
            ];
            $query = $this->db->table('users')->where('id', session('loggedUser'))->update($data);
            session()->remove('loggedUser');
            session()->destroy();
            return redirect()->to('auth/login')->with('logout', 'You Are logged Out');
        }
    }
}

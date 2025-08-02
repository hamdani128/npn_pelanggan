<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;

class AuthCheckFilter implements FilterInterface
{
    protected $timeout = 14400; // 15 menit (900 detik)

    public function before(RequestInterface $request, $arguments = null)
    {
        date_default_timezone_set('Asia/Jakarta');

        $session = session();
        $loggedUserId = $session->get('loggedUser');

        if (!$loggedUserId) {
            return redirect()->to('auth/login')->with('warning', 'Harap login terlebih dahulu');
        }

        $db = Database::connect();
        $user = $db->table('users')->where('id', $loggedUserId)->get()->getRowObject();

        if (!$user) {
            return $this->forceLogout($loggedUserId, $db, $session, 'User tidak ditemukan.');
        }

        // Ambil last activity dari session
        $lastActivity = $session->get('lastActivity');
        $now = time();

        if ($lastActivity && ($now - $lastActivity) > $this->timeout) {
            return $this->forceLogout($loggedUserId, $db, $session, 'Session Anda telah kedaluwarsa. Silakan login kembali.');
        }

        // Perbarui last_activity di session dan database
        $session->set('lastActivity', $now);
        $db->table('users')->where('id', $loggedUserId)->update([
            'last_activity' => date('Y-m-d H:i:s'),
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kosong (optional jika mau manipulasi response)
    }

    private function forceLogout($userId, $db, $session, $message)
    {
        $db->table('users')->where('id', $userId)->update([
            'ip' => 0,
            'browser' => '',
            'valid' => 0,
            'date_logout' => date('Y-m-d H:i:s'),
            'session_id' => '',
            'last_activity' => null,
        ]);

        $session->destroy();
        return redirect()->to('auth/login')->with('warning', $message);
    }
}

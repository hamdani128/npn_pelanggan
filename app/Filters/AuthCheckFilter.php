<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;

class AuthCheckFilter implements FilterInterface
{
    protected $timeout = 900; // 15 menit (900 detik)

    public function before(RequestInterface $request, $arguments = null)
    {
        // Gunakan timezone global atau konfigurasi CI (index.php)
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

        // ✅ Cek session_id cocok tidak
        // if (session_id() !== $user->session_id) {
        //     return $this->forceLogout($loggedUserId, $db, $session, 'Session Anda tidak valid. Silakan login kembali.');
        // }

        // ✅ Cek timeout aktivitas terakhir
        if ($user->last_activity && strtotime($user->last_activity) < (time() - $this->timeout)) {
            return $this->forceLogout($loggedUserId, $db, $session, 'Session Anda telah kedaluwarsa. Silakan login kembali.');
        }

        // ✅ Update aktivitas terakhir user jika masih valid
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

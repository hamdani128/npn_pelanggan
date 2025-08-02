<?php

namespace App\Models;

use CodeIgniter\Database\Config;
use CodeIgniter\Model;

class RegisterModel extends Model
{

    protected $db, $UserInfo;

    public function __construct()
    {
        $this->db = Config::connect();
    }

    public function blast_mitra_register_for_register($email_to, $data)
    {
        $email = \Config\Services::email();

        // Set konfigurasi email
        $email->setFrom('cscare_noreply@npn.net.id', 'PT NETINDO PERSADA NUSANTARA');
        $email->setTo($email_to);

        // Optional: jika ingin kirim ke CC
        // $email->setCC(['cc1@example.com', 'cc2@example.com']);

        $email->setSubject('Register Success');

        // Isi email HTML
        $message = '
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; }
            .container { background-color: #ffffff; padding: 20px; border-radius: 8px; max-width: 600px; margin: 30px auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
            .header { font-size: 20px; font-weight: bold; color: #2c3e50; margin-bottom: 15px; }
            .content { font-size: 15px; line-height: 1.6; }
            .footer { margin-top: 30px; font-size: 12px; color: #999999; }
            .highlight { color: #007BFF; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">Halo dari PT NETINDO PERSADA NUSANTARA,</div>
            <div class="content">
                <p>Kami dengan senang hati menginformasikan bahwa akun anda telah berhasil terdaftar.</p>
                <p>Berikut adalah detail akun Anda:</p>
                <ul>
                    <li>No. Registrasi: <span class="highlight">' . esc($data['kode_register']) . '</span></li>
                    <li>Nama Perusahaan: <span class="highlight">' . esc($data['nama_perusahaan']) . '</span></li>
                    <li>Email: <span class="highlight">' . esc($data['email']) . '</span></li>
                    <li>No. Kontak: <span class="highlight">' . esc($data['no_hp']) . '</span></li>
                    <li>Alamat Perusahaan: <span class="highlight">' . esc($data['alamat']) . '</span></li>
                    <li>Alamat Instalasi: <span class="highlight">' . esc($data['alamat_instalasi']) . '</span></li>
                </ul>
                <p>Untuk proses pendalaman kerja sama bisnis, silakan kunjungi kantor kami:</p>
                <p><strong>Alamat:</strong> Jl. Cucak Rw. I Kel No.81, Kenangan Baru, Kec. Percut Sei Tuan, Kabupaten Deli Serdang, Sumatera Utara 20371</p>
                <p><strong>Telepon:</strong> 0852-7500-0675</p>
                <p><strong>Website:</strong> <a href="https://npn.net.id">https://npn.net.id</a></p>
            </div>
            <div class="footer">
                Email ini dikirim otomatis oleh sistem kami. Harap tidak membalas email ini.
            </div>
        </div>
    </body>
    </html>
    ';

        $email->setMessage($message);

        // Coba kirim email dan cek hasil
        if ($email->send()) {
            $email->clear(); // Bersihkan pengaturan setelah kirim
            return true;
        } else {
            log_message('error', 'Email gagal dikirim: ' . print_r($email->printDebugger(['headers', 'subject', 'body']), true));
            return false;
        }
    }

    public function blast_mitra_register_for_manajemen($data)
    {
        $email = \Config\Services::email();
        $data_to = $this->db->table('employee')->get()->getResult();

        foreach ($data_to as $key => $value) {
            $email_to = $value->email;
            // Konfigurasi email
            $email->setFrom('cscare_noreply@npn.net.id', 'PT NETINDO PERSADA NUSANTARA');
            $email->setTo($email_to);

            // Judul email
            $email->setSubject('Informasi Pendaftaran Mitra Baru');

            // Isi email dalam HTML
            $message = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; }
                .container { background-color: #ffffff; padding: 20px; border-radius: 8px; max-width: 600px; margin: 30px auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
                .header { font-size: 20px; font-weight: bold; color: #2c3e50; margin-bottom: 15px; }
                .content { font-size: 15px; line-height: 1.6; }
                .footer { margin-top: 30px; font-size: 12px; color: #999999; }
                .highlight { color: #007BFF; font-weight: bold; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">Pendaftaran Mitra Baru</div>
                <div class="content">
                    <p>Dengan hormat,</p>
                    <p>Kami informasikan bahwa terdapat pendaftaran mitra baru melalui sistem registrasi. Berikut detail informasi mitra yang mendaftar:</p>
                    <ul>
                        <li>No. Registrasi: <span class="highlight">' . esc($data['kode_register']) . '</span></li>
                        <li>Nama Perusahaan: <span class="highlight">' . esc($data['nama_perusahaan']) . '</span></li>
                        <li>Email: <span class="highlight">' . esc($data['email']) . '</span></li>
                        <li>No. Kontak: <span class="highlight">' . esc($data['no_hp']) . '</span></li>
                        <li>Alamat Perusahaan: <span class="highlight">' . esc($data['alamat']) . '</span></li>
                        <li>Alamat Instalasi: <span class="highlight">' . esc($data['alamat_instalasi']) . '</span></li>
                    </ul>
                    <p>Mohon agar informasi ini dapat ditindaklanjuti sesuai dengan prosedur yang berlaku.</p>
                    <p>Terima kasih atas perhatian dan kerjasamanya.</p>
                    <br>
                    <p>Hormat kami,</p>
                    <p><strong>PT NETINDO PERSADA NUSANTARA</strong></p>
                </div>
                <div class="footer">
                    Email ini dikirim otomatis oleh sistem kami. Harap tidak membalas email ini.
                </div>
            </div>
        </body>
        </html>
        ';

            $email->setMessage($message);

            // Kirim email
            if ($email->send()) {
                $email->clear(); // Bersihkan setelah pengiriman
            } else {
                log_message('error', 'Email gagal dikirim ke ' . $email_to . ': ' . print_r($email->printDebugger(['headers', 'subject', 'body']), true));
            }
        }

        return true;
    }

}

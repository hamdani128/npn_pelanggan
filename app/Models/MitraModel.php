<?php

namespace App\Models;

use CodeIgniter\Model;

class MitraModel extends Model
{
    public function blast_mitra_account_activation($email_to, $data)
    {
        $email = \Config\Services::email();
        $email->setTo($email_to);
        $email->setFrom('cscare_noreply@npn.net.id', 'PT NETINDO PERSADA NUSANTARA');
        $email->setSubject('Aktivasi Akun Anda Telah Berhasil');
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
                    <p>Kami dengan senang hati menginformasikan mitra kami ' . $data['mitra'] . ' <span class="highlight">akun Anda telah berhasil diaktifkan</span>.</p>
                    <p>Berikut adalah detail akun Anda:</p>
                    <ul>
                        <li>Username: <span class="highlight">' . $data['username'] . '</span></li>
                        <li>Password: <span class="highlight">' . $data['password'] . '</span></li>
                    </ul>
                    <p>Anda sekarang dapat mengakses sistem kami dan menggunakan seluruh fitur yang tersedia.</p>
                    <p>Silakan login menggunakan email ini sebagai nama pengguna Anda. Jika Anda mengalami kendala atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi tim support kami.</p>
                    <p>Terima kasih telah menjadi bagian dari PT NETINDO PERSADA NUSANTARA.</p>
                </div>
                <div class="footer">
                    Email ini dikirim secara otomatis oleh sistem kami. Harap tidak membalas email ini.
                </div>
            </div>
        </body>
    </html>
    ';
        $email->setMessage($message);
        $result = $email->send();
        $email->clear();
        return $result;
    }

    public function blast_mitra_disable_account_mitra($email_to, $data)
    {
        $email = \Config\Services::email();
        $email->setTo($email_to);
        $email->setFrom('cscare_noreply@npn.net.id', 'PT NETINDO PERSADA NUSANTARA');
        $email->setSubject('Pemberitahuan: Akun Anda Dinonaktifkan');

        $message = '
    <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; }
                .container { background-color: #ffffff; padding: 20px; border-radius: 8px; max-width: 600px; margin: 30px auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
                .header { font-size: 20px; font-weight: bold; color: #c0392b; margin-bottom: 15px; }
                .content { font-size: 15px; line-height: 1.6; }
                .footer { margin-top: 30px; font-size: 12px; color: #999999; }
                .highlight { color: #c0392b; font-weight: bold; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">Pemberitahuan Penonaktifan Akun</div>
                <div class="content">
                    <p>Yth. Mitra <strong>' . $data['mitra'] . '</strong>,</p>
                    <p>Kami ingin memberitahukan bahwa <span class="highlight">akun Anda telah dinonaktifkan</span> oleh sistem kami.</p>
                    <p>Penonaktifan ini dilakukan karena alasan tertentu, seperti kelengkapan data belum dipenuhi atau adanya kebijakan internal perusahaan.</p>
                    <p>Jika Anda yakin ini adalah kesalahan atau membutuhkan klarifikasi lebih lanjut, silakan hubungi tim support kami melalui email atau nomor kontak yang tersedia.</p>
                    <p>Kami siap membantu Anda kapan saja.</p>
                </div>
                <div class="footer">
                    Email ini dikirim secara otomatis oleh sistem kami. Harap tidak membalas email ini.
                </div>
            </div>
        </body>
    </html>
    ';

        $email->setMessage($message);
        $result = $email->send();
        $email->clear();
        return $result;
    }

}

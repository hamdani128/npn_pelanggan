<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice - <?=esc($judul)?></title>
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo-npn.png">
    <style>
    @page {
        margin-top: 130px;
        margin-bottom: 60px;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .header-logo {
        position: fixed;
        top: -140px;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 1000;
    }

    .header-logo img {
        max-height: 140px;
    }

    .separator-line {
        border-top: 5px solid #000;
        width: 120%;
        margin-top: 5px;
        margin-left: -50px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11pt;
    }

    td,
    th {
        padding: 6px;
        vertical-align: top;
    }

    .section-title {
        background-color: black;
        color: white;
        border: 1px solid #000;
        font-weight: bold;
    }

    .label-cell {
        width: 180px;
        border: 1px solid #000;
        border-right: none;
        font-weight: bold;
    }

    .colon-cell {
        width: 10px;
        text-align: center;
        border: 1px solid #000;
        border-left: none;
        border-right: none;
    }

    .value-cell {
        border: 1px solid #000;
        border-left: none;
    }

    h4 {
        margin: 20px 0 5px;
        font-size: 13pt;
    }
    </style>
</head>

<body>

    <!-- Fixed Header with Logo and HR -->
    <div class="header-logo">
        <img src="<?=$logo_base64?>" alt="Logo">
        <div class="separator-line"></div>
    </div>

    <!-- Judul -->
    <table style="margin-top: 2px;">
        <tr>
            <td style="text-align: center;">
                <h4>LAMPIRAN DOKUMEN BERLANGGANAN</h4>
            </td>
        </tr>
    </table>

    <!-- Profile Perusahaan -->
    <table style="margin-top: 0px;">
        <tr class="section-title">
            <td colspan="3">Profile Perusahaan</td>
        </tr>
        <tr>
            <td class="label-cell">Nama Perusahaan</td>
            <td class="colon-cell">:</td>
            <td class="value-cell"><?=esc($profile->nama_perusahaan)?></td>
        </tr>
        <tr>
            <td class="label-cell">E-Mail Perusahaan</td>
            <td class="colon-cell">:</td>
            <td class="value-cell"><?=esc($profile->email)?></td>
        </tr>
        <tr>
            <td class="label-cell">No.HP Kantor</td>
            <td class="colon-cell">:</td>
            <td class="value-cell"><?=esc($profile->no_hp)?></td>
        </tr>
        <tr>
            <td class="label-cell">Alamat Perusahaan</td>
            <td class="colon-cell">:</td>
            <td class="value-cell"><?=esc($profile->alamat)?></td>
        </tr>
        <tr>
            <td class="label-cell">Alamat Instalasi</td>
            <td class="colon-cell">:</td>
            <td class="value-cell"><?=esc($profile->alamat_instalasi)?></td>
        </tr>

        <?php foreach ($profile_struktural as $row): ?>
        <tr>
            <td colspan="3">
                <h4>KTP PENANGGUNG JAWAB <?=esc($row->posisi)?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <tr>
                        <td style="width: 50%; vertical-align: top;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td class="label-cell">NIK</td>
                                    <td class="colon-cell">:</td>
                                    <td class="value-cell"><?=esc($row->nik)?></td>
                                </tr>
                                <tr>
                                    <td class="label-cell">Nama</td>
                                    <td class="colon-cell">:</td>
                                    <td class="value-cell"><?=esc($row->nama)?></td>
                                </tr>
                                <tr>
                                    <td class="label-cell">No.WA</td>
                                    <td class="colon-cell">:</td>
                                    <td class="value-cell"><?=esc($row->no_wa)?></td>
                                </tr>
                                <tr>
                                    <td class="label-cell">E-mail</td>
                                    <td class="colon-cell">:</td>
                                    <td class="value-cell"><?=esc($row->email)?></td>
                                </tr>
                                <tr>
                                    <td class="label-cell">NPWP</td>
                                    <td class="colon-cell">:</td>
                                    <td class="value-cell"><?=esc($row->npwp)?></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 50%; text-align: center;vertical-align: top;border: 1px solid #000;">
                            <?php
$imgPath = $path_url_image . $row->filename;
$imgSrc = '';

if (file_exists($imgPath)) {
    $imgBase64 = base64_encode(file_get_contents($imgPath));
    $imgSrc = 'data:image/png;base64,' . $imgBase64;
}
?>
                            <?php if ($imgSrc): ?>
                            <img src="<?=$imgSrc?>" alt="KTP" style="max-height: 140px;margin-top: 20px;">
                            <?php else: ?>
                            <span>Tidak ada gambar</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <table style="margin-top: 0px;">
        <tr class="section-title">
            <td colspan="3">Lampiran Dokumen</td>
        </tr>
        <?php foreach ($profile_dokumen as $row): ?>
        <tr>
            <td class="label-cell" colspan="2">
                <span><?=$row->type_name?></span>
            </td>
            <td style="border: 1px solid #000; border-left: none; text-align: center;">
                <?php
// Path file foto KTP
$imgPath = $path_url_image . $row->file_name;

// Path ke gambar check dan cancel
$checkPath = $path_url_public_image . "check.png";
$cancelPath = $path_url_public_image . "Cancel.png";

// Siapkan variabel gambar check/cancel dalam bentuk base64
$imgSrcCheck = '';
$imgSrcCancel = '';

if (file_exists($checkPath)) {
    $imgSrcCheck = 'data:image/png;base64,' . base64_encode(file_get_contents($checkPath));
}

if (file_exists($cancelPath)) {
    $imgSrcCancel = 'data:image/png;base64,' . base64_encode(file_get_contents($cancelPath));
}
?>

                <?php if ($row->file_name != '' || $row->file_name != null): ?>
                <img src="<?=$imgSrcCheck?>" alt="Check" style="max-height: 20px; margin-top: 0px;">
                <?php else: ?>
                <img src="<?=$imgSrcCancel?>" alt="Cancel" style="max-height: 20px; margin-top: 0px;">
                <?php endif; ?>
            </td>

        </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>
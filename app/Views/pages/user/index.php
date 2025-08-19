<?=$this->Extend('layout/index');?>
<?=$this->section('content');?>

<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="<?=base_url()?>assets/images/logo-npn.png" alt="User profile picture" width="80">
                    </div>

                    <h6 class="profile-username text-center"><?=session('name')?></h6>

                    <div class="text-center mb-2">
                        <button class="btn btn-sm btn-primary">
                            <i class="fas fa-camera"></i>
                            change photo
                        </button>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">About Company</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-envelope mr-1"></i> E-Mail</strong>

                    <p class="text-muted">
                        <?=$profile->email?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat Perusahaan</strong>
                    <p class="text-muted">
                        <?=$profile->alamat?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-map-marker mr-1"></i> Alamat Instalasi</strong>
                    <p class="text-muted">
                        <?=$profile->alamat_instalasi?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-mobile mr-1"></i> No.Kontak</strong>
                    <p class="text-muted">
                        <?=$profile->no_hp?>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-light p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#activity" data-toggle="tab">
                                <i class="fas fa-solid fa-users mr-1"></i>
                                Data Perusahaan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#timeline" data-toggle="tab">
                                <i class="fas fa-solid fa-wifi mr-1"></i>
                                Data Layanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#settings" data-toggle="tab">
                                <i class="fas fa-solid fa-file mr-1"></i>
                                Dokumen Support
                            </a>
                        </li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <?php foreach ($profile_struktural as $row) {?>
                            <div class="card shadow-lg border-0 mb-4 rounded-3 overflow-hidden">
                                <div class="card-header text-white"
                                    style="background: linear-gradient(90deg, #0066cc, #004d99);">
                                    <h6 class="mb-0 text-white">
                                        <i class="fas fa-user-tie me-2"></i> PENANGGUNG JAWAB
                                        STRUKTURAL - <?=$row->posisi?>
                                    </h6>
                                </div>
                                <div class="card-body" style="background-color: #f8f9fa;">
                                    <div class="row align-items-center">
                                        <!-- Info Table -->
                                        <div class="col-md-7">
                                            <table class="table table-borderless table-sm mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th style="width: 35%">NIK</th>
                                                        <td><?=$row->nik?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <td><?=$row->nama?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>E-Mail</th>
                                                        <td><?=$row->email?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>No. Kontak</th>
                                                        <td><?=$row->no_wa?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Image -->
                                        <div class="col-md-5 text-center">
                                            <?php if (!empty($row->filename)) {?>
                                            <img src="<?=base_url('upload/mitra/' . $row->kode_mitra . '/' . $row->filename)?>"
                                                alt="Dokumen" class="img-fluid rounded shadow-sm border"
                                                style="max-height: 200px; object-fit: cover;">
                                            <?php } else {?>
                                            <img src="<?=base_url('assets/images/id-card-blank.png')?>"
                                                alt="ID Card Kosong" class="img-fluid rounded shadow-sm border"
                                                style="max-height: 200px; object-fit: cover;">
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>

                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table style="width: 100%; border-collapse: collapse;">
                                            <tbody>
                                                <tr style="height: 30px;">
                                                    <td style="width: 20%;">
                                                        <b>Jenis Layanan</b>
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td><?=$profile_data_layanan->jenis_layanan?></td>
                                                </tr>
                                                <tr style="height: 30px;">
                                                    <td><b>Kapasitas</b></td>
                                                    <td>:</td>
                                                    <td>
                                                        <?=$profile_data_layanan->kapasitas?>
                                                        <?=$profile_data_layanan->quantity?>
                                                    </td>
                                                </tr>
                                                <tr style="height: 30px;">
                                                    <td><b>Vendor</b></td>
                                                    <td>:</td>
                                                    <td><?=$profile_data_layanan->vendor?></td>
                                                </tr>
                                                <tr style="height: 30px;">
                                                    <td><b>Price List</b></td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <table
                                                            class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead class="bg-dark text-white">
                                                                <tr>
                                                                    <th style="width: 20%;text-align: center;">
                                                                        Deskripsi
                                                                    </th>
                                                                    <th style="width: 10%;text-align: center;">
                                                                        Harga Jual
                                                                    </th>
                                                                    <th style="width: 10%;text-align: center;">
                                                                        PPN
                                                                        (<?=$profile_data_layanan->ppn_text?>%)
                                                                    </th>
                                                                    <th style="width: 10%;text-align: center;">
                                                                        Subtotal
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <?=$profile_data_layanan->deskripsi_price?>
                                                                    </td>

                                                                    <td>
                                                                        <?=number_format($profile_data_layanan->harga_jual, 0, ',', '.')?>
                                                                    </td>
                                                                    <td>
                                                                        <?=number_format($profile_data_layanan->ppn, 0, ',', '.')?>
                                                                    </td>
                                                                    <td>
                                                                        <?=number_format($profile_data_layanan->subtotal, 0, ',', '.')?>
                                                                    </td>
                                                                </tr>
                                                                <hr>
                                                            </tbody>
                                                        </table>
                                                        <hr>
                                                        <h5>On Time Charge</h5>
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                <thead class="bg-dark text-white">
                                                                    <tr>
                                                                        <th style="width: 15%;text-align: center;">
                                                                            Deskripsi
                                                                        </th>
                                                                        <th style="width: 10%;text-align: center;">
                                                                            Harga Jual
                                                                        </th>
                                                                        <th style="width: 5%;text-align: center;">
                                                                            PPN(%)
                                                                        </th>
                                                                        <th style="width: 10%;text-align: center;">
                                                                            Subtotal
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($profile_data_otc as $dt) {?>
                                                                    <tr>
                                                                        <td>
                                                                            <label><?=$dt->deskripsi_price?></label>
                                                                        </td>
                                                                        <td style="text-align: right;">
                                                                            <span><?=number_format($dt->harga_jual, 0, ',', '.')?></span>
                                                                        </td>
                                                                        <td style="text-align: center;">
                                                                            <span><?=$dt->ppn_text?>%</span>
                                                                        </td>
                                                                        <td style="text-align: center;">
                                                                            <span><?=number_format($dt->subtotal, 0, ',', '.')?></span>
                                                                        </td>
                                                                    </tr>
                                                                    <?php }?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div> -->


                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <!-- <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                            style="border-collapse: collapse; border-spacing: 0; width: 150%;">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th style="width: 1%;text-align: center;">
                                                        #
                                                    </th>
                                                    <th style="width: 1%;text-align: center;">
                                                        Act
                                                    </th>
                                                    <th style="width: 10%;text-align: center;">
                                                        Status
                                                    </th>
                                                    <th style="width: 12%;text-align: center;">
                                                        Periode
                                                    </th>
                                                    <th style="width: 12%;text-align: center;">
                                                        Payment Date
                                                    </th>
                                                    <th style="width: 12%;text-align: center;">
                                                        Metode
                                                    </th>
                                                    <th style="width: 15%;text-align: center;">
                                                        Deskripsi
                                                    </th>

                                                    <th style="width: 10%;text-align: center;">
                                                        Harga Jual
                                                    </th>
                                                    <th style="width: 5%;text-align: center;">
                                                        PPN(%)
                                                    </th>
                                                    <th style="width: 10%;text-align: center;">
                                                        Subtotal
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($profile_data_periode as $dt) {?>
                                                <tr>
                                                    <td><?=$no++;?></td>
                                                    <td>
                                                        <div class="button-group">
                                                            <?php if ($dt->status == '' || $dt->status == null) {?>
                                                            <button class="btn btn-primary btn-sm">
                                                                <i class="fa fa-upload"></i>
                                                            </button>
                                                            <?php } else {?>
                                                            <button class="btn btn-dark btn-sm">
                                                                <i class="fa fa-show"></i>
                                                            </button>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php if ($dt->status == '' || $dt->status == null) {?>
                                                        <span class="badge badge-danger">
                                                            Belum Bayar
                                                        </span>
                                                        <?php } else {?>
                                                        <span class="badge badge-success">
                                                            Sudah Bayar
                                                        </span>
                                                        <?php }?>
                                                    </td>
                                                    <td>
                                                        <label><?=$dt->periode?></label>
                                                    </td>
                                                    <td>
                                                        <label><?=$dt->pay_date?></label>
                                                    </td>
                                                    <td>
                                                        <label><?=$dt->metode?></label>
                                                    </td>
                                                    <td>
                                                        <label><?=$dt->deskripsi_price?></label>
                                                    </td>

                                                    <td style="text-align: right;">
                                                        <span><?=number_format($dt->harga_jual, 0, ',', '.')?></span>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <span><?=$dt->ppn_text?>%</span>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <span><?=number_format($dt->subtotal, 0, ',', '.')?></span>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> -->

                            <div class="card border-0 shadow-lg rounded-3">
                                <div class="card-body">
                                    <div id="accordion">
                                        <?php foreach ($profile_dokumen as $index => $dt):
    $file_extension = strtolower(pathinfo($dt->file_name, PATHINFO_EXTENSION));
    $file_url = base_url('upload/mitra/' . $dt->kode_mitra . '/' . $dt->file_name);
    $collapseId = 'collapse' . $index;
    $headingId = 'heading' . $index;
    ?>
                                        <div class="mb-3 border rounded overflow-hidden shadow-sm">
                                            <!-- Header Accordion -->
                                            <div class="p-3 bg-gradient-primary text-white" id="<?=$headingId?>"
                                                data-toggle="collapse" data-target="#<?=$collapseId?>"
                                                aria-expanded="<?=$index === 0 ? 'true' : 'false'?>"
                                                aria-controls="<?=$collapseId?>" style="cursor: pointer;">
                                                <h6 class="mb-0 text-white">
                                                    <i class="fas fa-file-alt me-2"></i>
                                                    <?=$dt->type_name?>
                                                </h6>
                                            </div>

                                            <!-- Body Accordion -->
                                            <div id="<?=$collapseId?>" class="collapse <?=$index === 0 ? 'show' : ''?>"
                                                aria-labelledby="<?=$headingId?>" data-parent="#accordion">
                                                <div class="p-3 text-center bg-light">
                                                    <?php if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                                    <img src="<?=$file_url?>" alt="Document Image"
                                                        class="img-fluid rounded shadow-sm"
                                                        style="max-height: 400px; object-fit: contain;">

                                                    <?php elseif ($file_extension === 'pdf'): ?>
                                                    <?php if (preg_match('/Mobile|Android|iPhone|iPad/i', $_SERVER['HTTP_USER_AGENT'])): ?>
                                                    <!-- Versi HP pakai PDF.js -->
                                                    <iframe
                                                        src="<?=base_url('assets/pdfjs/web/viewer.html')?>?file=<?=urlencode($file_url)?>"
                                                        style="width:100%; height:500px; border:none;"></iframe>

                                                    <?php else: ?>
                                                    <!-- Versi Desktop pakai embed -->
                                                    <embed src="<?=$file_url?>" type="application/pdf" width="100%"
                                                        height="500px" class="rounded shadow-sm">
                                                    <?php endif; ?>

                                                    <!-- Tombol Download -->
                                                    <a href="<?=$file_url?>" target="_blank"
                                                        class="btn btn-primary mt-2">
                                                        <i class="fas fa-download"></i> Download PDF
                                                    </a>

                                                    <?php elseif (in_array($file_extension, ['doc', 'docx'])): ?>
                                                    <p><strong>Dokumen Word</strong></p>
                                                    <a href="<?=$file_url?>" target="_blank" class="btn btn-primary">
                                                        <i class="fas fa-download"></i> Lihat / Unduh
                                                    </a>

                                                    <?php else: ?>
                                                    <p><em>Tipe file tidak dikenali</em></p>
                                                    <a href="<?=$file_url?>" target="_blank" class="btn btn-secondary">
                                                        <i class="fas fa-download"></i> Download File
                                                    </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

</div>
<!-- container-fluid -->



<style>
.bg-gradient-primary {
    background: linear-gradient(90deg, #0066cc, #004d99);
}

#accordion .collapse.show {
    animation: fadeIn 0.4s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>


<!-- end row -->

<?=$this->endSection();?>
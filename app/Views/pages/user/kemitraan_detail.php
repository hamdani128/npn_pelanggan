<?=$this->Extend('layout/index')?>
<?=$this->section('content')?>

<div class="container-fluid" ng-app="KemitraanApp" ng-controller="KemitraanAppController">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <button class="btn btn-md btn-dark" ng-click="backToKemitraan()">
                    <i class="fa fa-arrow-left"></i>
                    Kembali
                </button>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Modul Pelanggan</a></li>
                        <li class="breadcrumb-item active">Kemitraan - Reseller</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom">
                <div class="fro_profile">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 mb-3 mb-lg-0">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-toggle="tab" href="#home-struktural"
                                                role="tab">
                                                <i class="dripicons-home mr-1 align-middle"></i> <span
                                                    class="d-none d-md-inline-block">Data Perusahaan </span>
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-toggle="tab" href="#data_layanan" role="tab">
                                                <i class="dripicons-wifi mr-1 align-middle"></i> <span
                                                    class="d-none d-md-inline-block">Data Layanan</span>
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-toggle="tab" href="#data_billing" role="tab">
                                                <i class="dripicons-wallet mr-1 align-middle"></i> <span
                                                    class="d-none d-md-inline-block">Billing</span>
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-toggle="tab" href="#messages-justify" role="tab">
                                                <i class="dripicons-suitcase mr-1 align-middle"></i> <span
                                                    class="d-none d-md-inline-block">Ducuments</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content p-3">
                                        <div class="tab-pane active" id="home-struktural" role="tabpanel">
                                            <div class="row">
                                                <!-- Card Logo & Nama Perusahaan -->
                                                <div class="col-md-4 mb-4">
                                                    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                                                        <div class="card-body p-4 text-center"
                                                            style="background: linear-gradient(135deg, #0066cc, #004d99); color: white;">
                                                            <!-- Foto/logo -->
                                                            <div class="user-thumb mb-3">
                                                                <img src="<?=base_url()?>assets/images/logo-npn.png"
                                                                    class="rounded-circle img-thumbnail mx-auto d-block border border-3 border-light shadow-sm"
                                                                    style="width: 120px; height: 120px; object-fit: cover;"
                                                                    alt="thumbnail">
                                                            </div>

                                                            <!-- Info Utama -->
                                                            <div>
                                                                <h5 class="mb-1 fw-bold text-white">
                                                                    <?=$profile->kode_mitra?></h5>
                                                                <h6 class="mb-0 text-white">
                                                                    <?=$profile->nama_perusahaan?></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Card About Company -->
                                                <div class="col-md-8 mb-4">
                                                    <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                                                        <div class="card-header text-white"
                                                            style="background: linear-gradient(90deg, #17a2b8, #138496);">
                                                            <h5 class="mb-0 text-white"><i
                                                                    class="fas fa-building me-2"></i>
                                                                About Company
                                                            </h5>
                                                        </div>
                                                        <div class="card-body" style="background-color: #f8f9fa;">
                                                            <strong>
                                                                <i class="fas fa-envelope me-2"></i>
                                                                E-Mail
                                                            </strong>
                                                            <p class="text-muted"><?=$profile->email?></p>
                                                            <hr>
                                                            <strong>
                                                                <i class="fas fa-map-marker-alt me-2"></i>
                                                                Alamat Perusahaan
                                                            </strong>
                                                            <p class="text-muted"><?=$profile->alamat?></p>
                                                            <hr>

                                                            <strong>
                                                                <i class="fas fa-mobile-alt me-2"></i>
                                                                No.Kontak
                                                            </strong>
                                                            <p class="text-muted"><?=$profile->no_hp?></p>
                                                            <hr>

                                                            <strong>
                                                                <i class="fa fa-address-card me-2"></i>
                                                                NPWP
                                                            </strong>
                                                            <p class="text-muted"><?=$profile->npwp?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-sm-12">
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
                                                                        alt="Dokumen"
                                                                        class="img-fluid rounded shadow-sm border"
                                                                        style="max-height: 200px; object-fit: cover;">
                                                                    <?php } else {?>
                                                                    <img src="<?=base_url('assets/images/id-card-blank.png')?>"
                                                                        alt="ID Card Kosong"
                                                                        class="img-fluid rounded shadow-sm border"
                                                                        style="max-height: 200px; object-fit: cover;">
                                                                    <?php }?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php }?>


                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="data_layanan" role="tabpanel">
                                            <?php $no = 1; ?>
                                            <?php foreach ($profile_data_layanan as $row) {?>

                                            <div class="card">
                                                <div class="card-header">
                                                    <label for="" class="form-label">Data Layanan <?=$no++;?></label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table style="width: 100%; border-collapse: collapse;">
                                                            <tbody>
                                                                <tr style="height: 30px;">
                                                                    <td style="width: 20%;">
                                                                        <b>Jenis Layanan</b>
                                                                    </td>
                                                                    <td style="width: 2%;">:</td>
                                                                    <td><?=$row->jenis_layanan?></td>
                                                                </tr>
                                                                <tr style="height: 30px;">
                                                                    <td><b>Kapasitas</b></td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <?=$row->kapasitas?>
                                                                        <?=$row->quantity?>
                                                                    </td>
                                                                </tr>
                                                                <tr style="height: 30px;">
                                                                    <td><b>Vendor</b></td>
                                                                    <td>:</td>
                                                                    <td><?=$row->vendor?></td>
                                                                </tr>
                                                                <tr style="height: 30px;">
                                                                    <td><b>Alamat Instalasi</b></td>
                                                                    <td>:</td>
                                                                    <td><?=$row->alamat_instalasi?></td>
                                                                </tr>
                                                                <tr style="height: 30px;">
                                                                    <td><b>Status Layanan</b></td>
                                                                    <td>:</td>
                                                                    <td><?=$row->status_layanan?></td>
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
                                                                                    <th
                                                                                        style="width: 20%;text-align: center;">
                                                                                        Deskripsi
                                                                                    </th>
                                                                                    <th
                                                                                        style="width: 10%;text-align: center;">
                                                                                        Harga Dasar
                                                                                    </th>
                                                                                    <th
                                                                                        style="width: 10%;text-align: center;">
                                                                                        Harga Jual
                                                                                    </th>
                                                                                    <th
                                                                                        style="width: 10%;text-align: center;">
                                                                                        PPN
                                                                                        (<?=$row->ppn_text?>%)
                                                                                    </th>
                                                                                    <th
                                                                                        style="width: 10%;text-align: center;">
                                                                                        Subtotal
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <?=$row->deskripsi_price?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?=number_format($row->harga_dasar, 0, ',', '.')?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?=number_format($row->harga_jual, 0, ',', '.')?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?=number_format($row->ppn, 0, ',', '.')?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?=number_format($row->subtotal, 0, ',', '.')?>
                                                                                    </td>
                                                                                </tr>
                                                                                <hr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <div class="card">
                                                <div class="card-body">
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
                                                                        Harga Dasar
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
                                                                        <span><?=number_format($dt->harga_dasar, 0, ',', '.')?></span>
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
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="data_billing" role="tabpanel">
                                            <div class="card">
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
                                                                        Harga Dasar
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
                                                                        <span><?=number_format($dt->harga_dasar, 0, ',', '.')?></span>
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
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="messages-justify" role="tabpanel">
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
	                                                            <div class="p-3 bg-gradient-primary text-white"
	                                                                id="<?=$headingId?>" data-toggle="collapse"
	                                                                data-target="#<?=$collapseId?>"
	                                                                aria-expanded="<?=$index === 0 ? 'true' : 'false'?>"
	                                                                aria-controls="<?=$collapseId?>"
	                                                                style="cursor: pointer;">
	                                                                <h6 class="mb-0 text-white">
	                                                                    <i class="fas fa-file-alt me-2"></i>
	                                                                    <?=$dt->type_name?>
	                                                                </h6>
	                                                            </div>

	                                                            <!-- Body Accordion -->
	                                                            <div id="<?=$collapseId?>"
	                                                                class="collapse <?=$index === 0 ? 'show' : ''?>"
	                                                                aria-labelledby="<?=$headingId?>"
	                                                                data-parent="#accordion">
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
                                                                    <embed src="<?=$file_url?>" type="application/pdf"
                                                                        width="100%" height="500px"
                                                                        class="rounded shadow-sm">
                                                                    <?php endif; ?>

                                                                    <!-- Tombol Download -->
                                                                    <a href="<?=$file_url?>" target="_blank"
                                                                        class="btn btn-primary mt-2">
                                                                        <i class="fas fa-download"></i> Download PDF
                                                                    </a>

                                                                    <?php elseif (in_array($file_extension, ['doc', 'docx'])): ?>
                                                                    <p><strong>Dokumen Word</strong></p>
                                                                    <a href="<?=$file_url?>" target="_blank"
                                                                        class="btn btn-primary">
                                                                        <i class="fas fa-download"></i> Lihat / Unduh
                                                                    </a>

                                                                    <?php else: ?>
                                                                    <p><em>Tipe file tidak dikenali</em></p>
                                                                    <a href="<?=$file_url?>" target="_blank"
                                                                        class="btn btn-secondary">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end f_profile-->
            </div>
            <!--end card-body-->

            <div class="card-body">

            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->

<!-- <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h6 class="card-title text-white">Data Kemitraan Profile</h6>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-md-2 col-form-label">
                        ID Pelanggan
                    </label>
                    <div class="col-md-10">
                        <input type="text" name="mitra_id" id="mitra_id" class="form-control" placeholder="ID Mitra"
                            readonly value="<?=$profile->kode_mitra?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="" for="example-text-input"
                                                        class="col-md-2 col-form-label">
                                                        Nama Perusahaan
                                                    </label>
                                                    <div class="col-md-10">
                                                        <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                                                            class="form-control" placeholder="Nama Perusahaan" readonly
                                                            value="<?=$profile->nama_perusahaan?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="" for="example-text-input"
                                                        class="col-md-2 col-form-label">
                                                        E-mail
                                                    </label>
                                                    <div class="col-md-10">
                                                        <input type="email" name="email" id="email" class="form-control"
                                                            placeholder="E-mail" readonly value="<?=$profile->email?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="" for="example-text-input"
                                                        class="col-md-2 col-form-label">
                                                        No.Kontak
                                                    </label>
                                                    <div class="col-md-10">
                                                        <input type="text" name="no_kontak" id="no_kontak"
                                                            class="form-control" placeholder="No.Kontak"
                                                            value="<?=$profile->no_hp?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="" for="example-text-input"
                                                        class="col-md-2 col-form-label">
                                                        Alamat
                                                    </label>
                                                    <div class="col-md-10">
                                                        <textarea name="alamat_perusahaan" id="alamat_perusahaan"
                                                            cols="3" rows="3" class="form-control"
                                                            placeholder="Alamat Perusahaan"><?=trim($profile->alamat)?></textarea>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="" for="example-text-input"
                                                        class="col-md-2 col-form-label">
                                                        Alamat Instalasi
                                                    </label>
                                                    <div class="col-md-10">
                                                        <textarea name="alamat_instalasi" id="alamat_instalasi" cols="3"
                                                            rows="3" class="form-control"
                                                            placeholder="Alamat Instalasi"><?=trim($profile->alamat_instalasi)?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

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

<?=$this->endSection();?>
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
                        <div class="col-lg-3 mb-3 mb-lg-0">
                            <div class="fro_profile-main text-center p-3 border rounded shadow-sm bg-white">
                                <!-- Foto/logo -->
                                <div class="user-thumb mb-3">
                                    <img src="<?=base_url()?>assets/images/logo-npn.png"
                                        class="rounded-circle avatar-lg img-thumbnail mx-auto d-block" alt="thumbnail">
                                </div>

                                <!-- Info Utama -->
                                <div class="fro_profile_user-detail">
                                    <h5 class="mb-1 font-size-18 font-weight-bold"><?=$profile->kode_mitra?></h5>
                                    <h6 class="mb-3 font-size-16"><?=$profile->nama_perusahaan?></h6>
                                </div>

                                <!-- Info Detail dalam Table -->
                                <table class="table table-sm table-borderless text-left mx-auto"
                                    style="max-width: 100%; width: 90%;">
                                    <tbody>
                                        <tr>
                                            <th>Email Perusahaan :</th>
                                        </tr>
                                        <tr>
                                            <td><span style="color: #007bff;"><?=$profile->email?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>No. Kontak :</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span style="color: #007bff;">
                                                    <?=$profile->no_hp?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Alamat Perusahaan :</th>
                                        </tr>
                                        <tr>
                                            <td style="text-align: justify;color: #007bff;"><?=$profile->alamat?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat Instalasi :</th>
                                        </tr>
                                        <tr>
                                            <td style="text-align: justify;color: #007bff;">
                                                <?=$profile->alamat_instalasi?></td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>

                        <!--end col-->

                        <div class="col-lg-9 mb-3 mb-lg-0">
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
                                            <?php foreach ($profile_struktural as $row) {?>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-3">PENANGGUNG JAWAB STRUKTURAL
                                                        <?=$row->posisi?>
                                                    </h5>
                                                    <div class="table-responsive">
                                                        <table>
                                                            <tr>
                                                                <td style="width: 30%;">NIK</td>
                                                                <td style="width: 5%;">:</td>
                                                                <td><?=$row->nik?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 30%;">Nama</td>
                                                                <td style="width: 5%;">:</td>
                                                                <td><?=$row->nama?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 30%;">E-Mail</td>
                                                                <td style="width: 5%;">:</td>
                                                                <td><?=$row->email?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 30%;">No.Kontak</td>
                                                                <td style="width: 5%;">:</td>
                                                                <td><?=$row->no_wa?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 30%;">Dokumen</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <?php if ($row->filename != '' || $row->filename != null) {?>
                                                                    <img src="<?php echo base_url('upload/mitra/' . $row->kode_mitra . '/' . $row->filename); ?>"
                                                                        alt="" style="width: 300px; height: 200px;">
                                                                    <?php } else {?>
                                                                    <img src="<?php echo base_url('assets/images/id-card-blank.png'); ?>"
                                                                        alt="" style="width: 300px; height: 200px;">
                                                                    <?php }?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="tab-pane" id="data_layanan" role="tabpanel">
                                            <div class="card">
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
                                                                                        (<?=$profile_data_layanan->ppn_text?>%)
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
                                                                                        <?=$profile_data_layanan->deskripsi_price?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?=number_format($profile_data_layanan->harga_dasar, 0, ',', '.')?>
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
                                                                                        <th
                                                                                            style="width: 15%;text-align: center;">
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
                                                                                            style="width: 5%;text-align: center;">
                                                                                            PPN(%)
                                                                                        </th>
                                                                                        <th
                                                                                            style="width: 10%;text-align: center;">
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
                                                                    </td>
                                                                </tr>
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
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="accordion">
                                                        <?php foreach ($profile_dokumen as $index => $dt) {?>
                                                        <?php $file_extension = strtolower(pathinfo($dt->file_name, PATHINFO_EXTENSION)); ?>
                                                        <?php $file_url = base_url('upload/mitra/' . $dt->kode_mitra . '/' . $dt->file_name); // sesuaikan path file ?>
                                                        <?php $collapseId = 'collapse' . $index; ?>
                                                        <?php $headingId = 'heading' . $index; ?>
                                                        <div class="card mb-2">
                                                            <div class="card-header" id="<?=$headingId?>">
                                                                <h5 class="m-0 font-size-14">
                                                                    <a data-toggle="collapse" data-parent="#accordion"
                                                                        href="#<?=$collapseId?>" aria-expanded="true"
                                                                        aria-controls="<?=$collapseId?>"
                                                                        class="text-dark">
                                                                        <?=$dt->type_name?>
                                                                    </a>
                                                                </h5>
                                                            </div>

                                                            <div id="<?=$collapseId?>"
                                                                class="collapse <?=$index === 0 ? 'show' : ''?>"
                                                                aria-labelledby="<?=$headingId?>"
                                                                data-parent="#accordion">
                                                                <div class="card-body text-center">
                                                                    <?php if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                                                    <img src="<?=$file_url?>" alt="Document Image"
                                                                        class="img-fluid" style="max-height: 400px;">
                                                                    <?php elseif ($file_extension === 'pdf'): ?>
                                                                    <embed src="<?=$file_url?>" type="application/pdf"
                                                                        width="100%" height="500px">
                                                                    <?php elseif (in_array($file_extension, ['doc', 'docx'])): ?>
                                                                    <p><strong>Dokumen Word:</strong> <a
                                                                            href="<?=$file_url?>" target="_blank">Lihat
                                                                            / Unduh</a></p>
                                                                    <?php else: ?>
                                                                    <p><em>Tipe file tidak dikenali: <a
                                                                                href="<?=$file_url?>"
                                                                                target="_blank">Download File</a></em>
                                                                    </p>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php }?>
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



<?=$this->endSection();?>
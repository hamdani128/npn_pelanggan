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
                                <i class="fas fa-solid fa-file-invoice mr-1"></i>
                                Billing
                            </a>
                        </li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
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
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
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
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
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


<!-- end row -->

<?=$this->endSection();?>
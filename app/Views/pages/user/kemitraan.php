<?=$this->Extend('layout/index')?>
<?=$this->section('content')?>

<div class="container-fluid" ng-app="KemitraanApp" ng-controller="KemitraanAppController">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Data Kemitraan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Modul Pelanggan</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Kemitraan - Reseller</a></li>
                        <li class="breadcrumb-item active">Kemitraan - Reseller</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row pb-5">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-md btn-primary" ng-click="Add()">
                                <i class="fa fa-plus"></i>
                                Tambah Pelanggan
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable" datatable="ng" dt-options="vm.dtOptions"
                                class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 30%;text-align: center;">Profile Mitra</th>
                                        <th style="width: 8%;text-align: center;">Status Account</th>
                                        <th style="width: 15%;text-align: center;">Created at</th>
                                        <th style="width: 13%;text-align: center;">Act</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    <tr ng-repeat="dt in RowLegalitas" ng-if="RowLegalitas.length > 0"
                                        ng-click="selectRow(dt)" ng-class="{'selected-row': selectedRow === dt}">
                                        <td>{{$index + 1}}</td>
                                        <td style="text-align: left;">
                                            <table style="width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 30%; font-weight: bold;">Kode Mitra</td>
                                                        <td style="width: 5%; text-align: right;">:</td>
                                                        <td>{{dt.kode_mitra}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold;">Nama</td>
                                                        <td style="text-align: right;">:</td>
                                                        <td>{{dt.nama_perusahaan}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold;">Email</td>
                                                        <td style="text-align: right;">:</td>
                                                        <td>{{dt.email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold;">Kontak</td>
                                                        <td style="text-align: right;">:</td>
                                                        <td>{{dt.no_hp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold;">Alamat</td>
                                                        <td style="text-align: right;">:</td>
                                                        <td>{{dt.alamat || '-'}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold;">NPWP</td>
                                                        <td style="text-align: right;">:</td>
                                                        <td>{{dt.npwp || '-'}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>

                                        <td>
                                            <span class="badge badge-success" ng-if="dt.status_account == '1'">Account
                                                Active</span>
                                            <span class="badge badge-danger" ng-if="dt.status_account == '0'">Account
                                                Non Active</span>
                                        </td>
                                        <td>{{dt.created_at}}</td>
                                        <td>
                                            <div class="input-group">
                                                <button class="btn btn-sm btn-danger"
                                                    ng-click="Delete(dt); $event.stopPropagation()">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning"
                                                    ng-click="EditShow(dt); $event.stopPropagation()">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <!-- <button class="btn btn-sm btn-dark"
                                                    ng-click="showProfile(dt); $event.stopPropagation()">
                                                    <i class="fa fa-eye"></i>
                                                </button> -->
                                                <button class="btn btn-sm btn-success"
                                                    ng-click="ActivateAccount(dt); $event.stopPropagation()"
                                                    ng-if="dt.status_account == '0'">
                                                    <i class="fa fa-key"></i>
                                                </button>
                                                <button class="btn btn-sm btn-success"
                                                    ng-click="NonActiveAccount(dt); $event.stopPropagation()"
                                                    ng-if="dt.status_account == '1'">
                                                    <i class="fa fa-user-times" aria-hidden="true"></i>
                                                </button>
                                                <!-- <button class="btn btn-sm btn-secondary"
                                                    ng-click="Print(dt); $event.stopPropagation()">
                                                    <i class="fa fa-print"></i>
                                                </button> -->

                                            </div>
                                        </td>
                                    </tr>
                                    <tr ng-if="RowLegalitas.length === 0">
                                        <td colspan="7" style="text-align: center;">No data available</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

    <!-- Modal Add -->
    <div id="My-Modal-Add" class="modal fade modal-right" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title mt-0 text-white"> Tambah Data Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#custom-home" role="tab">
                                <i class="dripicons-user mr-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Data Pelanggan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#custom-profile" role="tab">
                                <i class="dripicons-briefcase mr-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Profile Organisasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#custom-messages" role="tab">
                                <i class="dripicons-wifi mr-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Data Layanan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#custom-settings" role="tab">
                                <i class="dripicons-suitcase mr-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Dokumen Support</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="custom-home" role="tabpanel">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label">
                                    ID Mitra
                                </label>
                                <div class="col-md-10">
                                    <input type="text" name="mitra_id" id="mitra_id" class="form-control"
                                        placeholder="ID Mitra" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" for="example-text-input" class="col-md-2 col-form-label">
                                    Nama Perusahaan
                                </label>
                                <div class="col-md-10">
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control"
                                        placeholder="Nama Perusahaan">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" for="example-text-input" class="col-md-2 col-form-label">
                                    E-mail
                                </label>
                                <div class="col-md-10">
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="E-mail">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" for="example-text-input" class="col-md-2 col-form-label">
                                    No.Kontak
                                </label>
                                <div class="col-md-10">
                                    <input type="text" name="no_kontak" id="no_kontak" class="form-control"
                                        placeholder="No.Kontak">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" for="example-text-input" class="col-md-2 col-form-label">
                                    Alamat
                                </label>
                                <div class="col-md-10">
                                    <textarea name="alamat_perusahaan" id="alamat_perusahaan" cols="3" rows="3"
                                        class="form-control" placeholder="Alamat Perusahaan"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" for="example-text-input" class="col-md-2 col-form-label">
                                    NPWP
                                </label>
                                <div class="col-md-10">
                                    <input type="text" name="npwp" id="npwp" class="form-control" placeholder="NPWP">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="custom-profile" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 justify-content-end">
                                            <button class="btn btn-md btn-dark" ng-click="AddBaris()">
                                                <i class="fa fa-plus"></i>
                                                Tambah
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                    style="border-collapse: collapse; border-spacing: 0; width: 150%;">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th style="width: 3%;">#</th>
                                                            <th style="width: 3%;text-align: center;">Act</th>
                                                            <th style="width: 10%;text-align: center;">NIK</th>
                                                            <th style="width: 10%;text-align: center;">Nama</th>
                                                            <th style="width: 10%;text-align: center;">No.Wa
                                                            </th>
                                                            <th style="width: 10%;text-align: center;">Email
                                                            </th>
                                                            <th style="width: 10%;text-align: center;">NPWP</th>
                                                            <th style="width: 15%;text-align: center;">FileName
                                                            </th>
                                                            <th style="width: 10%;text-align: center;">Posisi
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody-struktural">
                                                        <tr ng-repeat="item in listData track by $index">
                                                            <td>{{$index + 1}}</td>
                                                            <td>
                                                                <button class="btn btn-sm btn-danger"
                                                                    ng-click="HapusBaris($index)">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                            <td><input type="text" ng-model="item.nik"
                                                                    class="form-control" /></td>
                                                            <td><input type="text" ng-model="item.nama"
                                                                    class="form-control" /></td>
                                                            <td><input type="text" ng-model="item.no_wa"
                                                                    class="form-control" /></td>
                                                            <td><input type="email" ng-model="item.email"
                                                                    class="form-control" /></td>
                                                            <td><input type="text" ng-model="item.npwp"
                                                                    class="form-control" /></td>
                                                            <td>
                                                                <input type="file" ng-model="item.filename"
                                                                    class="form-control" />
                                                            </td>
                                                            <td><input type="text" ng-model="item.posisi"
                                                                    class="form-control" /></td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="custom-messages" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-md btn-info" ng-click="AddLayanan()">
                                        <i class="fa fa-plus"></i>
                                        Tambah Layanan
                                    </button>
                                </div>
                            </div>

                            <div ng-repeat="layanan in listDataLayananArray track by $index">
                                <div class="row mb-1">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header bg-info d-flex justify-content-between">
                                                <label class="text-white">Transaction Layanan {{$index + 1}}</label>
                                                <button class="btn btn-sm btn-danger" ng-click="DeleteLayanan($index)">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                            <div class="card-body bg-light">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-3 col-form-label">
                                                                Jenis Layanan
                                                            </label>
                                                            <div class="col-md-9">
                                                                <select ng-model="layanan.jenis_layanan"
                                                                    class="form-control">
                                                                    <option value="">Pilih Jenis Layanan :</option>
                                                                    <option value="Layanan corporate">Layanan corporate
                                                                    </option>
                                                                    <option value="Layanan kemitraan">Layanan kemitraan
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-3 col-form-label">
                                                                Kapasitas Layanan
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        ng-model="layanan.kapasitas_layanan"
                                                                        class="form-control" placeholder="sample : 100">
                                                                    <select ng-model="layanan.satuan_layanan"
                                                                        class="form-control">
                                                                        <option value="">Pilih Satuan :</option>
                                                                        <option value="Mbps">Mbps</option>
                                                                        <option value="Gbps">Gbps</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-3 col-form-label">
                                                                Vendor / Media Hantar Jaringan
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    <select ng-model="layanan.vendor_media"
                                                                        class="form-control">
                                                                        <option value="">Pilih :</option>
                                                                        <option
                                                                            value="PT Mega Akses Persada / Fiberstar">PT
                                                                            Mega Akses Persada / Fiberstar</option>
                                                                        <option value="PT Telkom Indonesia / Telkom">PT
                                                                            Telkom Indonesia / Telkom</option>
                                                                        <option value="Mandiri">Mandiri</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-3 col-form-label">
                                                                Alamat Instalasi
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    <textarea
                                                                        ng-model="layanan.alamat_instalasi_layanan"
                                                                        class="form-control" cols="5"
                                                                        rows="5"></textarea>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-3 col-form-label">
                                                                Status Layanan
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    <select ng-model="layanan.status_layanan"
                                                                        class="form-control">
                                                                        <option value="">Pilih :</option>
                                                                        <option value="Baru">Baru</option>
                                                                        <option value="Upgrade">Upgrade</option>
                                                                        <option value="Perpanjangan">Perpanjangan
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-12 col-form-label">
                                                                Price / Rate
                                                            </label>
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-header bg-dark">
                                                                        <label for="" class="text-white">Price Month
                                                                            Periode</label>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div
                                                                            class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                                            <div class="form-group row">
                                                                                <label for=""
                                                                                    class="col-md-3 col-form-label">
                                                                                    Deskripsi :
                                                                                </label>
                                                                                <input type="text"
                                                                                    ng-model="layanan.deskripsi_price_month"
                                                                                    class="form-control col-md-9"
                                                                                    placeholder="Deskripsi">
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for=""
                                                                                    class="col-md-3 col-form-label">
                                                                                    Harga Dasar :
                                                                                </label>
                                                                                <input type="text"
                                                                                    ng-model="layanan.harga_dasar_price_month"
                                                                                    ng-change="layanan.harga_dasar_price_month = formatNumberAuto(layanan.harga_dasar_price_month)"
                                                                                    class="form-control col-md-9">
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for=""
                                                                                    class="col-md-3 col-form-label">
                                                                                    Harga Jual :
                                                                                </label>
                                                                                <input type="text"
                                                                                    ng-model="layanan.harga_jual_price_month"
                                                                                    ng-change="CalculateHargaMonth(layanan)"
                                                                                    class="form-control col-md-9">
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for=""
                                                                                    class="col-md-3 col-form-label">
                                                                                    PPN (%) :
                                                                                </label>
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="input-daterange input-group">
                                                                                        <select
                                                                                            ng-model="layanan.combo_ppn_price_month"
                                                                                            ng-change="CalculateHargaMonth(layanan)"
                                                                                            class="form-control">
                                                                                            <option value="">Pilih :
                                                                                            </option>
                                                                                            <option value="10">10%
                                                                                            </option>
                                                                                            <option value="11">11%
                                                                                            </option>
                                                                                            <option value="12">12%
                                                                                            </option>
                                                                                        </select>
                                                                                        <input type="text"
                                                                                            ng-model="layanan.nominal_ppn_price_month"
                                                                                            class="form-control col-md-9"
                                                                                            readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for=""
                                                                                    class="col-md-3 col-form-label">
                                                                                    Subtotal :
                                                                                </label>
                                                                                <input type="text"
                                                                                    ng-model="layanan.subtotal_price_month"
                                                                                    class="form-control col-md-9"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- OTC -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <h6 class="card-title text-white">OTC (On Time
                                                Charge)</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-1">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <button class="btn btn-md btn-dark" ng-click="AddBarisOTC()">
                                                        <i class="fa fa-plus"></i>
                                                        Tambah OTC
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead class="bg-dark text-white">
                                                                <tr>
                                                                    <th style="width: 2%;text-align: center;">
                                                                        #</th>
                                                                    <th style="width: 5%;">Act
                                                                    </th>
                                                                    <th style="width: 25%;text-align: center;">
                                                                        Deskripsi
                                                                    </th>
                                                                    <th style="width: 15%;text-align: center;">
                                                                        Harga Dasar
                                                                    </th>
                                                                    <th style="width: 15%;text-align: center;">
                                                                        Harga Jual
                                                                    </th>
                                                                    <th style="width: 8%;text-align: center;">
                                                                        PPN(%)
                                                                    </th>
                                                                    <th style="width: 15%;text-align: center;">
                                                                        Subtotal
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody-otc">
                                                                <tr ng-repeat="dt in listDataOtcArray track by $index">
                                                                    <td>{{$index + 1}}</td>
                                                                    <td>
                                                                        <button class="btn btn-sm btn-danger"
                                                                            ng-click="DeleteOtc($index)">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                    <td>
                                                                        <textarea ng-model="dt.deskripsi_otc_add"
                                                                            name="deskripsi_otc_add"
                                                                            id="deskripsi_otc_add" cols="3" rows="3"
                                                                            class="form-control"></textarea>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" ng-model="dt.price_dasar"
                                                                            class="form-control"
                                                                            ng-change="FormatFieldNumber(dt, 'price_dasar')" />
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" ng-model="dt.price_jual"
                                                                            class="form-control"
                                                                            ng-change="UpdateSubtotalOtc(dt)" />
                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control"
                                                                            ng-model="dt.combo_ppn"
                                                                            ng-change="UpdateSubtotalOtc(dt)">
                                                                            <option value="">
                                                                                Pilih :</option>
                                                                            <option value="10">
                                                                                10%</option>
                                                                            <option value="11">
                                                                                11%</option>
                                                                            <option value="12">
                                                                                12%</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" ng-model="dt.subtotal"
                                                                            class="form-control" readonly />
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="" class="col-md-3 col-form-label">
                                                    Periode Kerja Sama :
                                                </label>
                                                <div class="col-md-9">
                                                    <div class="input-group button-group">
                                                        <input type="date" name="start_date_price_month"
                                                            id="start_date_price_month" class="form-control"
                                                            placeholder="Periode Start">
                                                        <input type="date" name="end_date_price_month"
                                                            id="end_date_price_month" class="form-control"
                                                            placeholder="Periode Start">
                                                        <!-- <button class="btn btn-md btn-dark" type="button"
                                                            ng-click="SetTableRefrencePeriode()">
                                                            <i class="fa fa-table"></i>
                                                        </button> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-md-3 col-form-label">
                                                    Tanggal Pembayaran Paling
                                                    Lama :
                                                </label>
                                                <input type="text" name="pembayaran_paling_lama_month"
                                                    id="pembayaran_paling_lama_month" class="form-control col-md-9"
                                                    placeholder="Example : 10">
                                            </div>
                                            <!-- <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#home"
                                                        role="tab">
                                                        <i class="dripicons-document-edit mr-1 align-middle"></i>
                                                        <span class="d-none d-md-inline-block">
                                                            Form
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                                        <i class="dripicons-browser mr-1 align-middle"></i>
                                                        <span class="d-none d-md-inline-block">
                                                            Table Refrence Periode
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul> -->
                                            <!-- Tab panes -->
                                            <!-- <div class="tab-content p-3">
                                                <div class="tab-pane active" id="home" role="tabpanel">

                                                </div>
                                                <div class="tab-pane" id="profile" role="tabpanel">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                                style="border-collapse: collapse; border-spacing: 0; width: 120%;">
                                                                <thead class="bg-dark text-white">
                                                                    <tr>
                                                                        <th style="width: 12%;text-align: center;">
                                                                            Deskripsi
                                                                        </th>
                                                                        <th style="width: 10%;text-align: center;">
                                                                            Harga Dasar
                                                                        </th>
                                                                        <th style="width: 10%;text-align: center;">
                                                                            Harga Jual
                                                                        </th>
                                                                        <th style="width: 10%;text-align: center;">
                                                                            PPN(%)
                                                                        </th>
                                                                        <th style="width: 12%;text-align: center;">
                                                                            Subtotal
                                                                        </th>
                                                                        <th style="width: 10%;text-align: center;">
                                                                            Periode
                                                                        </th>
                                                                        <th style="width: 13%;text-align: center;">
                                                                            Payment Late
                                                                            Date
                                                                        </th>
                                                                        <th style="width: 10%;text-align: center;">
                                                                            Denda
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody-RefrencePeriode">
                                                                    <tr ng-repeat="dt in ListDataArrayRefrencePeriode">
                                                                        <td>
                                                                            <label>{{ dt.deskripsi_label_price_month }}</label>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text"
                                                                                ng-model="dt.price_dasar_price_month"
                                                                                class="form-control" readonly />
                                                                        </td>
                                                                        <td>
                                                                            <input type="text"
                                                                                ng-model="dt.price_jual_price_month"
                                                                                class="form-control"
                                                                                ng-change="updateSubtotal(dt)"
                                                                                readonly />
                                                                        </td>
                                                                        <td>
                                                                            <input type="text"
                                                                                name="dt.ppn_text_price_month_periode"
                                                                                id="dt.ppn_text_price_month_periode"
                                                                                ng-model="dt.ppn_text_price_month_periode"
                                                                                class="form-control" readonly />
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" ng-model="dt.subtotal"
                                                                                class="form-control" readonly />
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" ng-model="dt.periode"
                                                                                class="form-control" readonly />
                                                                        </td>
                                                                        <td>
                                                                            <input type="text"
                                                                                ng-model="dt.payment_late_date"
                                                                                class="form-control" readonly />
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" ng-model="dt.denda"
                                                                                class="form-control" />
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="custom-settings" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row pt-2">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th style="width: 2%;text-align: center;">#</th>
                                                            <th style="width: 5%;display: none;">ID</th>
                                                            <th style="width: 15%;text-align: center;">Nama
                                                                Dokumen</th>
                                                            <th style="width: 15%;text-align: center;">FileName
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody-tambahan">
                                                        <tr ng-repeat="dt in listDataDocTambahan">
                                                            <td style="width: 2%;text-align: center;">
                                                                {{$index + 1}}
                                                            </td>
                                                            <td style="width: 2%;text-align: center; display: none;">
                                                                <input type="hidden" value="{{dt.id}}"
                                                                    class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" ng-model="dt.type_name"
                                                                    value="{{dt.type_name}}" class="form-control"
                                                                    readonly />
                                                            </td>
                                                            <td>
                                                                <input type="file" ng-model="dt.filename"
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="button" class="btn btn-md btn-primary" ng-click="Insert()">
                        <i class="fa fa-paper-plane"></i>
                        submit
                    </button>
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                        close
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- Modal Show Profile -->
    <div id="My-Modal-Show-Profile" class="modal fade modal-right" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title mt-0 text-white"> Profile Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-toggle="tab" href="#home-justify" role="tab">
                                <i class="dripicons-user mr-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Data Pelanggan</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#profile-justify" role="tab">
                                <i class="dripicons-briefcase mr-1 align-middle"></i>
                                <span class="d-none d-md-inline-block">
                                    Profile Organisasi
                                </span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#messages-justify" role="tab">
                                <i class="dripicons-wifi mr-1 align-middle"></i>
                                <span class="d-none d-md-inline-block">
                                    Data Layanan
                                </span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#settings-justify" role="tab">
                                <i class="dripicons-gear mr-1 align-middle"></i>
                                <span class="d-none d-md-inline-block">
                                    Dokumen Support
                                </span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="home-justify" role="tabpanel">
                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label">ID Mitra</label>
                                <input type="text" name="mitra_id_profile" id="mitra_id_profile"
                                    class="form-control col-md-10" placeholder="ID Mitra" readonly>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label">Nama Perusahaan</label>
                                <input type="text" name="nama_perusahaan_profile" id="nama_perusahaan_profile"
                                    class="form-control col-md-10" placeholder="Nama Perusahaan" readonly>
                            </div>

                            <div class="form-group row">
                                <label for="" class="form-label col-md-2">E-mail</label>
                                <input type="email" name="email_profile" id="email_profile"
                                    class="form-control col-md-10" placeholder="E-mail" readonly>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label">No.Kontak</label>
                                <input type="text" name="no_kontak_profile" id="no_kontak_profile"
                                    class="form-control col-md-10" placeholder="No.Kontak" readonly>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label">Alamat</label>
                                <div class="col-md-10">
                                    <textarea name="alamat_perusahaan_profile" id="alamat_perusahaan_profile" cols="3"
                                        rows="3" class="form-control" placeholder="Alamat Perusahaan"
                                        readonly></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label">Alamat Instalasi</label>
                                <div class="col-md-10">
                                    <textarea name="alamat_instalasi_profile" id="alamat_instalasi_profile" cols="3"
                                        rows="3" class="form-control" placeholder="Alamat Instalasi" readonly>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile-justify" role="tabpanel">
                            <!-- Row -->
                            <div class="row pt-2">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                            style="border-collapse: collapse; border-spacing: 0; width: 150%;">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th style="width: 3%;">#</th>
                                                    <th style="width: 10%;text-align: center;">NIK</th>
                                                    <th style="width: 10%;text-align: center;">Nama</th>
                                                    <th style="width: 10%;text-align: center;">No.Wa
                                                    </th>
                                                    <th style="width: 10%;text-align: center;">Email
                                                    </th>
                                                    <th style="width: 10%;text-align: center;">NPWP</th>
                                                    <th style="width: 15%;text-align: center;">FileName
                                                    </th>
                                                    <th style="width: 10%;text-align: center;">Posisi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody-struktural-profile">
                                                <tr ng-repeat="id in mitra_detail" class="text-center">
                                                    <td>{{$index + 1}}</td>
                                                    <td>{{id.nik}}</td>
                                                    <td>{{id.nama}}</td>
                                                    <td>{{id.no_wa}}</td>
                                                    <td>{{id.email}}</td>
                                                    <td>{{id.npwp}}</td>
                                                    <td>
                                                        <a
                                                            href="<?=base_url()?>upload/mitra/{{id.kode_mitra}}/{{id.filename}}">
                                                            {{id.filename}}
                                                        </a>
                                                    </td>
                                                    <td>{{id.posisi}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                        <div class="tab-pane" id="messages-justify" role="tabpanel">
                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label">Jenis Layanan</label>
                                <div class="col-md-10">
                                    <input type="text" name="jenis_layanan_priview" id="jenis_layanan_priview"
                                        ng-model="jenis_layanan_priview" class="form-control"
                                        placeholder="Jenis Layanan" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label">Kapasitas Layanan</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input type="text" name="kapasitas_layanan_priview"
                                            ng-model="kapasitas_layanan_priview" id="kapasitas_layanan_priview"
                                            class="form-control" placeholder="Kapasiatas Layanan" readonly>
                                        <select name="satuan_priview" id="satuan_priview" class="form-control">
                                            <option value="">Pilih:</option>
                                            <option value="Mbps">Mbps</option>
                                            <option value="Gbps">Gbps</option>
                                        </select>
                                        <!-- <input type="text" name="satuan_priview" id="satuan_priview"
                                            ng-model="satuan_priview" class="form-control" placeholder="Satuan Layanan"
                                            readonly> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label">Vendor / Media Hantar Jaringan</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input type="text" name="vendor_media_priview" id="vendor_media_priview"
                                            ng-model="vendor_media_priview" class="form-control"
                                            placeholder="Vendor / Media Hantar Jaringan" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label">Price / Rate</label>
                                <div class="col-md-10">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <label for="" class="text-white">Price Month Periode</label>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#homePriview"
                                                        role="tab">
                                                        <i class="dripicons-document-edit mr-1 align-middle"></i>
                                                        <span class="d-none d-md-inline-block">
                                                            Form
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#profilePriview"
                                                        role="tab">
                                                        <i class="dripicons-browser mr-1 align-middle"></i>
                                                        <span class="d-none d-md-inline-block">
                                                            Table Refrence Periode
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content p-3">
                                                <div class="tab-pane active" id="homePriview" role="tabpanel">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">
                                                                Deskripsi :
                                                            </label>
                                                            <input type="text" name="deskripsi_price_month_priview"
                                                                id="deskripsi_price_month_priview"
                                                                ng-model="deskripsi_price_month_priview"
                                                                class="form-control col-md-9" placeholder="Deskripsi"
                                                                readonly>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">
                                                                Harga Dasar :
                                                            </label>
                                                            <input type="text" name="harga_dasar_price_month_priview"
                                                                ng-model="harga_dasar_price_month_priview"
                                                                id="harga_dasar_price_month_priview"
                                                                class="form-control col-md-9" value="0" readonly>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">
                                                                Harga Jual :
                                                            </label>
                                                            <input type="text" id="harga_jual_price_month_priview"
                                                                ng-model="harga_jual_price_month_priview"
                                                                ng-change="CalculateHargaMonth()"
                                                                class="form-control col-md-9" value="0" readonly>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">
                                                                PPN (%) :
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="input-daterange input-group">
                                                                    <select id="combo_ppn_price_month_priview"
                                                                        ng-model="combo_ppn_price_month_priview"
                                                                        class="form-control">
                                                                        <option value="">Pilih :</option>
                                                                        <option value="10">10%</option>
                                                                        <option value="11">11%</option>
                                                                        <option value="12">12%</option>
                                                                    </select>
                                                                    <input type="text"
                                                                        name="nominal_ppn_price_month_priview"
                                                                        ng-model="nominal_ppn_price_month_priview"
                                                                        id="nominal_ppn_price_month_priview"
                                                                        class="form-control col-md-9" value="0"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">
                                                                Subtotal :
                                                            </label>
                                                            <input type="text" name="subtotal_price_month_priview"
                                                                id="subtotal_price_month_priview"
                                                                ng-model="subtotal_price_month_priview"
                                                                class="form-control col-md-9"
                                                                placeholder="Harga Jual Price Month" readonly>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">
                                                                Periode Kerja Sama :
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="input-group button-group">
                                                                    <input type="text"
                                                                        ng-model="start_date_price_month_priview"
                                                                        class="form-control" readonly>
                                                                    <input type="text"
                                                                        ng-model="end_date_price_month_priview"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">
                                                                Tanggal Pembayaran Paling Lama :
                                                            </label>
                                                            <input type="text"
                                                                name="pembayaran_paling_lama_month_priview"
                                                                id="pembayaran_paling_lama_month_priview"
                                                                class="form-control col-md-9" placeholder="Example : 10"
                                                                readonly>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="profilePriview" role="tabpanel">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                                style="border-collapse: collapse; border-spacing: 0; width: 120%;">
                                                                <thead class="bg-dark text-white">
                                                                    <tr>
                                                                        <th style="width: 12%;text-align: center;">
                                                                            Deskripsi
                                                                        </th>
                                                                        <th style="width: 10%;text-align: center;">
                                                                            Harga Dasar
                                                                        </th>
                                                                        <th style="width: 10%;text-align: center;">
                                                                            Harga Jual
                                                                        </th>
                                                                        <th style="width: 10%;text-align: center;">
                                                                            PPN(%)
                                                                        </th>
                                                                        <th style="width: 12%;text-align: center;">
                                                                            Subtotal
                                                                        </th>
                                                                        <th style="width: 10%;text-align: center;">
                                                                            Periode
                                                                        </th>
                                                                        <th style="width: 13%;text-align: center;">
                                                                            Payment Late Date
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody-RefrencePeriodePriview">
                                                                    <tr
                                                                        ng-repeat="dt in ListDataArrayRefrencePeriodePriview">
                                                                        <td>
                                                                            <label>{{ dt.deskripsi_price }}</label>
                                                                        </td>
                                                                        <td>
                                                                            {{formatNumber(dt.harga_dasar)}}
                                                                        </td>
                                                                        <td>
                                                                            {{formatNumber(dt.harga_jual)}}
                                                                        </td>
                                                                        <td>
                                                                            {{dt.ppn_text}} %
                                                                        </td>
                                                                        <td>
                                                                            {{formatNumber(dt.subtotal)}}
                                                                        </td>
                                                                        <td>
                                                                            {{dt.periode}}
                                                                        </td>
                                                                        <td>
                                                                            {{dt.last_pay_periode}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- OTC -->
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <h6 class="card-title text-white">OTC (On Time Charge)</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="table-responsive">
                                                    <table
                                                        class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                        <thead class="bg-dark text-white">
                                                            <tr>
                                                                <th style="width: 2%;text-align: center;">#</th>
                                                                <th style="width: 15%;text-align: center;">
                                                                    Deskripsi
                                                                </th>
                                                                <th style="width: 15%;text-align: center;">
                                                                    Harga Dasar
                                                                </th>
                                                                <th style="width: 15%;text-align: center;">
                                                                    Harga Jual
                                                                </th>
                                                                <th style="width: 15%;text-align: center;">
                                                                    PPN(%)
                                                                </th>
                                                                <th style="width: 15%;text-align: center;">
                                                                    Subtotal
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody-otc">
                                                            <tr ng-repeat="dt in listDataOtcPreview">
                                                                <td style="width: 2%; text-align: center;">
                                                                    {{$index + 1}}
                                                                </td>
                                                                <td><label>{{dt.deskripsi_price}}</label></td>
                                                                <td>
                                                                    {{formatNumber(dt.harga_dasar)}}
                                                                </td>
                                                                <td>
                                                                    {{formatNumber(dt.harga_jual)}}
                                                                </td>
                                                                <td>
                                                                    {{dt.ppn_text}} %
                                                                </td>
                                                                <td>
                                                                    {{formatNumber(dt.subtotal)}}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings-justify" role="tabpanel">
                            <!-- Detail Table Struktur -->
                            <div class="row pt-2">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th style="width: 2%;text-align: center;">#</th>
                                                    <th style="width: 5%;display: none;">ID</th>
                                                    <th style="width: 15%;text-align: center;">Nama
                                                        Dokumen</th>
                                                    <th style="width: 15%;text-align: center;">FileName
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody-tambahan">
                                                <tr ng-repeat="dt in mitra_detail_dokumen">
                                                    <td style="width: 2%;text-align: center;">
                                                        {{$index + 1}}
                                                    </td>
                                                    <td style="width: 2%;text-align: center; display: none;">
                                                        <input type="hidden" value="{{dt.id}}" class="form-control">
                                                    </td>
                                                    <td>
                                                        {{dt.type_name}}
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="<?=base_url()?>upload/mitra/{{dt.kode_mitra}}/{{dt.file_name}}">
                                                            {{dt.file_name}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- End Table Struktur -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- End Modal Show Profile -->


    <!-- End Modal Show -->
    <div id="My-Modal-Edit" class="modal fade modal-right" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title mt-0 text-white"> Edit Data Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#custom-home-edit" role="tab">
                                <i class="dripicons-user mr-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Data Pelanggan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#custom-profile-edit" role="tab">
                                <i class="dripicons-briefcase mr-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#custom-messages-edit" role="tab">
                                <i class="dripicons-wifi mr-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Data Layanan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#custom-settings-edit" role="tab">
                                <i class="dripicons-gear mr-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Document Support</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="custom-home-edit" role="tabpanel">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label">
                                    ID Mitra
                                </label>
                                <div class="col-md-10">
                                    <input type="text" ng-model="mitra_id_edit" name="mitra_id_edit" id="mitra_id_edit"
                                        class="form-control" placeholder="ID Mitra" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" for="example-text-input" class="col-md-2 col-form-label">
                                    Nama Perusahaan
                                </label>
                                <div class="col-md-10">
                                    <input type="text" name="nama_perusahaan_edit" id="nama_perusahaan_edit"
                                        class="form-control" placeholder="Nama Perusahaan"
                                        ng-model="nama_perusahaan_edit">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" for="example-text-input" class="col-md-2 col-form-label">
                                    E-mail
                                </label>
                                <div class="col-md-10">
                                    <input type="email" name="email_edit" id="email_edit" class="form-control"
                                        placeholder="E-mail" ng-model="email_edit">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" for="example-text-input" class="col-md-2 col-form-label">
                                    No.Kontak
                                </label>
                                <div class="col-md-10">
                                    <input type="text" name="no_kontak_edit" id="no_kontak_edit" class="form-control"
                                        placeholder="No.Kontak" ng-model="no_kontak_edit">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" for="example-text-input" class="col-md-2 col-form-label">
                                    Alamat
                                </label>
                                <div class="col-md-10">
                                    <textarea name="alamat_perusahaan_edit" id="alamat_perusahaan_edit" cols="3"
                                        rows="3" class="form-control" placeholder="Alamat Perusahaan"
                                        ng-model="alamat_perusahaan_edit">
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" for="example-text-input" class="col-md-2 col-form-label">
                                    NPWP
                                </label>
                                <div class="col-md-10">
                                    <textarea name="npwp_edit" id="npwp_edit" cols="3" rows="3" class="form-control"
                                        placeholder="Alamat Instalasi" ng-model="npwp_edit">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="custom-profile-edit" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 justify-content-end">
                                            <button class="btn btn-md btn-dark" ng-click="AddBarisEdit()">
                                                <i class="fa fa-plus"></i>
                                                Tambah
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                    style="border-collapse: collapse; border-spacing: 0; width: 150%;">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th style="width: 3%;">#</th>
                                                            <th style="width: 3%;text-align: center;">Act</th>
                                                            <th style="width: 10%;text-align: center;">NIK</th>
                                                            <th style="width: 10%;text-align: center;">Nama</th>
                                                            <th style="width: 10%;text-align: center;">No.Wa
                                                            </th>
                                                            <th style="width: 10%;text-align: center;">Email
                                                            </th>
                                                            <th style="width: 10%;text-align: center;">NPWP</th>
                                                            <th style="width: 15%;text-align: center;">FileName
                                                            </th>
                                                            <th style="width: 10%;text-align: center;">Posisi
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody-struktural-edit">
                                                        <tr ng-repeat="item in listDataEdit track by $index">
                                                            <td>{{$index + 1}}</td>
                                                            <td>
                                                                <button class="btn btn-sm btn-danger"
                                                                    ng-click="HapusBarisEdit($index)">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                            <td><input type="text" ng-model="item.nik"
                                                                    class="form-control" /></td>
                                                            <td><input type="text" ng-model="item.nama"
                                                                    class="form-control" /></td>
                                                            <td><input type="text" ng-model="item.no_wa"
                                                                    class="form-control" /></td>
                                                            <td><input type="email" ng-model="item.email"
                                                                    class="form-control" /></td>
                                                            <td><input type="text" ng-model="item.npwp"
                                                                    class="form-control" /></td>
                                                            <td>
                                                                <input type="file" ng-model="item.filename"
                                                                    class="form-control" />
                                                                <small>
                                                                    <a
                                                                        href="<?=base_url()?>upload/mitra/{{item.kode_mitra}}/{{item.filename}}">{{item.filename}}</a>
                                                                </small>
                                                            </td>
                                                            <td><input type="text" ng-model="item.posisi"
                                                                    class="form-control" /></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="custom-messages-edit" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-md btn-info" ng-click="AddLayananEdit()">
                                        <i class="fa fa-plus"></i>
                                        Tambah Layanan
                                    </button>
                                </div>
                            </div>

                            <div ng-repeat="layanan in listDataLayananArrayEdit track by $index">
                                <div class="row mb-1">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header bg-info d-flex justify-content-between">
                                                <label class="text-white">Transaction Layanan {{$index + 1}}</label>
                                                <button class="btn btn-sm btn-danger"
                                                    ng-click="DeleteLayananEdit($index)">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                            <div class="card-body bg-light">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-3 col-form-label">
                                                                Jenis Layanan
                                                            </label>
                                                            <div class="col-md-9">
                                                                <select ng-model="layanan.jenis_layanan_edit"
                                                                    class="form-control">
                                                                    <option value="">Pilih Jenis Layanan :</option>
                                                                    <option value="Layanan corporate">Layanan corporate
                                                                    </option>
                                                                    <option value="Layanan kemitraan">Layanan kemitraan
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-3 col-form-label">
                                                                Kapasitas Layanan
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        ng-model="layanan.kapasitas_layanan_edit"
                                                                        class="form-control" placeholder="sample : 100">
                                                                    <select ng-model="layanan.satuan_layanan_edit"
                                                                        class="form-control">
                                                                        <option value="">Pilih Satuan :</option>
                                                                        <option value="Mbps">Mbps</option>
                                                                        <option value="Gbps">Gbps</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-3 col-form-label">
                                                                Vendor / Media Hantar Jaringan
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    <select ng-model="layanan.vendor_media_edit"
                                                                        class="form-control">
                                                                        <option value="">Pilih :</option>
                                                                        <option
                                                                            value="PT Mega Akses Persada / Fiberstar">PT
                                                                            Mega Akses Persada / Fiberstar</option>
                                                                        <option value="PT Telkom Indonesia / Telkom">PT
                                                                            Telkom Indonesia / Telkom</option>
                                                                        <option value="Mandiri">Mandiri</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-3 col-form-label">
                                                                Alamat Instalasi
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    <textarea
                                                                        ng-model="layanan.alamat_instalasi_layanan_edit"
                                                                        class="form-control" cols="5"
                                                                        rows="5"></textarea>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-3 col-form-label">
                                                                Status Layanan
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    <select ng-model="layanan.status_layanan_edit"
                                                                        class="form-control">
                                                                        <option value="">Pilih :</option>
                                                                        <option value="Baru">Baru</option>
                                                                        <option value="Upgrade">Upgrade</option>
                                                                        <option value="Perpanjangan">Perpanjangan
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="" for="example-text-input"
                                                                class="col-md-12 col-form-label">
                                                                Price / Rate
                                                            </label>
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-header bg-dark">
                                                                        <label for="" class="text-white">Price Month
                                                                            Periode</label>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div
                                                                            class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                                            <div class="form-group row">
                                                                                <label for=""
                                                                                    class="col-md-3 col-form-label">
                                                                                    Deskripsi :
                                                                                </label>
                                                                                <input type="text"
                                                                                    ng-model="layanan.deskripsi_price_month_edit"
                                                                                    class="form-control col-md-9"
                                                                                    placeholder="Deskripsi">
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for=""
                                                                                    class="col-md-3 col-form-label">
                                                                                    Harga Dasar :
                                                                                </label>
                                                                                <input type="text"
                                                                                    ng-model="layanan.harga_dasar_price_month_edit"
                                                                                    ng-change="layanan.harga_dasar_price_month_edit = formatNumberAuto(layanan.harga_dasar_price_month_edit)"
                                                                                    class="form-control col-md-9">
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for=""
                                                                                    class="col-md-3 col-form-label">
                                                                                    Harga Jual :
                                                                                </label>
                                                                                <input type="text"
                                                                                    ng-model="layanan.harga_jual_price_month_edit"
                                                                                    ng-change="CalculateHargaMonthEdit(layanan)"
                                                                                    class="form-control col-md-9">
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for=""
                                                                                    class="col-md-3 col-form-label">
                                                                                    PPN (%) :
                                                                                </label>
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="input-daterange input-group">
                                                                                        <select
                                                                                            ng-model="layanan.combo_ppn_price_month_edit"
                                                                                            ng-change="CalculateHargaMonthEdit(layanan)"
                                                                                            class="form-control">
                                                                                            <option value="">Pilih :
                                                                                            </option>
                                                                                            <option value="10">10%
                                                                                            </option>
                                                                                            <option value="11">11%
                                                                                            </option>
                                                                                            <option value="12">12%
                                                                                            </option>
                                                                                        </select>
                                                                                        <input type="text"
                                                                                            ng-model="layanan.nominal_ppn_price_month_edit"
                                                                                            class="form-control col-md-9"
                                                                                            readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for=""
                                                                                    class="col-md-3 col-form-label">
                                                                                    Subtotal :
                                                                                </label>
                                                                                <input type="text"
                                                                                    ng-model="layanan.subtotal_price_month_edit"
                                                                                    class="form-control col-md-9"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- OTC -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <h6 class="card-title text-white">OTC (On Time
                                                Charge)</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-1">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <button class="btn btn-md btn-dark" ng-click="AddBarisOTCEdit()">
                                                        <i class="fa fa-plus"></i>
                                                        Tambah OTC
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead class="bg-dark text-white">
                                                                <tr>
                                                                    <th style="width: 2%;text-align: center;">
                                                                        #</th>
                                                                    <th style="width: 5%;">Act
                                                                    </th>
                                                                    <th style="width: 25%;text-align: center;">
                                                                        Deskripsi
                                                                    </th>
                                                                    <th style="width: 15%;text-align: center;">
                                                                        Harga Dasar
                                                                    </th>
                                                                    <th style="width: 15%;text-align: center;">
                                                                        Harga Jual
                                                                    </th>
                                                                    <th style="width: 8%;text-align: center;">
                                                                        PPN(%)
                                                                    </th>
                                                                    <th style="width: 15%;text-align: center;">
                                                                        Subtotal
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody-otc-edit">
                                                                <tr
                                                                    ng-repeat="dt in listDataOtcArrayEdit track by $index">
                                                                    <td>{{$index + 1}}</td>
                                                                    <td>
                                                                        <button class="btn btn-sm btn-danger"
                                                                            ng-click="DeleteOtcEdit($index)">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                    <td>
                                                                        <textarea ng-model="dt.deskripsi_otc_edit"
                                                                            name="deskripsi_otc_edit"
                                                                            id="deskripsi_otc_edit" cols="3" rows="3"
                                                                            class="form-control"></textarea>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            ng-model="dt.price_dasar_edit"
                                                                            class="form-control"
                                                                            ng-change="FormatFieldNumber(dt, 'price_dasar_edit')" />
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" ng-model="dt.price_jual_edit"
                                                                            class="form-control"
                                                                            ng-change="FormatFieldNumber(dt, 'price_jual_edit')"
                                                                            ng-change="UpdateSubtotalOtcEdit(dt)" />
                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control"
                                                                            ng-model="dt.combo_ppn_Edit"
                                                                            ng-change="UpdateSubtotalOtcEdit(dt)">
                                                                            <option value="">
                                                                                Pilih :</option>
                                                                            <option value="10">
                                                                                10%</option>
                                                                            <option value="11">
                                                                                11%</option>
                                                                            <option value="12">
                                                                                12%</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" ng-model="dt.subtotal_edit"
                                                                            class="form-control" readonly />
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="" class="col-md-3 col-form-label">
                                                    Periode Kerja Sama :
                                                </label>
                                                <div class="col-md-9">
                                                    <div class="input-group button-group">
                                                        <input type="date" name="start_date_price_month_edit"
                                                            id="start_date_price_month_edit"
                                                            ng-model="start_date_price_month_edit" class="form-control"
                                                            placeholder="Periode Start">
                                                        <input type="date" name="end_date_price_month_edit"
                                                            id="end_date_price_month_edit"
                                                            ng-model="end_date_price_month_edit" class="form-control"
                                                            placeholder="Periode Start">
                                                        <!-- <button class="btn btn-md btn-dark" type="button"
                                                            ng-click="SetTableRefrencePeriode()">
                                                            <i class="fa fa-table"></i>
                                                        </button> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-md-3 col-form-label">
                                                    Tanggal Pembayaran Paling
                                                    Lama :
                                                </label>
                                                <input type="text" name="pembayaran_paling_lama_month_edit"
                                                    id="pembayaran_paling_lama_month_edit" class="form-control col-md-9"
                                                    placeholder="Example : 10">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="custom-settings-edit" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row pt-2">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th style="width: 2%;text-align: center;">#</th>
                                                            <th style="width: 5%;display: none;">ID</th>
                                                            <th style="width: 15%;text-align: center;">Nama
                                                                Dokumen</th>
                                                            <th style="width: 15%;text-align: center;">FileName
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody-tambahan-edit">
                                                        <tr ng-repeat="dt in listDataDocTambahanEdit">
                                                            <td style="width: 2%;text-align: center;">
                                                                {{$index + 1}}
                                                            </td>
                                                            <td style="width: 2%;text-align: center; display: none;">
                                                                <input type="hidden" value="{{dt.id}}"
                                                                    class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" ng-model="dt.type_name"
                                                                    value="{{dt.type_name}}" class="form-control"
                                                                    readonly />
                                                            </td>
                                                            <td>
                                                                <input type="file" ng-model="dt.filename"
                                                                    class="form-control" />
                                                                <small>
                                                                    <a
                                                                        href="<?=base_url()?>upload/mitra/{{dt.kode_mitra}}/{{dt.file_name}}">{{dt.file_name}}</a>
                                                                </small>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="button" class="btn btn-md btn-warning" ng-click="Update()">
                        <i class="fa fa-paper-plane"></i>
                        Update
                    </button>
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                        close
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Edit Modal Show -->
</div>


<style>
.modal.modal-right .modal-dialog {
    position: fixed;
    margin: 0;
    /* <-- buang margin biar full */
    width: 85%;
    /* <-- biar bener-bener full */
    height: 100%;
    /* <-- tinggi full 100% viewport */
    right: 0;
    top: 0;
    bottom: 0;
    transform: translateX(100%);
    transition: transform 0.3s ease-in-out;
    max-width: 100%;
    /* <-- fix juga untuk mobile */
}

.modal.modal-right.show .modal-dialog {
    transform: translateX(0);
}

.modal.modal-right .modal-content {
    height: 100%;
    /* <-- isi modal full 100% */
    border-radius: 0;
    /* <-- hilangkan radius */
    border: none;
    /* <-- opsional: buang border */
    display: flex;
    flex-direction: column;
    /* <-- biar header-body-footer tersusun vertikal */
}

.modal.modal-right .modal-body {
    flex: 1 1 auto;
    overflow-y: auto;
    /* <-- scroll isi modal kalau konten panjang */
}
</style>

<style>
.selected-row {
    background-color: #adb5bd !important;
    /* abu-abu gelap */
    color: #fff;
}
</style>

<style>
.profile-info div {
    font-size: 13px;
    margin-bottom: 2px;
    line-height: 1.2;
}

.table td,
.table th {
    padding: 6px 10px !important;
    vertical-align: middle;
}

.btn-sm {
    padding: 4px 8px;
    font-size: 12px;
}

.input-group {
    gap: 6px;
    display: flex;
    justify-content: center;
}
</style>

<?=$this->endSection();?>
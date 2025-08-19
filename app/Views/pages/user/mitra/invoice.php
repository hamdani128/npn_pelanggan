<?=$this->Extend('layout/index')?>
<?=$this->section('content')?>
<div class="container-fluid" ng-app="InvoiceApp" ng-controller="InvoiceAppController">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Invoice</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Modul Kemitraan</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoice</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Card -->
    <div class="row">
        <div class="col-xl-6 col-md-6">
            <a href="#" class="text-decoration-none">
                <div class="card bg-dark mini-stat position-relative hover-card" onclick="show_otc()">
                    <div class="card-body">
                        <div class="mini-stat-desc">
                            <div class="text-white">
                                <h5 class="text-uppercase font-size-16 text-white-50">
                                    Transaction OTC
                                </h5>
                                <i class="fa fa-database text-white-50" style="font-size: 25pt;padding-top: 15px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-6 col-md-6">
            <a href="#" class="text-decoration-none">
                <div class="card bg-success mini-stat position-relative hover-card" onclick="show_invoice_layanan()">
                    <div class="card-body">
                        <div class="mini-stat-desc">
                            <div class="text-white">
                                <h5 class="text-uppercase font-size-16 text-white-50">
                                    Invoice Layanan
                                </h5>
                                <i class="fa fa-database text-white-50" style="font-size: 25pt;padding-top: 15px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- End card -->

    <!-- row -->
    <div id="otc_invoice" style="display: none;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0 text-light"> OTC List Invoice</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row text-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <button class="btn btn-md btn-dark mb-3" ng-click="AddOtcInvoice()">
                                    <i class="fa fa-plus"></i>
                                    Add New OTC Invoice
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered dt-responsive nowrap" datatable="ng"
                                        dt-options="vm.dtOptions"
                                        style="border-collapse: collapse; border-spacing: 0; width: 120%;">
                                        <thead class="bg-dark text-white text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Act</th>
                                                <th>Invoice</th>
                                                <th>Date Invoice</th>
                                                <th>Date Tempo</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody style="border: 1px solid #ddd;">
                                            <tr ng-repeat="dt in TransactionOTC" ng-if="TransactionOTC.length > 0">
                                                <td>{{$index + 1}}</td>
                                                <td>
                                                    <div class="button-group">
                                                        <button class="btn btn-sm btn-dark"
                                                            ng-click="PrintOutInvoiceOTC(dt)">
                                                            <i class="fa fa-print"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-warning"
                                                            ng-click="ShowEditOTC(dt)">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5>{{dt.invoice}}</h5>
                                                    <table style="width: 100%; height: 50%;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 30%; font-weight: bold;">Kode Mitra
                                                                </td>
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
                                                    {{dt.inv_date}}
                                                </td>
                                                <td>
                                                    {{dt.inv_date_tempo}}
                                                </td>
                                                <td>
                                                    <span class="badge badge-pill badge-success"
                                                        ng-if="dt.status != '' && dt.status != null">
                                                        Paid
                                                    </span>
                                                    <span class="badge badge-pill badge-danger"
                                                        ng-if="dt.status == '' || dt.status == null">
                                                        Unpaid
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ dt.amount_total | number }}
                                                </td>

                                            </tr>
                                            <tr ng-if="TransactionOTC.length === 0">
                                                <td colspan="6" class="text-center">No data
                                                    available</td>
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
    <!-- end page-content-wrapper-->

    <!-- row -->
    <div id="layanan_invoice" style="display: none;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0 text-light">List Invoice Layanan</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Filter Perusahaan :</label>
                                    <div class="input-group">
                                        <select name="" id="" class="form-control"></select>
                                        <button class="btn btn-md btn-success">
                                            <i class="fa fa-filter"></i>
                                            Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-md btn-success mb-3" ng-click="AddLayananInvoice()">
                                    <i class="fa fa-plus"></i>
                                    Add Invoice
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered dt-responsive nowrap" datatable="ng"
                                        dt-options="vm.dtOptions"
                                        style="border-collapse: collapse; border-spacing: 0; width: 120%;">
                                        <thead class="bg-success text-white text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Act</th>
                                                <th>Invoice</th>
                                                <th>Date Invoice</th>
                                                <th>Date Tempo</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th>Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody style="border: 1px solid #ddd;">
                                            <tr ng-repeat="dt in TransactionLayanan"
                                                ng-if="TransactionLayanan.length > 0">
                                                <td>{{$index + 1}}</td>
                                                <td>
                                                    <div class="button-group">
                                                        <button class="btn btn-sm btn-dark"
                                                            ng-click="PrintOutInvoiceOTC(dt)">
                                                            <i class="fa fa-print"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5>{{dt.invoice}}</h5>
                                                    <table style="width: 100%; height: 50%;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 30%; font-weight: bold;">Kode Mitra
                                                                </td>
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
                                                    {{dt.inv_date}}
                                                </td>
                                                <td>
                                                    {{dt.inv_date_tempo}}
                                                </td>
                                                <td>
                                                    <span class="badge badge-pill badge-success"
                                                        ng-if="dt.status != '' && dt.status != null">
                                                        Paid
                                                    </span>
                                                    <span class="badge badge-pill badge-danger"
                                                        ng-if="dt.status == '' || dt.status == null">
                                                        Unpaid
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ dt.amount_total | number }}
                                                </td>

                                            </tr>
                                            <tr ng-if="TransactionOTC.length === 0">
                                                <td colspan="6" class="text-center">No data
                                                    available</td>
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
    <!-- end row -->




    <!-- Modal -->
    <div id="my-modal-add-otc" class="modal fade modal-right" tabindex="-1" role="dialog"
        aria-labelledby="sideModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-full modal-dialog-scrollable">
            <div class=" modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="sideModalLabel">Add Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card shadow-sm border-dark">
                                <div class="card-header bg-dark">
                                    <h6 class="card-title text-white">Company Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-1">
                                        <small class="text-muted">Company :</small><br>
                                        <strong id="company_otc" class="h6 m-0">PT. NETINDO PERSADA NUSANTARA</strong>
                                    </div>
                                    <div class="mb-1">
                                        <small class="text-muted">Alamat :</small><br>
                                        <span id="alamat_otc" class="h6 m-0">
                                            Jl. Cucakrawa I No. 81, Kenangan Baru, Percut Sei Tuan, Deli Serdang, 20371
                                        </span>
                                    </div>
                                    <div>
                                        <small class="text-muted">NPWP :</small><br>
                                        <span id="npwp_otc" class="h6 m-0">21.419.620.6-125.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <!--  -->
                            <div class="card shadow-sm border-dark">
                                <div class="card-header bg-dark">
                                    <h6 class="card-title text-white">Invoice Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <small class="text-muted">No.Faktur :</small><br>
                                                <strong id="no_invoice_otc" class="h6 m-0">-</strong>
                                            </div>
                                            <div class="mb-1">
                                                <small class="text-muted">Tanggal Faktur :</small>
                                                <input type="date" name="tgl_invoice_otc" id="tgl_invoice_otc"
                                                    class="form-control" placeholder="Tanggal Faktur">
                                            </div>
                                            <div class="mb-0">
                                                <small class="text-muted">Tanggal Jatuh Tempo :</small>
                                                <input type="date" name="tgl_tempo_otc" id="tgl_tempo_otc"
                                                    class="form-control" placeholder="Jatuh Tempo">
                                            </div>
                                        </div>

                                        <!-- Col-6 -->
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <small class="text-muted">Kode Mitra :</small><br>
                                                <select class="form-control" ng-model="selectedKodeMitra"
                                                    ng-change="getProfileMitra()">
                                                    <option value="">Pilih</option>
                                                    <option ng-repeat="item in listKodeMitra"
                                                        value="{{item.kode_mitra}}">
                                                        {{item.kode_mitra}}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-1">
                                                <small class="text-muted">Company :</small>
                                                <input type="text" ng-model="company_otc" class="form-control"
                                                    placeholder="Company" readonly>
                                            </div>
                                            <div class="mb-1">
                                                <small class="text-muted">Alamat :</small>
                                                <textarea ng-model="alamat_otc" cols="5" rows="5" class="form-control"
                                                    placeholder="Alamat" readonly></textarea>
                                            </div>
                                            <div class="mb-1">
                                                <small class="text-muted">NPWP :</small>
                                                <input type="text" ng-model="npwp_otc" class="form-control"
                                                    placeholder="NPWP" readonly>
                                            </div>
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                </div>
                            </div>
                            <!-- end Cell -->
                        </div>

                    </div>
                    <!-- End Row -->


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-sm border-dark">
                                <div class="card-header bg-dark">
                                    <h6 class="card-title text-white">Item List</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <button type="button" class="btn btn-sm btn-dark waves-effect waves-light"
                                                ng-click="AddBarisOTC()">
                                                <i class="fa fa-plus"></i>
                                                Add Item
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
                                                                #
                                                            </th>
                                                            <th style="width: 5%;">
                                                                Act
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
                                                                    name="deskripsi_otc_add" id="deskripsi_otc_add"
                                                                    cols="3" rows="3" class="form-control"></textarea>
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
                                                                <select class="form-control" ng-model="dt.combo_ppn"
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
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="5"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="">Subtotal</label>
                                                            </td>
                                                            <td colspan="2"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="" id="subtotal-value">Rp.0</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="">PPN</label>
                                                            </td>
                                                            <td colspan="2"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="" id="ppn-value">Rp.0</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="">Grand Total</label>
                                                            </td>
                                                            <td colspan="2"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="" id="grandtotal-value">Rp.0</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="7"
                                                                style="text-align: center;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label id="lb_terbilang"></label>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer justify-content-start">
                        <button type="button" class="btn btn-dark waves-effect waves-light" ng-click="insert_otc()">
                            <i class="fa fa-paper-plane"></i> Submit
                        </button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">
                            <i class="fa fa-ban"></i>
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->




    </div>
    <!-- End Modal -->


    <!-- Modal -->
    <div id="my-modal-edit-otc" class="modal fade modal-right" tabindex="-1" role="dialog"
        aria-labelledby="sideModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-full modal-dialog-scrollable">
            <div class=" modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="sideModalLabel">Edit Invoice - <span
                            id="no_invoice_otc_edit"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card shadow-sm border-warning">
                                <div class="card-header bg-warning">
                                    <h6 class="card-title text-white">Company Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-1">
                                        <small class="text-muted">Company :</small><br>
                                        <strong id="company_otc_edit" class="h6 m-0">PT. NETINDO PERSADA
                                            NUSANTARA</strong>
                                    </div>
                                    <div class="mb-1">
                                        <small class="text-muted">Alamat :</small><br>
                                        <span id="alamat_otc_edit" class="h6 m-0">
                                            Jl. Cucakrawa I No. 81, Kenangan Baru, Percut Sei Tuan, Deli Serdang, 20371
                                        </span>
                                    </div>
                                    <div>
                                        <small class="text-muted">NPWP :</small><br>
                                        <span id="npwp_otc_edit" class="h6 m-0">21.419.620.6-125.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <!--  -->
                            <div class="card shadow-sm border-warning">
                                <div class="card-header bg-warning">
                                    <h6 class="card-title text-white">Invoice Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <small class="text-muted">No.Faktur :</small><br>
                                                <strong id="no_invoice_otc_edit_label" class="h6 m-0">-</strong>
                                            </div>
                                            <div class="mb-1">
                                                <small class="text-muted">Tanggal Faktur :</small>
                                                <input type="date" name="tgl_invoice_otc_edit" id="tgl_invoice_otc_edit"
                                                    class="form-control" placeholder="Tanggal Faktur">
                                            </div>
                                            <div class="mb-0">
                                                <small class="text-muted">Tanggal Jatuh Tempo :</small>
                                                <input type="date" name="tgl_tempo_otc_edit" id="tgl_tempo_otc_edit"
                                                    class="form-control" placeholder="Jatuh Tempo">
                                            </div>
                                        </div>

                                        <!-- Col-6 -->
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <small class="text-muted">Kode Mitra :</small><br>
                                                <input type="kode_mitra_edit" name="kode_mitra_edit"
                                                    id="kode_mitra_edit" class="form-control" placeholder="Kode Mitra"
                                                    readonly>
                                            </div>
                                            <div class="mb-1">
                                                <small class="text-muted">Company :</small>
                                                <input type="text" id="company_otc_edit_label"
                                                    name="company_otc_edit_label" ng-model="company_otc_edit_label"
                                                    class="form-control" placeholder="Company" readonly>
                                            </div>
                                            <div class="mb-1">
                                                <small class="text-muted">Alamat :</small>
                                                <textarea name="alamat_otc_edit_label" id="alamat_otc_edit_label"
                                                    ng-model="alamat_otc_edit_label" cols="5" rows="5"
                                                    class="form-control" placeholder="Alamat" readonly></textarea>
                                            </div>
                                            <div class="mb-1">
                                                <small class="text-muted">NPWP :</small>
                                                <input type="text" ng-model="npwp_otc_edit_label"
                                                    name="npwp_otc_edit_label" id="npwp_otc_edit_label"
                                                    class="form-control" placeholder="NPWP" readonly>
                                            </div>
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                </div>
                            </div>
                            <!-- end Cell -->
                        </div>

                    </div>
                    <!-- End Row -->


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-sm border-warning">
                                <div class="card-header bg-warning">
                                    <h6 class="card-title text-white">Item List</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <button type="button"
                                                class="btn btn-sm btn-warning waves-effect waves-light"
                                                ng-click="AddBarisOTCEdit()">
                                                <i class="fa fa-plus"></i>
                                                Add Item
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead class="bg-warning text-white">
                                                        <tr>
                                                            <th style="width: 2%;text-align: center;">
                                                                #
                                                            </th>
                                                            <th style="width: 5%;">
                                                                Act
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
                                                        <tr ng-repeat="dt in listDataOtcArrayEdit track by $index">
                                                            <td>{{$index + 1}}</td>
                                                            <td>
                                                                <button class="btn btn-sm btn-danger"
                                                                    ng-click="DeleteOtcEdit($index)">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                            <td>
                                                                <textarea ng-model="dt.deskripsi_otc_edit"
                                                                    name="deskripsi_otc_edit" id="deskripsi_otc_edit"
                                                                    cols="3" rows="3" class="form-control"></textarea>
                                                            </td>
                                                            <td>
                                                                <input type="text" ng-model="dt.price_dasar_edit"
                                                                    class="form-control"
                                                                    ng-change="FormatFieldNumber(dt, 'price_dasar_edit')" />
                                                            </td>
                                                            <td>
                                                                <input type="text" ng-model="dt.price_jual_edit"
                                                                    class="form-control"
                                                                    ng-change="UpdateSubtotalOtcEdit(dt)" />
                                                            </td>
                                                            <td>
                                                                <select class="form-control"
                                                                    ng-model="dt.combo_ppn_edit"
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
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="5"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="">Subtotal</label>
                                                            </td>
                                                            <td colspan="2"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="" id="subtotal-value-edit">Rp.0</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="">PPN</label>
                                                            </td>
                                                            <td colspan="2"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="" id="ppn-value-edit">Rp.0</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="">Grand Total</label>
                                                            </td>
                                                            <td colspan="2"
                                                                style="text-align: right;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label for="" id="grandtotal-value-edit">Rp.0</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="7"
                                                                style="text-align: center;font-size: 16px;font-weight: bold;
                                                            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                                                <label id="lb_terbilang-edit"></label>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer justify-content-start">
                        <button type="button" class="btn btn-warning waves-effect waves-light" ng-click="update_otc()">
                            <i class="fa fa-paper-plane"></i>
                            Update
                        </button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">
                            <i class="fa fa-ban"></i>
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->




    </div>
    <!-- End Modal -->




    <style>
    .hover-card {
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
    }

    .bg-dark.hover-card:hover {
        background-color: #333 !important;
        /* Warna saat hover untuk kartu dengan background gelap */
    }

    .bg-success.hover-card:hover {
        background-color: #218838 !important;
        /* Warna saat hover untuk kartu dengan background hijau */
    }

    .autocomplete-container {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 1000;
        background-color: white;
        border: 1px solid #ccc;
        max-height: 200px;
        overflow-y: auto;
    }

    .autocomplete-suggestions {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .autocomplete-suggestions li {
        padding: 5px 10px;
        cursor: pointer;
    }

    .autocomplete-suggestions li:hover {
        background-color: #f0f0f0;
    }



    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            display: block;
            width: 100%;
            white-space: nowrap;
        }
    }


    .modal.modal-right .modal-dialog {
        position: fixed;
        margin: 0;
        right: 0;
        top: 0;
        height: 100%;
        transform: translateX(100%);
        transition: transform 0.3s ease-out;
        width: 100%;
        /* Full width */
    }

    .modal.show .modal-dialog {
        transform: translateX(0);
    }

    .modal-full {
        width: 100vw;
        /* full lebar layar */
        max-width: 100vw;
        height: 100vh;
        /* full tinggi layar */
        margin: 0;
    }

    .modal-full .modal-content {
        height: 100vh;
        /* ikut full tinggi */
        border-radius: 0;
        border: none;
        /* biar rata */
    }

    .modal-full .modal-body {
        overflow-y: auto;
        /* biar isi bisa scroll */
        height: calc(100vh - 120px);
        /* sisain space untuk header+footer modal */
    }
    </style>


    <script>
    function show_otc() {
        var display1 = document.getElementById("otc_invoice");
        var display2 = document.getElementById("layanan_invoice");
        if (display1.style.display === "none") {
            display1.style.display = "block";
            display2.style.display = "none";
        } else {
            display1.style.display = "none";
        }
    }

    function show_invoice_layanan() {
        var display1 = document.getElementById("otc_invoice");
        var display2 = document.getElementById("layanan_invoice");
        if (display2.style.display === "none") {
            display2.style.display = "block";
            display1.style.display = "none";
        } else {
            display2.style.display = "none";
        }
    }
    </script>

    <?=$this->endSection();?>
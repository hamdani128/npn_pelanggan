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
                                                <th>Invoice</th>
                                                <th>Kode Mitra</th>
                                                <th>Date Invoice</th>
                                                <th>Date Tempo</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody style="border: 1px solid #ddd;">
                                            <tr ng-repeat="dt in otc_invoice" ng-if="otc_invoice.length > 0">
                                                <td>{{$index + 1}}</td>
                                                <td>
                                                    <h5>{{dt.code}}</h5>
                                                </td>
                                                <td>
                                                    <a href="#">{{dt.email}}</a>
                                                    <p style="font-size: 12pt;font-weight: bold;">
                                                        CC To : {{dt.email_cc}}
                                                    </p>
                                                    <p style="font-size: 12pt;font-weight: bold;">
                                                        {{dt.fullname}} - [{{dt.department}}]</p>
                                                </td>
                                                <td>
                                                    <p>{{dt.room}}</p>
                                                </td>
                                                <td>
                                                    <span>Date : {{dt.date_request}}</span>
                                                    <span>Start : {{dt.time_start}}</span>
                                                    <span>End : {{dt.time_end}}</span>
                                                    <span>Topic : <span
                                                            style="font-weight: bold;">{{dt.topic}}</span></span>
                                                </td>
                                                <td>
                                                    -
                                                </td>
                                                <td>
                                                    {{dt.created_at}}
                                                </td>
                                            </tr>
                                            <tr ng-if="otc_invoice.length === 0">
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
                            <h5 class="mb-0 text-light">List Invoice Layanan</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Konten kartu -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->




    <!-- Modal -->
    <div id="my-modal-add" class="modal fade modal-right" tabindex="-1" role="dialog" aria-labelledby="sideModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                                                <input type="text" name="company_otc" id="company_otc"
                                                    class="form-control" placeholder="Company">
                                            </div>
                                            <div class="mb-1">
                                                <small class="text-muted">Alamat :</small>
                                                <textarea name="alamat_otc" id="alamat_otc" cols="2" rows="2"
                                                    class="form-control" placeholder="Alamat"></textarea>
                                            </div>
                                            <div class="mb-1">
                                                <small class="text-muted">NPWP :</small>
                                                <input type="text" name="npwp_otc" id="npwp_otc" class="form-control"
                                                    placeholder="NPWP">
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
                                                ng-click="addItem()">
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
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-start">
                        <button type="button" class="btn btn-dark waves-effect waves-light" ng-click="insert()">
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
        max-width: 100vw;
        height: 120vh;
        margin: 0;
    }

    .modal-full .modal-content {
        height: 120vh;
        border-radius: 0;
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
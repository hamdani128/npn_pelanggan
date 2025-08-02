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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">History Deleted</a></li>
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
                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable" datatable="ng" dt-options="vm.dtOptions"
                                class="table table-bordered dt-responsive nowrap table-hover table-striped"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 30%;text-align: center;">Profile Mitra</th>
                                        <th style="width: 15%;text-align: center;">Status</th>
                                        <th style="width: 15%;text-align: center;">Deleted at</th>
                                        <th style="width: 13%;text-align: center;">Act</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    <tr ng-repeat="dt in RowLegalitasDeleted" ng-if="RowLegalitasDeleted.length > 0"
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
                                                        <td style="font-weight: bold;">Instalasi</td>
                                                        <td style="text-align: right;">:</td>
                                                        <td>{{dt.alamat_instalasi || '-'}}</td>
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
                                        <td style="text-align: center;">
                                            <div class="input-group">
                                                <button class="btn btn-sm btn-dark"
                                                    ng-click="RollBack(dt); $event.stopPropagation()">
                                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr ng-if="RowLegalitasDeleted.length === 0">
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
</div>

<?=$this->endSection()?>
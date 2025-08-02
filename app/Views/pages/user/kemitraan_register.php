<?=$this->Extend('layout/index')?>
<?=$this->section('content')?>
<div class="container-fluid" ng-app="RegisterKemitraanApp" ng-controller="RegisterKemitraanAppController">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Registrasi Kemitraan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Modul Pelanggan</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Register Kemitraan</a></li>
                        <li class="breadcrumb-item active">Register Kemitraan</li>
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
                                        <th style="width: 35%; text-align: left;">Profile Perusahaan</th>
                                        <th style="width: 15%; text-align: center;">Act</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    <tr ng-repeat="dt in LoadData" ng-if="LoadData.length > 0">
                                        <td>{{$index + 1}}</td>
                                        <td style="text-align: left;">
                                            <table style="width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 30%; font-weight: bold;">No. Register</td>
                                                        <td style="width: 5%; text-align: right;">:</td>
                                                        <td>{{dt.kode_register}}</td>
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
                                            <div class="input-group justify-content-center">
                                                <button class="btn btn-sm btn-success" ng-click="Approval(dt)">
                                                    <i class="fa fa-check"></i>
                                                    Approval
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr ng-if="LoadData.length === 0">
                                        <td colspan="7">No data available</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- End Row -->
</div>

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
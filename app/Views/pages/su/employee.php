<?=$this->Extend('layout/index')?>
<?=$this->section('content')?>
<div class="container-fluid" ng-app="EmployeeApp" ng-controller="EmployeeController">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Employee Management</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Master Modul</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Employee Management</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Employee List-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row pb-5">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-md btn-primary" ng-click="Add()">
                                <i class="fa fa-plus"></i>
                                Tambah Employee
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
                                        <th style="width: 25%;text-align: left;">Nama Lengkap</th>
                                        <th style="width: 15%;text-align: left;">Email</th>
                                        <th style="width: 10%;text-align: left;">Jabatan</th>
                                        <th style="width: 10%;text-align: left;">No.Kontak</th>
                                        <th style="width: 15%;text-align: center;">Act</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    <tr ng-repeat="dt in LoadData" ng-if="LoadData.length > 0">
                                        <td>{{$index + 1}}</td>
                                        <td style="text-align: left;">{{dt.fullname}}</td>
                                        <td style="text-align: center;">{{dt.email}}</td>
                                        <td style="text-align: center;">{{dt.jabatan}}</td>
                                        <td style="text-align: center;">{{dt.no_kontak}}</td>
                                        <td style="text-align: center;">
                                            <div class="input-group">
                                                <button class="btn btn-md btn-danger" ng-click="Delete(dt)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-md btn-warning" ng-click="EditShow(dt)">
                                                    <i class="fa fa-edit"></i>
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
    <!-- End Employee List-->


    <!-- Modal Add -->
    <div id="My-Modal-Add" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title mt-0 text-white">Tambah Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control">
                                    <option value="">Pilih :</option>
                                    <option value="Komisaris">Komisaris</option>
                                    <option value="Direktur">Direktur</option>
                                    <option value="Manajer">Manajer</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Karyawan">Karyawan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">No.Kontak (WA)</label>
                                <input type="text" name="no_kontak" id="no_kontak" class="form-control"
                                    placeholder="No.Kontak (WA)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
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
    <!-- End Modal Add -->


</div>
<?=$this->endSection()?>
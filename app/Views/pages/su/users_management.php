<?=$this->Extend('layout/index')?>
<?=$this->section('content')?>
<div class="container-fluid" ng-app="UserAccountApp" ng-controller="UserAccountController">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">User Management</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users Data</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users Modul</a></li>
                        <li class="breadcrumb-item active">Users Management</li>
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
                                Add
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
                                        <th style="width: 17%;text-align: center;">Name</th>
                                        <th style="width: 17%;text-align: center;">E-mail</th>
                                        <th style="width: 10%;text-align: center;">Level</th>
                                        <th style="width: 15%;text-align: center;">Username</th>
                                        <th style="width: 10%;text-align: center;">Status Account</th>
                                        <th style="width: 15%;text-align: center;">Act</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    <tr ng-repeat="dt in LoadData" ng-if="LoadData.length > 0">
                                        <td>{{$index + 1}}</td>
                                        <td>{{dt.name}}</td>
                                        <td>{{dt.email}}</td>
                                        <td>{{dt.level}}</td>
                                        <td>{{dt.username}}</td>
                                        <td>
                                            <div ng-if="dt.status_account == '1'">
                                                <span class="badge bg-success">
                                                    Active
                                                </span>
                                            </div>
                                            <div ng-if="dt.status_account == '0'">
                                                <span class="badge bg-danger text-white">
                                                    Non Active
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <button class="btn btn-md btn-danger" ng-click="Delete(dt)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-md btn-warning" ng-click="EditShow(dt)">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-md btn-dark" ng-click="ActivateAccount(dt)">
                                                    <i class="fa fa-users"></i>
                                                </button>
                                                <button class="btn btn-md btn-info" ng-click="RoleModule(dt)">
                                                    <i class="fa fa-cog" aria-hidden="true"></i>
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
    <!-- end row -->

    <!-- Modal Add -->
    <div id="My-Modal-Add" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title mt-0 text-white">Add Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Fullname</label>
                                <input type="text" name="fullname" id="fullname" class="form-control"
                                    placeholder="Fullname">
                            </div>
                            <div class="form-group">
                                <label for="">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Fulname">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="">Level users</label>
                                <select name="combo_users" id="combo_users" class="form-control">
                                    <option value="">Pilih :</option>
                                    <option value="Admin">Admin</option>
                                </select>
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
    <!-- /.modal -->
</div>
<!-- container-fluid -->
<?=$this->endSection();?>
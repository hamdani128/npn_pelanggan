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
                                        <th style="width: 30%;text-align: center;">Profile Mitra</th>
                                        <th style="width: 8%;text-align: center;">E-mail</th>
                                        <th style="width: 15%;text-align: center;">Alamat</th>
                                        <th style="width: 15%;text-align: center;">Alamat Instalasi</th>
                                        <th style="width: 13%;text-align: center;">Created at</th>
                                        <th style="width: 13%;text-align: center;">Act</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    <tr ng-repeat="dt in RowLegalitas" ng-if="RowLegalitas.length > 0">
                                        <td>{{$index + 1}}</td>
                                        <td style="text-align: left;">
                                            <span>Kode Mitra : <strong>{{dt.kode_mitra}}</strong></span><br>
                                            <span>Nama Perusahaan : <strong>{{dt.nama_perusahaan}}</strong></span><br>
                                            <span>No.Kontak : <strong>{{dt.no_hp}}</strong></span><br>
                                        </td>
                                        <td>{{dt.email}}</td>
                                        <td>{{dt.alamat}}</td>
                                        <td>{{dt.alamat_instalasi}}</td>
                                        <td>{{dt.created_at}}</td>
                                        <td>
                                            <div class="input-group">
                                                <button class="btn btn-sm btn-danger" ng-click="Delete(dt)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning" ng-click="EditShow(dt)">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-dark" ng-click="showProfile(dt)">
                                                    <i class="fa fa-eye"></i>
                                                </button>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">ID Mitra</label>
                                <input type="text" name="mitra_id" id="mitra_id" class="form-control"
                                    placeholder="ID Mitra" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Perusahaan</label>
                                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control"
                                    placeholder="Nama Perusahaan">
                            </div>
                            <div class="form-group">
                                <label for="">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="E-mail">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No.Kontak</label>
                                <input type="text" name="no_kontak" id="no_kontak" class="form-control"
                                    placeholder="No.Kontak">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat_perusahaan" id="alamat_perusahaan" cols="3" rows="3"
                                    class="form-control" placeholder="Alamat Perusahaan"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Instalasi</label>
                                <textarea name="alamat_instalasi" id="alamat_instalasi" cols="3" rows="3"
                                    class="form-control" placeholder="Alamat Instalasi"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- row Struktural -->

                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h6 class="card-title text-white">Struktural Mitra</h6>
                                </div>
                                <div class="card-body">
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
                                                            <th style="width: 10%;text-align: center;">No.Wa</th>
                                                            <th style="width: 10%;text-align: center;">Email</th>
                                                            <th style="width: 10%;text-align: center;">NPWP</th>
                                                            <th style="width: 15%;text-align: center;">FileName</th>
                                                            <th style="width: 10%;text-align: center;">Posisi</th>
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
                    </div>
                    <!-- End Row -->



                    <!-- Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h6 class="card-title text-white">Dokumen Tambahan</h6>
                                </div>
                                <div class="card-body">
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
                                                            <th style="width: 15%;text-align: center;">Nama Dokumen</th>
                                                            <th style="width: 15%;text-align: center;">FileName</th>
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
                    <!-- End Row -->
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
                    `
                </div>
                <div class="modal-footer justify-content-start">
                    <!-- <button type="button" class="btn btn-md btn-primary" ng-click="Insert()">
                        <i class="fa fa-paper-plane"></i>
                        submit
                    </button>
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                        close
                    </button> -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- End Modal Show -->
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


<?=$this->endSection();?>
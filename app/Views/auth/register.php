<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?=base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?=base_url()?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-dark bg-pattern" ng-app="RegisterApp" ng-controller="RegisterControllerApp">

    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <a href="#" class="logo"><img src="<?=base_url()?>assets/images/logo-npn.png" height="80"
                                alt="logo">
                        </a>
                        <h5 class="font-size-16 text-white-50 mb-0 mt-4">PT.NETINDO PERSADA NUSANTARA</h5>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body p-8">
                            <div class="p-2">
                                <h5 class="mb-5 text-center">Registrasi Mitra Bisnis NPN.</h5>
                                <form class="form-horizontal">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="username">Nama Perusahaan</label>
                                                <input type="text" class="form-control" id="nama_perusahaan"
                                                    name="nama_perusahaan" placeholder="Enter Nama Perusahaan">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="username">E-Mail</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter E-Mail">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="">No.Kontak</label>
                                                <input type="text" class="form-control" id="no_kontak" name="no_kontak"
                                                    placeholder="Enter No.Kontak">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="userpassword">Alamat Perusahaan</label>
                                                <textarea name="alamat_perusahaan" id="alamat_perusahaan" cols="3"
                                                    rows="3" class="form-control"
                                                    placeholder="Alamat Perusahaan/Instansi">
                                                </textarea>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="userpassword">Alamat Instlasi</label>
                                                <textarea name="alamat_instalasi" id="alamat_instalasi" cols="3"
                                                    rows="3" class="form-control" placeholder="Alamat Instalasi">
                                                </textarea>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="term-conditionCheck">
                                                <label class="custom-control-label font-weight-normal"
                                                    for="term-conditionCheck">I accept <a href="#"
                                                        class="text-primary">Terms and Conditions</a></label>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success btn-block waves-effect waves-light"
                                                    ng-click="register()" type="button">Register</button>
                                            </div>
                                            <div class="mt-4 text-center">
                                                <a href="<?=base_url('auth/login')?>" class="text-muted"><i
                                                        class="mdi mdi-account-circle mr-1"></i>
                                                    Already have account ?
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end Account pages -->

    <!-- JAVASCRIPT -->
    <script src="<?=base_url()?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?=base_url()?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?=base_url()?>assets/libs/node-waves/waves.min.js"></script>
    <!-- Custom Angular -->
    <script src="<?=base_url()?>/assets/angular/angular.js"></script>
    <script src="<?=base_url()?>/assets/angular/angular.min.js"></script>
    <script src="<?=base_url()?>/assets/angular/angular-datatables.min.js"></script>
    <!-- Sweet Alerts js -->
    <script src="<?=base_url()?>/assets/sweetalert/sweetalert2.min.js"></script>
    <script src="<?=base_url()?>/assets/sweetalert/sweetalert2.js"></script>
    <script src="<?=base_url()?>/assets/sweetalert/sweetalert2.all.js"></script>
    <script src="<?=base_url()?>/assets/sweetalert/sweetalert2.all.min.js"></script>
    <!-- End Sweet Alert -->
    <script src="<?=base_url()?>assets/js/app.js"></script>
    <!-- custom -->
    <script src="<?=base_url()?>assets/custom/auth/register.js"></script>

</body>

</html>
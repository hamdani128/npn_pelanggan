<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Recover Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo-npn.png">

    <!-- Bootstrap Css -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?=base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?=base_url()?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="bg-info bg-pattern">
    <div class="home-btn d-none d-sm-block">
        <a href="index.html"><i class="mdi mdi-home-variant h2 text-white"></i></a>
    </div>

    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <a href="<?=base_url("auth/login")?>" class="logo"><img
                                src="<?=base_url()?>assets/images/logo-npn.png" height="80" alt="logo"></a>
                        <h5 class="font-size-16 text-white-50 mb-2 mt-4">
                            PT.NETINDO PERSADA NUSANTARA
                        </h5>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-2">
                                <h5 class="mb-5 text-center">Forgot Password</h5>
                                <form class="form-horizontal" action="#">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-hidden="true">×</button>
                                                Enter your <b>Email</b> and instructions will be sent to you!
                                            </div>

                                            <div class="form-group mt-4">
                                                <label for="useremail">Email</label>
                                                <input type="email" class="form-control" id="useremail"
                                                    placeholder="Enter email">
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success btn-block waves-effect waves-light"
                                                    type="button" onclick="SendEmailPassword()">Send Email</button>
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
    <!-- Angular -->
    <!-- Custom Angular -->
    <script src="<?=base_url()?>assets/angular/angular.js"></script>
    <script src="<?=base_url()?>assets/angular/angular.min.js"></script>
    <script src="<?=base_url()?>assets/angular/angular-datatables.min.js"></script>
    <!-- Sweet Alerts js -->
    <script src="<?=base_url()?>assets/sweetalert/sweetalert2.min.js"></script>
    <script src="<?=base_url()?>assets/sweetalert/sweetalert2.js"></script>
    <script src="<?=base_url()?>assets/sweetalert/sweetalert2.all.js"></script>
    <script src="<?=base_url()?>assets/sweetalert/sweetalert2.all.min.js"></script>

    <script src="<?=base_url()?>assets/js/app.js"></script>
    <!-- custom -->
    <script src="<?=base_url()?>assets/custom/auth/login.js"></script>

</body>

</html>
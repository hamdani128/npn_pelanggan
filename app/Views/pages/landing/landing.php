<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Mitra Corporate - NPN</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?=base_url()?>landing/assets/img/logo-npn.png" rel="icon">
    <link href="<?=base_url()?>landing/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome CDN -->
    <!-- Font Awesome v4.7 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Vendor CSS Files -->
    <link href="<?=base_url()?>landing/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>landing/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=base_url()?>landing/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?=base_url()?>landing/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?=base_url()?>landing/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?=base_url()?>landing/assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page" ng-app="LandingCorporateApp">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="<?=base_url()?>landing/assets/img/logo.webp" alt=""> -->
                <h5 class="sitename">
                    PT Netindo Persada Nusantara
                </h5>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#">Registrasi</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <a class="btn-getstarted" href="<?=base_url("auth/login")?>">Login</a>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        data-aos="zoom-out">
                        <h1>Better Solutions For Your Business</h1>
                        <p>We provide the best solutions for your business needs.</p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
                        <img src="<?=base_url()?>landing/assets/img/hero-img.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Contact Section -->

        <!-- /Contact Section -->
    </main>

    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="<?=base_url()?>" class="d-flex align-items-center">
                        <span class="sitename">PT Netindo Persada Nusantara</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Alamat : <strong>
                                Jl. Cucak Rawa 1 No.81 Kab. Deli Serdang
                                Sumatera Utara, Indonesia
                            </strong>
                        </p>
                        <p>Phone : <b>+62 852 75000 675</b></p>
                        <p>Email : <strong><span>admin@npn.net.id</span></strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">PT Netindo Persada Nusantara</strong> <span>All
                    Rights Reserved</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                RND <a href="https://bootstrapmade.com/">PT Netindo Persada Nusantara</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?=base_url()?>landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>landing/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?=base_url()?>landing/assets/vendor/aos/aos.js"></script>
    <script src="<?=base_url()?>landing/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?=base_url()?>landing/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?=base_url()?>landing/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="<?=base_url()?>landing/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?=base_url()?>landing/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <!-- Angular -->
    <script src="<?=base_url()?>assets/angular/angular.js"></script>
    <script src="<?=base_url()?>assets/angular/angular.min.js"></script>
    <script src="<?=base_url()?>assets/angular/angular-datatables.min.js"></script>
    <!-- Sweet Alerts js -->
    <script src="<?=base_url()?>assets/sweetalert/sweetalert2.min.js"></script>
    <script src="<?=base_url()?>assets/sweetalert/sweetalert2.js"></script>
    <script src="<?=base_url()?>assets/sweetalert/sweetalert2.all.js"></script>
    <script src="<?=base_url()?>assets/sweetalert/sweetalert2.all.min.js"></script>

    <!-- Main JS File -->
    <script src="<?=base_url()?>landing/assets/js/main.js"></script>
    <!-- script -->
    <script src="<?=base_url()?>landing/assets/js/main.js"></script>
    <script src="<?=base_url()?>landing/assets/custom/landing.js"></script>
</body>

</html>
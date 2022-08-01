<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Inspektorat Daerah Daerah Kabupaten Bolaang Mongondow</title>
    <meta content="Website Resmi Inspektorat Daerah Daerah Kabupaten Bolaang Mongondow" name="description">
    <meta content="skpd, opd, inspektorat, lolak, bolaang mongondow, inspektorat daerah" name="keywords">

    <link href="/template/frontend/assets/img/favicon.png" rel="icon">
    <link href="/template/frontend/assets/img/favicon.png" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="/template/frontend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/frontend/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="/template/frontend/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/template/frontend/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="/template/frontend/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/template/frontend/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="/template/frontend/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/template/frontend/assets/css/style.css" rel="stylesheet">
</head>

<body>
    @include('layouts.frontend.header')
    <main id="main">
        @include('layouts.frontend.breadcrumbs')
        <section id="blog" class="blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 entries">
                        @yield('content')
                    </div>
                    <div class="col-lg-4">

                        <div class="sidebar">

                            @include('layouts.frontend.search')

                            @include('layouts.frontend.category')

                            @include('layouts.frontend.recent')

                            @include('layouts.frontend.tag')

                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->
                </div>
            </div>
        </section>


    </main><!-- End #main -->
    @include('layouts.frontend.footer')
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    <script src="/template/frontend/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/template/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/template/frontend/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="/template/frontend/assets/vendor/php-email-form/validate.js"></script>
    <script src="/template/frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/template/frontend/assets/vendor/venobox/venobox.min.js"></script>
    <script src="/template/frontend/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="/template/frontend/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="/template/frontend/assets/js/main.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @stack('meta')
    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{url('/')}}/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{url('/')}}/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="{{url('/')}}/assets/css/custom.css" rel="stylesheet">

</head>
<body id="page-top">


<!-- Page Wrapper -->
<div id="wrapper">


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>



                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">



                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input  type="text" class="quicksearch form-control bg-light border-0 small"
                                       placeholder="Search for..." aria-label="Search"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->


<!-- Bootstrap core JavaScript-->
<script src="{{url('/')}}/assets/vendor/jquery/jquery.min.js"></script>
<script src="{{url('/')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{url('/')}}/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{url('/')}}/assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{url('/')}}/assets/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{url('/')}}/assets/js/demo/chart-area-demo.js"></script>
<script src="{{url('/')}}/assets/js/demo/chart-pie-demo.js"></script>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
<!-- or -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

<script>
    $(function() {
        @stack('custom-scripts')
    });
</script>

</body>

</html>

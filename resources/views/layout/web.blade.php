<!DOCTYPE html>
<html lang="en" class="light-style     customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{url('/')}}/sneat/demo/assets/" data-base-url="{{url('/')}}" data-framework="laravel" data-template="blank-menu-theme-default-light">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Shopping Scene - Manage</title>
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('/')}}/sneat/demo/assets/img/favicon/favicon.ico" />

    <!-- Include Styles -->
    <!-- BEGIN: Theme CSS-->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{url('/')}}/sneat/demo/assets/vendor/fonts/boxiconsc4a7.css?id=87122b3a3900320673311cebdeb618da" />
    <link rel="stylesheet" href="{{url('/')}}/sneat/demo/assets/vendor/fonts/fontawesome5919.css?id=cfafea31c584abe0bcf920c389ea9b3f" />
    <link rel="stylesheet" href="{{url('/')}}/sneat/demo/assets/vendor/fonts/flag-icons5883.css?id=403b97c176f3cdf56a3cbf09107ee240" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{url('/')}}/sneat/demo/assets/vendor/css/rtl/core.css?id=2dd9c913029b2c5f8ee3be4934b17c9b" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{url('/')}}/sneat/demo/assets/vendor/css/rtl/theme-default.css" />


    <link rel="stylesheet" href="{{url('/')}}/sneat/demo/assets/vendor/libs/perfect-scrollbar/perfect-scrollbarb440.css?id=d9fa6469688548dca3b7e6bd32cb0dc6" />
    <link rel="stylesheet" href="{{url('/')}}/sneat/demo/assets/vendor/libs/typeahead-js/typeahead3881.css?id=8fc311b79b2aeabf94b343b6337656cf" />

    <!-- Vendor Styles -->


    <link rel="stylesheet" href="{{url('/')}}/sneat/demo/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
     <link rel="stylesheet" href="{{url('/')}}/sneat/demo/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="{{url('/')}}/sneat/demo/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
    <link rel="stylesheet" href="{{url('/')}}/assets/css/iziToast.min.css"/>
    <link rel="stylesheet" href="{{url('/')}}/assets/vendor/sweetalert2/sweetalert2.css"/>
    <link rel="stylesheet" href="{{url('/')}}/assets/css/custom.css"/>
    <script src="{{url('/')}}/sneat/demo/assets/vendor/js/helpers.js"></script>

    <!-- beautify ignore:start -->
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{url('/')}}/sneat/demo/assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{url('/')}}/sneat/demo/assets/js/config.js"></script>

    <!-- beautify ignore:end -->
    <script>
        var app_url = '{{url('/')}}';
    </script>
    <script src="{{url('/')}}/app.js"></script>
</head>

<body>
<!-- Layout Content -->
<div class="loading"></div>
<div class="layout-wrapper layout-content-navbar ">
    <div class="layout-container">

      @include('partials.layout-menu')

        <!-- Layout page -->
        <div class="layout-page">
            <!-- BEGIN: Navbar-->
            <!-- Navbar -->
          @include('partials.navbar')
            <!-- / Navbar -->
            <!-- END: Navbar-->


            <!-- Content wrapper -->
            <div class="content-wrapper">
                <div class="container-xxl mt-3">
            @include('partials.message')
                </div>
        @yield('content')

        @include('common.ajax-modal')
        @include('partials.footer')

        <!-- Include Scripts -->
            <!-- BEGIN: Vendor JS-->
            <script src="{{url('/')}}/sneat/demo/assets/vendor/libs/jquery/jquery6d45.js?id=b49db52ac0f1a7a5d75b32b6326b285f"></script>
            <script src="{{url('/')}}/sneat/demo/assets/vendor/libs/popper/popperc382.js?id=1f8255bd80f17f73ba33c2d1210e5763"></script>
            <script src="{{url('/')}}/sneat/demo/assets/vendor/js/bootstrap5867.js?id=e310c0547362e972fb0e431ca7b5f438"></script>
            <script src="{{url('/')}}/sneat/demo/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar4d5e.js?id=9d86308b7c41e76a7dc8472907865b83"></script>
            <script src="{{url('/')}}/sneat/demo/assets/vendor/libs/hammer/hammerc38e.js?id=2a80ebd1aa77a9e33ec54b68ee8de5e0"></script>
            <script src="{{url('/')}}/sneat/demo/assets/vendor/libs/i18n/i18n4fe2.js?id=8552a7b6c4b850c1768e5ed4409f1b97"></script>
            <script src="{{url('/')}}/sneat/demo/assets/vendor/libs/typeahead-js/typeaheada766.js?id=8c315d7e2e7b09a04d8e8efead923241"></script>
            <script src="{{url('/')}}/sneat/demo/assets/vendor/js/menu7d39.js?id=f45ec38086f86335b91fc2fdcaaadab8"></script>
            <script src="{{url('/')}}/sneat/demo/assets/vendor/libs/select2/select2.js"></script>
            <script src="{{url('/')}}/sneat/demo/assets/vendor/libs/cleavejs/cleave.js"></script>
            <script src="{{url('/')}}/sneat/demo/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
            <!-- END: Page Vendor JS-->
            <!-- BEGIN: Theme JS-->
            <script src="{{url('/')}}/sneat/demo/assets/js/mainc3d7.js?id=3c628e87a9befaa350e1f822744b8142"></script>

            <script src="{{url('/')}}/assets/js/jquery.validate.min.js"></script>
            <script src="{{url('/')}}/assets/js/additional-methods.js"></script>
            <script src="{{url('/')}}/assets/js/conditionize.js"></script>
            <script src="{{url('/')}}/assets/js/iziToast.min.js"></script>
            <script src="{{url('/')}}/assets/vendor/sweetalert2/sweetalert2.js"></script>


@stack('scripts')

<script>
    $(document).ready(function()
    {
        $(document).on('click', 'a[data-ajax=1]',function(event)
        {
            event.preventDefault();
            href = $(this).attr('href');
            title = $(this).attr('data-title');
            confirm = $(this).attr('data-confirm');

            if(confirm){
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert!",
                    icon: "danger",
                    showCancelButton: !0,
                    confirmButtonText: "Yes",
                    customClass: {confirmButton: "btn btn-primary me-2", cancelButton: "btn btn-label-secondary"},
                    buttonsStyling: !1
                }).then((function (n) {
                    n.value ?  ss.getAjaxModal(href, {title : title }, '#ajax_content', '#ajaxModal', 'Deleted!') : n.dismiss === Swal.DismissReason.cancel && Swal.fire({
                        title: "Cancelled",
                        text: "Cancelled Suspension :)",
                        icon: "error",
                        customClass: {confirmButton: "btn btn-success"}
                    })
                }))
               // ss.getAjaxModal(href, {title : title }, '#ajax_content', '#ajaxModal')
            }
            else
            {
                ss.getAjaxModal(href, {title : title }, '#ajax_content', '#ajaxModal')
            }

        });
    });

</script>
</body>
</html>

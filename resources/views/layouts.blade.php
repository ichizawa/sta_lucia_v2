<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tenant Management System</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/stlm-logo.jpeg') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ URL::asset('assets/js/plugin/webfont/webfont.min.js') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/kaiadmin.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/shared/shared.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/sidebar-and-nav.css') }}" />

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/1.5.2/select2-bootstrap.min.css"
        rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap5.min.css"
        integrity="sha512-Ars0BmSwpsUJnWMw+KoUKGKunT7+T8NGK0ORRKj+HT8naZzLSIQoOSIIM3oyaJljgLxFi0xImI5oZkAWEFARSA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            font-size: 12px;
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
</head>
<script>
    $(window).on("load", function() {
        $('.overlay').fadeOut('slow');
    });
    $(window).on("beforeunload", function() {
        // $('.overlay').attr('hidden', false);
        $('.overlay').fadeIn('slow');
    });
</script>
@include('loader')

<body>
    <div class="wrapper">
        @if (Auth::user()->type === 'admin')
            @include('admin.components.sidebar')
            <div class="main-panel">
                @include('admin.components.navbar')

                <div class="container">
                    @yield('content')
                </div>

                @include('admin.components.footer')
            </div>
        @elseif (Auth::user()->type === 'bill')
            @include('biller.components.sidebar')
            <div class="main-panel">
                @include('biller.components.navbar')

                <div class="container">
                    @yield('content')
                </div>

                @include('biller.components.footer')
            </div>
        @elseif (Auth::user()->type === 'collect')
            @include('collect.components.sidebar')
            <div class="main-panel">
                @include('collect.components.navbar')

                <div class="container">
                    @yield('content')
                </div>

                @include('collect.components.footer')
            </div>
        @elseif (Auth::user()->type === 'operation')
            @include('operations.components.sidebar')
            <div class="main-panel">
                @include('operations.components.navbar')

                <div class="container">
                    @yield('content')
                </div>

                @include('operations.components.footer')
            </div>
        @elseif (Auth::user()->type === 'lease')
            @include('lease-admin.components.sidebar')
            <div class="main-panel">
                @include('lease-admin.components.navbar')

                <div class="container">
                    @yield('content')
                </div>

                @include('lease-admin.components.footer')
            </div>
        @else
            @include('client.components.sidebar')
            <div class="main-panel">
                @include('client.components.navbar')

                <div class="container">
                    @yield('content')
                </div>

                @include('client.components.footer')
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2-checkbox/1.1.0/js/select2-checkbox.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-notify/1.0.0/jquery.notify.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script> -->
    <script src="{{ asset('assets/js/core/bootstrap.js') }}"></script>

    <script src="{{ asset('assets/js/tenant/multistep.js') }}"></script>
    {{--
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/tenant/retrievedata.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <script src="{{ asset('assets/js/shared/global.js') }}"></script>
    <script src="{{ asset('assets/js/shared/collection.js') }}"></script>
    <script src="{{ asset('assets/js/shared/collect.js') }}"></script>
    <script src="{{ asset('assets/js/shared/ledger.js') }}"></script>
    <script src="{{ asset('assets/js/shared/sidebar-responsive.js') }}"></script>
</body>

</html>

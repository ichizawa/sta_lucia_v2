<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/kaiadmin.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <style>
        .login {
            min-height: 100vh;
        }

        .login-heading {
            font-weight: 300;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
            background-color: #304F23;
            color: white;
            border-radius: 25px
        }

        .btn-login:hover {
            background-color: #385f28 !important;
        }

        .form-control:focus {
            border-color: #304f23 !important;
            box-shadow: 0 0 5px rgb(48, 79, 35) !important;
        }

        canvas {
            overflow: hidden;
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100%;
        }

        #particles-js {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: 50% 50%;
            position: fixed;
            top: 0px;
            z-index: -1;
        }

        .card {
            background-color: #efefee;
            min-height: 500px;
        }

        #login-form {
            z-index: 10;
            width: 100%;
            max-width: 500px;
        }
    </style>
</head>

<body>
    @include('loader')
    <div class="wrapper">
        <div class="container-fluid ps-md-0">
            <div class="row g-0">

                <div id="particles-js" class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>

                <div id="login-form" class="position-absolute top-50 start-50 translate-middle">
                    <div class="card shadow-lg p-4">
                        <div class="card-body">
                            <div class="logo d-flex justify-content-center align-items-center mb-3">
                                <img src="{{ URL::asset('assets/img/sta_lucia_logo2.png') }}" alt="logo"
                                    style="width: 150px;">
                            </div>
                            <div class="logo d-flex justify-content-center align-items-center mb-0">
                                <p class="text-secondary">Login to your account</p>
                            </div>

                            <form id="loginForm" method="POST">
                                @csrf
                                <div id="emailInput" class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" name="email"
                                        placeholder="Email" required>
                                    <label for="floatingInput">Email address</label>
                                    <small id="emailHelp" class="form-text text-muted" hidden>Please provide a
                                        valid email.</small>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPassword" name="password"
                                        placeholder="Password" required>
                                    <label for="floatingPassword">Password</label>
                                </div>

                                <div class="d-grid">
                                    <button id="loginBTN" class="btn-lg btn-login mt-4" type="submit">
                                        <label class="text-white">Sign in</label>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(window).on("load", function() {
                $('.overlay').fadeOut('slow');
            });
            $(window).on("beforeunload", function() {
                $('.overlay').fadeOut('slow');
            });
        </script>
        <script>
            $(document).ready(function() {
                toggleButton();

                function toggleButton() {
                    const email = $('#floatingInput').val().trim();
                    const password = $('#floatingPassword').val().trim();

                    $('#loginBTN').prop('disabled', email === "" || password === "");
                }
                $('#floatingInput, #floatingPassword').on('input', toggleButton);

                function validateEmailInput() {
                    const email = $('#floatingInput').val().trim();
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (email === "") {
                        $('#emailInput').removeClass('has-error has-feedback');
                        $('#emailHelp').attr('hidden', true);
                    }
                    if (emailPattern.test(email)) {
                        $('#emailInput').removeClass('has-error has-feedback');
                        $('#emailHelp').attr('hidden', true);
                    }
                }

                $('#floatingInput').on('input', function() {
                    validateEmailInput();
                });

                $("#loginBTN").click(function(e) {
                    e.preventDefault();
                    var form = $('#loginForm').serialize();
                    $.ajax({
                        url: "{{ route('authenticate') }}",
                        type: "POST",
                        data: form,
                        beforeSend: function() {
                            $('.overlay').fadeIn('slow');
                        },
                        complete: function() {
                            $('.overlay').fadeOut('slow');
                        },
                        success: function(response) {
                            if (response.status == "error") {
                                var content = {
                                    message: 'Invalid Email or Password',
                                    title: "Account Error!",
                                    icon: "fa fa-bell"
                                };

                                $.notify(content, {
                                    type: 'danger',
                                    placement: {
                                        from: 'top',
                                        align: 'right',
                                    },
                                    time: 1000,
                                    delay: 2000,
                                });
                            } else if (response.status == "email-error") {
                                $('#emailInput').addClass('has-error has-feedback');
                                $('#emailHelp').attr('hidden', false);
                                validateEmailInput();
                            } else {
                                $('.overlay').removeClass('hide');
                                $('.overlay').addClass('show');
                                if (response.role == 1) {
                                    let redirectUrl;
                                    if (response.status == "admin") {
                                        redirectUrl = "{{ route('admin.dashboard') }}";
                                    }
                                    if (response.status == "bill") {
                                        redirectUrl = "{{ route('bill.dashboard') }}";
                                    }
                                    if (response.status == "collect") {
                                        redirectUrl = "{{ route('collect.dashboard') }}";
                                    }
                                    if (response.status == "operation") {
                                        redirectUrl = "{{ route('operation.dashboard') }}";
                                    }
                                    if (response.status == "lease") {
                                        redirectUrl = "{{ route('lease.admin.dashboard') }}";
                                    }
                                    if (response.status == "tenant") {
                                        redirectUrl = "{{ route('client.dashboard') }}";
                                    }
                                    window.location = redirectUrl;
                                } else {
                                    var content = {
                                        message: 'Your account is still pending, please wait for admin to approve!',
                                        title: "Account Error!",
                                        icon: "fa fa-bell"
                                    };

                                    $.notify(content, {
                                        type: 'danger',
                                        placement: {
                                            from: 'top',
                                            align: 'right',
                                        },
                                        time: 1000,
                                        delay: 2000,
                                    });
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        },
                    })
                });
            })
        </script>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script> <!-- jQuery should be loaded first -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

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
</body>

</html>

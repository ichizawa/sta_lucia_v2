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

        .bg-image {
            /* background-image: url('https://images.unsplash.com/photo-1552845108-5f775a2ccb9b?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGJsdWUlMjBtb3VudGFpbnxlbnwwfHwwfHx8MA%3D%3D');
            background-size: cover;
            background-position: center; */
        }

        .login-heading {
            font-weight: 300;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
            background: #304F23;
            color: white;
        }

        .form-control:focus {
            border-color: #304f23 !important;
            box-shadow: 0 0 5px rgb(48, 79, 35) !important;
        }

        canvas{
            overflow: hidden;
            /* position: absolute; */
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100%;
        }

        #particles-js{
            /* width: 100%;
            height: 100%; */
            /* background-size: cover;
            background-position: 50% 50%;
            position: fixed;
            top: 0px;
            z-index: 1; */
        }
    </style>
</head>

<body>
    @include('loader')
    <div class="wrapper">
        <div class="container-fluid ps-md-0">
            <div class="row g-0">
                <div id="particles-js" class="d-none d-md-flex col-md-4 col-lg-6 bg-image">
                    <!-- <canvas id="test"></canvas> -->
                </div>
                <div class="col-md-8 col-lg-6">
                    <div class="login d-flex align-items-center py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 col-lg-8 mx-auto" style="margin-top: -10vh">
                                    <div class="logo d-flex justify-content-center align-items-center">
                                        <img src="{{ URL::asset('assets/img/sta_lucia_logo2.png') }}" alt="logo"
                                            style="width: 250px;">
                                    </div>
                                    <!-- <h3 class="login-heading text-start mt-5 mb-5">Welcome back!</h3> -->
                                    {{-- Sign In Form action="{{ route('authenticate') }}" --}}
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
                                            <input type="password" class="form-control" id="floatingPassword"
                                                name="password" placeholder="Password" required>
                                            <label for="floatingPassword">Password</label>
                                        </div>

                                        <!-- <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="rememberPasswordCheck">
                                            <label class="form-check-label" for="rememberPasswordCheck">
                                                Remember password
                                            </label>
                                        </div> -->

                                        <div class="d-grid">
                                            <button id="loginBTN"
                                                class="btn btn-lg btn-login text-uppercase fw-bold mb-2"
                                                type="submit">Sign in</button>
                                            <!-- <div class="text-center">
                                                <a class="small" href="#">Forgot password?</a>
                                            </div> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(window).on("load", function () {
                $('.overlay').fadeOut();
            });
            $(window).on("beforeunload", function () {
                $('.overlay').attr('hidden', false);
            });
        </script>
        <script>
            $(document).ready(function () {
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

                $('#floatingInput').on('input', function () {
                    validateEmailInput();
                });

                $("#loginBTN").click(function (e) {
                    e.preventDefault();
                    var form = $('#loginForm').serialize();
                    $.ajax({
                        url: "{{ route('authenticate') }}",
                        type: "POST",
                        data: form,
                        // dataType: 'json',
                        beforeSend: function () {
                            // $('.overlay').attr('hidden', false);
                        },
                        success: function (response) {
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
                                    } else if(response.status == "bill") {
                                        redirectUrl = "{{ route('bill.dashboard') }}";
                                    } else {
                                        redirectUrl = "{{ route('client.dashboard') }}";
                                    }
                                    window.location = redirectUrl;
                                    // setTimeout(function () {
                                    //     $('.overlay').removeClass('show');
                                    //     $('.overlay').addClass('hide');

                                    //     window.location = redirectUrl;
                                    // }, 2000);
                                } else {
                                    // $('.overlay').removeClass('show');
                                    // $('.overlay').addClass('hide');
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
                        error: function (xhr, status, error) {
                            // console.log(status);
                        },
                        complete: function () {
                            // $('.overlay').attr('hidden', true);
                        }
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
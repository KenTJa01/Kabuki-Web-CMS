<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <link rel="stylesheet" href="css/style.css">

    {{-- Sweet Alert --}}
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script src="{{ asset('js/sweetalert-min.js') }}" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link rel="stylesheet" href="{{ asset ('css/datatables.css') }}">
    <script src="{{ asset ('js/jquery-v3-7-1.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    {{-- SELECT 2 --}}
    <link href="{{ asset('css/select2-min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/select2-min.js') }}"></script>

    {{-- Bootstrap --}}
    <link href="{{ asset ('css/bootstrap-v5.css') }}" rel="stylesheet">
    <script src="{{ asset ('js/bootstrap-v5.js') }}"></script>
    <script src="{{ asset ('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('js/main.js') }}"></script>

    {{-- Bootstrap Icon --}}
    <link href="{{ asset ('css/bootstrap-icon.css') }}" rel="stylesheet">

    {{-- Font Poppins  --}}
    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins';
            /* display: flex; */
            height: 100%;
        }

        .left_content {
            background-image: url('img/bg_login.svg');
            background-size: cover;
            background-position: center;
            /* transform: scaleX(-1); */
            width: 50%;
        }

        .form_login {
            background-color: white;
            color: #3F3F3F;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .body_login {
            width: 60% !important;
            margin-top: -50px;
        }

        .form_input {
            margin: 0px 50px 0px 50px;
        }

        .logo_yogya_top_left {
            position: absolute;
            top: 0;
            left: 0;
            padding: 20px 0px 0px 20px;
            max-width: 7%;
            height: auto;
            padding: 20px 0 0 20px;
            z-index: 9999;
        }

        .button_login {
            border: 0px;
            background-color: #3E3E3E;
            color: white;
            border-radius: 8px;
            padding: 8px 0px 8px 0px;
            font-weight: 500;
            font-size: 18px;
        }

        .alert {
            padding: 15px;
            /* margin-top  : 20px; */
            border-radius: 4px;
            color: #fff;
            font-size: 12px
        }

        .alert_info{
            background-color: #4285f4;
            border: 2px solid #4285f4
        }

        button.close {
            -webkit-appearance: none;
            padding: 0;
            cursor: pointer;
            background: 0 0;
            border: 0
        }

        .close {
            font-size: 24px;
            color: #fff;
            font-weight: normal
        }

        .alert_success {
            background-color: #09c97f;
            border: 2px solid #09c97f
        }
        .alert_warning {
            background-color: #f8b15d;
            border: 2px solid #f8b15d
        }
        .alert_error {
            background-color: #f95668;
            border: 2px solid #f95668}
        .fade_info {
            background-color: #d9e6fb;
            border: 1px solid #4285f4
        }
        .fade_info .close {
            color: #4285f4
        }
        .fade_info strong {
            color: #4285f4
        }
        .fade_success {
            background-color: #c9ffe5;
            border: 1px solid #09c97f;
        }
        .fade_success .close {
            color: #09c97f;
        }
        .fade_success strong {
            color: #09c97f;
        }
        .fade_warning {
            background-color: #fff0cc;
            border: 1px solid #f8b15d;
        }
        .fade_warning .close {
            color: #f8b15d;
        }
        .fade_warning strong {
            color: #f8b15d;
        }
        .fade_error {
            background-color: #ffdbdb;
            border: 1px solid #f95668}
        .fade_error .close {
            color: #f95668}
        .fade_error strong  {
            color: #f95668
        }
    </style>

</head>
<body id="body_login" style="background-color: #3F3F3F;">


    <img src="img/logo_kabuki_text.svg" class="logo_yogya_top_left">

    <div class="d-flex" style="height: 100%; width: 100%;">

        <div class="col left_content">
            <div style="width: 350px; height: 200px; background-color:red; margin: 32% 25%; padding: 4.5% 6.5%; border-radius: 20px; background: rgba(255, 255, 255, 0.099); backdrop-filter: blur(30px); -webkit-backdrop-filter: blur(20px);">
                <img src="img/logo_kabuki.svg" style="width: 250px">
            </div>
        </div>

        <div class="col form_login">
            <div class="body_login">

                <div class="d-flex">
                    <img src="img/logo_kabuki_circle.svg" style="margin-bottom:15px; width: 50px">
                    <h3 class="mt-1" style="margin-left: 15px !important;"><strong>Welcome!</strong></h3>
                </div>
                <p class="" style="font-size: 15px; color: rgb(171, 171, 171); margin-bottom: 40px;">please Login before you enter the website.</p>

                <hr>

                {{-- <div class="form_input" style="font-size: 18px"> --}}
                    <div class="mb-1">
                        <label for="username" class="form-label" style="font-size: 16px; font-weight: 400; margin-bottom:0px;">Username</label>
                        <input type="email" class="form-control" id="username" style="font-size: 16px; height: 37px;">
                    </div>
                    <div class="mb-1">
                        <label for="password" class="form-label" style="font-size: 16px; font-weight: 400; margin-bottom:0px;">Password</label>
                        <input type="password" class="form-control" id="password" style="height: 37px;">
                    </div>
                    <div id="alert"></div>
                    <a style="text-decoration: none"><button class="button_login" id="button_login" title="Login Button" style="width: 100%">Login</button></a>
                {{-- </div> --}}
            </div>
        </div>
    </div>

    <!-- <img src="img/svg/logo-yogya-bottom-left.svg" class="logo_yogya_bottom_left"> -->


    <script>

        // ========================= GLOBAL SETUP CSRF =========================
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){

            var username = document.getElementById("username");
            var pass = document.getElementById("password");
            $(username).focus();

            if ( username != null && pass != null ) {

                pass.addEventListener("keypress", function(event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        document.getElementById("button_login").click();
                    }
                });

            }

            $("#button_login").click(function(){
                var username = $("#username").val();
                var password = $("#password").val();

                $.ajax({
                    type: 'POST',
                    url: "{{ url('/post-request-login') }}",
                    dataType: 'json',
                    data: {
                        username: username,
                        password: password,
                    },
                    success: function(response){

                        if ( response.errors ) {
                            var alert = document.getElementById("alert_error");

                            if ( alert ) {
                                alert.remove();
                                $(".body_login").prepend(`
                                    <div class="row mt-2" id="alert_error">
                                        <div class="col">
                                            <div class="alert fade_error .fade d-flex justify-content-between">
                                                <strong class="mt-2">`+response.errors+`</strong>
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                            </div>
                                        </div>
                                    </div>`
                                );
                            } else {
                                $(".body_login").prepend(`
                                    <div class="row mt-2" id="alert_error">
                                        <div class="col">
                                            <div class="alert fade_error .fade d-flex justify-content-between">
                                                <strong class="mt-2">`+response.errors+`</strong>
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                            </div>
                                        </div>
                                    </div>`
                                );
                            }

                        } else {
                            window.location.href = "{{ url('home') }}"
                        }

                    }

                });
            });

        });

    </script>


</body>
</html>

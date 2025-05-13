<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DGM Core</title>

    <link rel="stylesheet" href="{{ asset ('css/inventory.css') }}">

    {{-- Poppins Google Fonts --}}
    <link href="{{ asset ('css/poppins-google-fonts.css') }}" rel='stylesheet'>


    {{-- Sweet Alert --}}
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script src="{{ asset('js/sweetalert-min.js') }}" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link rel="stylesheet" href="{{ asset ('css/datatables.css') }}">
    <script src="{{ asset ('js/jquery-v3-7-1.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    {{-- SELECT 2 & AUTOCOMPLETE --}}
    <link href="{{ asset('css/select2-min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/select2-min.js') }}"></script>

    {{-- Ajax --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

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
        }
    </style>

</head>
<body style="background-color: #F7F7F9">

    {{-- SIDEBAR --}}
    @include("partials.sidebar")

    {{-- NAVBAR --}}
    @include("partials.navbar")

    {{-- BODY CONTENT --}}
    <div class="body_content">

        @yield("container")

    </div>

    <script>
        $(document).ready(function () {
            setActiveMenu();
        });

        function setActiveMenu(){
            var menuId = $("li.active").parent().attr('id');
            var parentMenuId = $("li.active").parent().parent().attr('id');

            if (menuId != undefined) {
                document.getElementById(menuId).classList.add('show');
                document.getElementById(parentMenuId).classList.remove('dropend');
                document.getElementById(parentMenuId).classList.add('dropdown');
                document.getElementById(parentMenuId).classList.add('aktif');
            }
        }
    </script>


</body>
</html>

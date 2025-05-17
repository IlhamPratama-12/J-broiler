<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Broiler Web">
    <meta name="keywords" content="Murah & Berkualitas">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="./favicon.png">
    <title>FL BROILER | {{ $title }}</title>

    <meta property="og:title" content="FL Broiler" />
    <meta property="og:description" content="Kami dengan bangga mempersembahkan berbagai pilihan ayam broiler berkualitas tinggi yang dihasilkan dengan standar tertinggi dalam industri peternakan." />
    <meta property="og:image" content="{{ asset('img/defaults/logo-default.jpg') }}" />
    <meta property="og:type" content="website" />

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <script src="https://kit.fontawesome.com/d25e617f24.js" crossorigin="anonymous"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('shoppers/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('shoppers/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shoppers/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('shoppers/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('shoppers/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shoppers/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shoppers/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('shoppers/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminLTE/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <style>
        .google-map {
            padding-bottom: 50%;
            position: relative;
        }

        .google-map iframe {
            height: 100%;
            width: 100%;
            left: 0;
            top: 0;
            position: absolute;
        }

        i,
        a {
            /* color: #7971ea */
            color: #075FC7
        }

        .btn-primary {
            background-color: #075FC7
        }

        .btn-primary:hover {
            background-color: #044ca4
        }

        .dropup .hide-toggle.dropdown-toggle::after {
            display: none !important;
        }
        .wa{
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 2;
            font-size: 24px;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
            cursor: pointer;
        }
    </style>
    @stack('style')
</head>

<body>
    <div class="site-wrap">
        @include('main.includes.header')
        @yield('content')
        @include('main.includes.footer')

    </div>
    <div class="wa">
        <div class="d-flex justify-content-center align-items-center float-right">
            <a class="btn btn-secondary fixed-bottom" href="https://wa.me/message/W7RKBN2JWUHEC1" target="_blank" style="background-color: green;border-radius:30%;border:unset" >
                    <i class="fa-brands fa-whatsapp fa-2x" style="color: white
                    "></i>
                {{-- <i class="fa fa-whatsapp" aria-hidden="true"></i> --}}
                {{-- WhatsApp --}}
            </a>
        </div>
    </div>
    <!-- Js Plugins -->
    <script src="{{ asset('shoppers/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('shoppers/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('shoppers/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('shoppers/js/popper.min.js') }}"></script>
    <script src="{{ asset('shoppers/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('shoppers/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('shoppers/js/aos.js') }}"></script>
    <script src="{{ asset('shoppers/js/feather.js') }}"></script>
    <script src="{{ asset('shoppers/js/feather.min.js') }}"></script>
    <script src="{{ asset('shoppers/js/main.js') }}"></script>
    <script src="{{ asset('/adminLTE/sweetalert2/sweetalert2.min.js') }}"></script>

</body>
<script>
    let message = `{{ Session::get('success') }}`;
    if (message) {
        Swal.fire(
            'Pesan Terkirim!',
            message,
            'success'
        )
    }
    feather.replace()
</script>
@stack('script')

</html>

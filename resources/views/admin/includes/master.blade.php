<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="png" href="/favicon.png">
    <title>FL BROILER | {{ $title }}</title>
    @include('admin.includes.head')
    @stack('style')
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed" style="height: auto">
    <div class="wrapper">

        @include('admin.includes.navbar')

        @include('admin.includes.sidebar')

        <div class="content-wrapper">
            <div class="content-header" style="max-height: 5rem">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="m-0 text-bold">{{ $title }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                @yield('content')
            </section>
        </div>
    </div>

    @include('admin.includes.script')
</body>
<script>
    let message = `{{ Session::get('success') }}`;
    if (message) {
        toastr.success(message)
    }
    </script>
@stack('scripts')

</html>

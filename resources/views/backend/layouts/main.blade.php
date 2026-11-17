<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-GiKu | {{ $title }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo-genbi.webp') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <!-- Sidebar navigation-->
            @include('backend.layouts.sidebar')
            <!-- End Sidebar navigation -->
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('backend.layouts.header')
            <!--  Header End -->
            <div class="container-fluid">
                <!--  content -->
                @yield('content')
                <!--  end content -->

                {{-- copyright --}}
                <div class="px-6 py-6 text-center">
                    <p class="mb-0 fs-4">Design and Developed by <a href="https://github.com/rifkifiransah"
                            target="_blank" class="pe-1 text-primary text-decoration-underline">Rifki Firansah</a>
                        Distributed for <a href="https://genbi.com">Genbi Uniku</a></p>
                </div>
                {{-- end copyright --}}
            </div>
        </div>
    </div>
    {{-- footer --}}
    @include('backend.layouts.footer')
    {{-- end footer --}}
</body>

</html>

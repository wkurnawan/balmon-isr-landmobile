<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <title>{{ $title ?? '' }}{{ isset($title) ? ' - ' : '' }}ISRLM</title>

    <!-- Favicon -->
    <link href="{{ asset('dashmin') }}/assets/img/kominfo.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('dashmin') }}/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('dashmin') }}/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('dashmin') }}/assets/css/bootstrap.min.css" rel="stylesheet">

    @stack('style')

    <!-- Template Stylesheet -->
    <link href="{{ asset('dashmin') }}/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        @include('components.sidebar')
        <!-- Sidebar End -->
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('components.navbar')
            <!-- Navbar End -->
            @yield('content')
            <!-- Footer Start -->
            @include('components.footer')
            <!-- Footer End -->
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dashmin') }}/assets/lib/chart/chart.min.js"></script>
    <script src="{{ asset('dashmin') }}/assets/lib/easing/easing.min.js"></script>
    <script src="{{ asset('dashmin') }}/assets/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('dashmin') }}/assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('dashmin') }}/assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="{{ asset('dashmin') }}/assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="{{ asset('dashmin') }}/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    @stack('script')

    <!-- Template Javascript -->
    <script src="{{ asset('dashmin') }}/assets/js/main.js"></script>
    @include('components.alert')
</body>

</html>

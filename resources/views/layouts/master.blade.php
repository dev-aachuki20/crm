<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM - Profile</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <main class="main-screen">
        <!-- HEADER START -->
        @include('layouts.includes.header')
        <!-- HEADER END -->

        <!-- MAIN BLOCK START -->
        <section class="mainwraaper-sec d-flex justify-content-end align-items-center">
            @yield('content')
        </section>
        <!-- MAIN BLOCK END -->

        <!-- FOOTER START -->
        @include('layouts.includes.footer')
        <!-- FOOTER END -->
    </main>

    <!-- SCRIPTS -->
    @include('layouts.includes.footerlinks')
</body>

</html>
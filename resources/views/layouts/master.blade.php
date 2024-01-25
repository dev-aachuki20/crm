<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>CRM - Profile</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/toaster-design.css')}}">

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <main class="main-screen">
        {{-- <div id="toaster-container"></div>
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    showToaster("{{ session('success') }}", 'success');
                });
            </script>
        @endif --}}
        <!-- HEADER START -->
        @include('layouts.includes.header')

        <section class="mainwraaper-sec d-flex justify-content-end align-items-center py-4">
            @yield('content')
        </section>

        @include('layouts.includes.footer')
    </main>

    @include('layouts.includes.footerlinks')
</body>

</html>

{{-- <script>
    function showToaster(message, type) {
        var toasterContainer = document.getElementById('toaster-container');
        var toaster = document.createElement('div');

        toaster.className = 'toaster ' + type;
        toaster.textContent = message;
        toasterContainer.appendChild(toaster);
        void toaster.offsetWidth;
        toaster.classList.add('show');

        setTimeout(function () {
            toaster.classList.remove('show');
            toaster.addEventListener('transitionend', function () {
                toasterContainer.removeChild(toaster);
            });
        }, 3000);
    }
</script> --}}
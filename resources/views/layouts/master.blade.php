<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> {{config('app.name')}} - @yield('title', 'Default Title')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/toaster-design.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    @stack('styles')

    <!-- <style>
        /* Hide default text and adjust styles */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0;
            margin-left: 0.5em;
            overflow: hidden;
        }

        /* Chevron-left */
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous::before {
            content: '\f053';
        }

        /* Chevron-right */
        .dataTables_wrapper .dataTables_paginate .paginate_button.next::before {
            content: '\f054';
        }

        /* Hide the text visually while keeping it accessible for screen readers */
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous span,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next span {
            display: none;
        }

        /* Add additional styling if needed */
        .dataTables_wrapper .dataTables_paginate .paginate_button i {
            font-size: 1.2em;
            color: #007bff;
        }
    </style> -->
</head>

<body>
    <main class="main-screen">
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
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Vinařství Andrzej')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Optional jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel='icon' href='/grapes.ico' />

    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            top: 0;
            right: 0;
            background: #f8f8f8;
            padding-top: 60px;
            border-right: 1px solid #ddd;
        }
        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #e9ecef;
        }
        .content {
            margin-right: 240px;
            padding: 20px;
            padding-top: 70px;
        }
        nav.navbar {
            height: 60px;
        }
    </style>
</head>
<body>

    {{-- Top navbar --}}
    @include('partials.topnav')
    @include('partials.sidebar')

    {{-- Page Content --}}
    <main class="content">
        @yield('content')
    </main>

</body>
</html>

@yield('script')

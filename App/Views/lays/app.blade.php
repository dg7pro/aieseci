<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIESECI Institute Maldahiya Varanasi</title>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Template CSS Style link -->
    <link rel="stylesheet" href="/assets/css/style-starter.css">

    {{--<link rel="stylesheet" href="/assets/css/font-awesome.min.css">--}}

    {{--<link rel="stylesheet" href="/assets/css/style2.css">--}}

    @yield('custom_css')
</head>

<body>

@include('lays.partials.header')

@yield('content')

@include('lays.partials.footer')
@include('lays.partials.script')

@yield('custom_js')

</body>
</html>
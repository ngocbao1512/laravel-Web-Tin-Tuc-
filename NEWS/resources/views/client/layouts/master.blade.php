<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{asset('theme-client/fontawesome/css/all.min.css')}}">
    <!-- https://fontawesome.com/ -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- https://fonts.google.com/ -->
    <link href="/theme-client/css/bootstrap.min.css" rel="stylesheet">
    <link href="/theme-client/css/templatemo-xtra-blog.css" rel="stylesheet">
    @include('admin.layouts.general-css')
    @yield('css')
    <!--
    
TemplateMo 553 Xtra Blog

https://templatemo.com/tm-553-xtra-blog

-->
</head>

<body>
    @yield('sidebar')
    @yield('content')
    <script src="/theme-client/js/jquery.min.js"></script>
    <script src="/theme-client/js/templatemo-script.js"></script>
    @include('admin.layouts.general-js')
    @yield('js')
    @yield('active')

</body>

</html>
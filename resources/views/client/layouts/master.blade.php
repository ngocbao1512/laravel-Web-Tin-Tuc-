<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{asset('theme-client/fontawesome/css/all.min.css')}}">
    <!-- https://fontawesome.com/ -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- https://fonts.google.com/ -->
    <link href="/theme-client/css/bootstrap.min.css" rel="stylesheet">
    <link href="/theme-client/css/templatemo-xtra-blog.css" rel="stylesheet">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    @include('client.layouts.general-css')
    @yield('css')
    <!--
    
TemplateMo 553 Xtra Blog

https://templatemo.com/tm-553-xtra-blog

-->
</head>

<body>
    <div class="container-fluid">
        <?php
        $language = session('website_language', config('app.locale'));
        ?>
        <div class="col-12">
            <div class="row">
                <div class="col-10">
                </div>
                <div class="col-2" >
                    <div id="lang-switch">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Vietnam.svg/1024px-Flag_of_Vietnam.svg.png" class="vn  @if ($language == 'vi') active-flag @endif" style="height: 25px; width: 50px; margin-left: 50px; " onclick="changeLanguage(this,'vi')">
                        <img src="https://cdn3.iconfinder.com/data/icons/finalflags/256/United-Kingdom-flag.png" class="en @if ($language == 'en') active-flag @endif" style="height: 25px; width: 50px; margin: 0;" onclick="changeLanguage(this,'en')">
                    </div>
                </div>
                <div class="container" id="loading" style="display:none">
                    <div class="ring"></div>
                    <div class="ring"></div>
                    <div class="ring"></div>
                </div>
            </div>
        </div>
        <main class="tm-main">
           @yield('header')  
            @yield('content')         
            @yield('footer')
        </main>
    </div>

    <script src="/theme-client/js/jquery.min.js"></script>
    <script src="/theme-client/js/templatemo-script.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('client.layouts.general-js')
    @yield('js')

</body>

</html>
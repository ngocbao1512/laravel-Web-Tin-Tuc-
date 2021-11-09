<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtra Blog</title>
    <link rel="stylesheet" href="/theme-client/fontawesome/css/all.min.css">
    <!-- https://fontawesome.com/ -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- https://fonts.google.com/ -->
    <link href="/theme-client/css/bootstrap.min.css" rel="stylesheet">
    <link href="/theme-client/css/templatemo-xtra-blog.css" rel="stylesheet">
    <!--
    
TemplateMo 553 Xtra Blog

https://templatemo.com/tm-553-xtra-blog

-->
</head>

<body>
    <header class="tm-header" id="tm-header">
        <div class="tm-header-wrapper">
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="tm-site-header">
                <div class="mb-3 mx-auto tm-site-logo"><i class="fas fa-times fa-2x"></i></div>
                <h1 class="text-center">Xtra Blog</h1>
            </div>
            <nav class="tm-nav" id="tm-nav">
                <ul>
                    <li class="tm-nav-item" id="bloghome">
                        <a href="{{route('client.index')}}" class="tm-nav-link">
                            <i class="fas fa-home"></i> Blog Home
                        </a>
                    </li>
                    <li class="tm-nav-item" id="singlepost">
                        <a href="{{route('client.post')}}" class="tm-nav-link">
                            <i class="fas fa-pen"></i> Single Post
                        </a>
                    </li>
                    <li class="tm-nav-item" id="aboutxtra">
                        <a href="{{route('client.about')}}" class="tm-nav-link">
                            <i class="fas fa-users"></i> About Xtra
                        </a>
                    </li>
                    <li class="tm-nav-item" id="contactus">
                        <a href="{{route('client.contact')}}" class="tm-nav-link">
                            <i class="far fa-comments"></i> Contact Us
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="tm-mb-65">
                <a href="https://facebook.com" class="tm-social-link">
                    <i class="fab fa-facebook tm-social-icon"></i>
                </a>
                <a href="https://twitter.com" class="tm-social-link">
                    <i class="fab fa-twitter tm-social-icon"></i>
                </a>
                <a href="https://instagram.com" class="tm-social-link">
                    <i class="fab fa-instagram tm-social-icon"></i>
                </a>
                <a href="https://linkedin.com" class="tm-social-link">
                    <i class="fab fa-linkedin tm-social-icon"></i>
                </a>
            </div>
            <p class="tm-mb-80 pr-5 text-white">
                Xtra Blog is a multi-purpose HTML template from TemplateMo website. Left side is a sticky menu bar. Right side content will scroll up and down.
            </p>
        </div>
    </header>
    {{$slot}}
    <script src="/theme-client/js/jquery.min.js"></script>
    <script src="/theme-client/js/templatemo-script.js"></script>
    @yield('active')
</body>

</html>
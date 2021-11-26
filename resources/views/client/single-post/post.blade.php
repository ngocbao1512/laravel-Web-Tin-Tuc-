
@extends('client.layouts.master')

@section('title')   
    {{$blog['title']}}
@endsection

@section('sidebar')
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
                <li class="tm-nav-item"><a href="{{route('client.posts')}}" class="tm-nav-link">
                    <i class="fas fa-home"></i>
                    Blog Home
                </a></li>
                <li class="tm-nav-item  active"><a href="{{route('client.posts.show',['slug'=>$blog['slug']])}}" class="tm-nav-link">
                    <i class="fas fa-pen"></i>
                    Single Post
                </a></li>
                <li class="tm-nav-item "><a href="{{route('client.about')}}" class="tm-nav-link">
                    <i class="fas fa-users"></i>
                    About Xtra
                </a></li>
                <li class="tm-nav-item"><a href="{{route('client.contact')}}" class="tm-nav-link">
                    <i class="far fa-comments"></i>
                    Contact Us
                </a></li>
            </ul>
        </nav>
        <div class="tm-mb-65">
            <a rel="nofollow" href="https://fb.com/templatemo" class="tm-social-link">
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
            ngoc bao
        </p>
    </div>
</header>
@endsection
@section('content')
<div class="container-fluid">
    <main class="tm-main">
        <!-- Search form -->
        <div class="row tm-row">
            <div class="col-12">
                <form method="GET" class="form-inline tm-mb-80 tm-search-form">                
                    <input class="form-control tm-search-input" name="query" type="text" placeholder="Search..." aria-label="Search">
                    <button class="tm-search-button" type="submit">
                        <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                    </button>                                
                </form>
            </div>                
        </div>            
        <div class="row tm-row">
            <div class="col-12">
                <hr class="tm-hr-primary tm-mb-55">
                <!-- Video player 1422x800 -->
                <img src="{{showImage('cover',$blog['cover'])}}" alt="" sizes="" srcset="">
            </div>
        </div>
        <div class="row tm-row">
            <div class="col-lg-8 tm-post-col">
                <div class="tm-post-full">                    
                    <div class="mb-4">
                        <h2 class="pt-2 tm-color-primary tm-post-title">{{$blog['title']}}</h2>
                        <p class="tm-mb-40">{{substr($blog['created_at'],0,-17)}} posted by {{$blog['user']['user_name']}}</p>
                        <?php echo $blog['content'] ?>
                        <span class="d-block text-right tm-color-primary">Creative . Design . Business</span>
                    </div>
                    
                    <!-- Comments -->
                    <div>
                        <hr class="tm-hr-primary tm-mb-45">
                        <div class="tm-comment tm-mb-45">
                           
                        <form action="" class="mb-5 tm-comment-form">
                            <h2 class="tm-color-primary tm-post-title mb-4">Your comment</h2>
                            <div class="mb-4">
                                <input class="form-control" name="name" type="text">
                            </div>
                            <div class="mb-4">
                                <input class="form-control" name="email" type="text">
                            </div>
                            <div class="mb-4">
                                <textarea class="form-control" name="message" rows="6"></textarea>
                            </div>
                            <div class="text-right">
                                <button class="tm-btn tm-btn-primary tm-btn-small">Submit</button>                        
                            </div>                                
                        </form>                          
                    </div>
                </div>
            </div>
        </div>
        <footer class="row tm-row">
            <div class="col-md-6 col-12 tm-color-gray">
                Design: <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-external-link">TemplateMo</a>
            </div>
            <div class="col-md-6 col-12 tm-color-gray tm-copyright">
                Copyright 2020 Xtra Blog Company Co. Ltd.
            </div>
        </footer>
    </main>
</div>
@endsection
    
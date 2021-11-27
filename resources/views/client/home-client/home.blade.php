@extends('client.layouts.master')

@section('title')
    home-page
@endsection

@section('header')
     <!-- Search form -->
    <div class="row">
        <div class="col-12">
            <form method="GET" class="form-inline tm-mb-80 tm-search-form">                
                <input class="form-control tm-search-input" name="query" type="text" placeholder="Search..." aria-label="Search">
                <button class="tm-search-button" type="submit" onclick="searchPost()">
                    <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                </button>                                
            </form>
        </div>                
    </div>          
@endsection

@section('content')
    <div class="row">
        @foreach ($blogs as $blog)
            <article class="col-12 col-md-6 tm-post">
                <hr class="tm-hr-primary">
                <a href="{{route('client.posts.show',['slug'=>$blog['slug']])}}" class="effect-lily tm-post-link tm-pt-60">
                    <div class="tm-post-link-inner" style="max-height: 500px;">
                        <img src="{{showImage('cover',$blog['cover'])}}" alt="Image" class="img-fluid" >                            
                    </div>
                    <span class="position-absolute tm-new-badge">New</span>
                    <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{$blog['title']}}</h2>
                </a>                    
            
                <div class="d-flex justify-content-between tm-pt-45">
                    <span class="tm-color-primary">{{substr($blog['created_at'],0,-17)}}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between" >
                    <span>by {{$blog['user']['user_name']}}</span>
                </div>
            </article>  
        @endforeach
    </div>   
    <div class="row tm-mt-100 tm-mb-75">
        <div class="tm-prev-next-wrapper">
            <a href="#" class="mb-2 tm-btn tm-btn-primary tm-prev-next disabled tm-mr-20">Prev</a>
            <a href="#" class="mb-2 tm-btn tm-btn-primary tm-prev-next">Next</a>
        </div>
        <div class="tm-paging-wrapper">
            <span class="d-inline-block mr-3">Page</span>
            <nav class="tm-paging-nav d-inline-block">
                <ul>
                    <li class="tm-paging-item active">
                        <a href="#" class="mb-2 tm-btn tm-paging-link">1</a>
                    </li>
                    <li class="tm-paging-item">
                        <a href="#" class="mb-2 tm-btn tm-paging-link">2</a>
                    </li>
                    <li class="tm-paging-item">
                        <a href="#" class="mb-2 tm-btn tm-paging-link">3</a>
                    </li>
                    <li class="tm-paging-item">
                        <a href="#" class="mb-2 tm-btn tm-paging-link">4</a>
                    </li>
                </ul>
            </nav>
        </div>                
    </div>   
@endsection

@section('footer')
    <footer class="row">
        <hr class="col-12">
        <div class="col-md-6 col-12 tm-color-gray">
            Design: <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-external-link">TemplateMo</a>
        </div>
        <div class="col-md-6 col-12 tm-color-gray tm-copyright">
            Copyright 2020 Xtra Blog Company Co. Ltd.
        </div>
    </footer>
@endsection

@section('css')
    @include('client.home-client.style')
@endsection

@section('js')
    @include('client.home-client.script')
@endsection


    
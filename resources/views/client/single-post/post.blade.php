
@extends('client.layouts.master')

@section('title')   
    {{$blog['title']}}
@endsection

@section('header')
     <!-- Search form -->
        <div class="col-12">
            <form method="GET" class="form-inline tm-mb-80 tm-search-form">                
                <input class="form-control tm-search-input" name="query" type="text" placeholder="Search..." aria-label="Search">
                <button class="tm-search-button" type="submit">
                    <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                </button>                                
            </form>
        </div>                
    </div>          
@endsection

@section('content')               
        <div class="row" style="display : flex; justify-content: center; text-align : center;">
            <img src="{{showImage('cover',$blog['cover'])}}" alt="" sizes="" srcset="" style="max-height: 300px;">
        </div>
        <div class="row">
            <div class="col-lg-12 tm-post-col">
                <div class="col-12">                    
                    <div class="mb-12">
                        <h2 class="pt-2 tm-color-primary">{{$blog['title']}}</h2>
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
@endsection

@section('footer')
    <footer class="row">
        <div class="col-md-12 col-12 tm-color-gray">
            Design: <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-external-link">TemplateMo</a>
        </div>
        <div class="col-md-12 col-12 tm-color-gray tm-copyright">
            Copyright 2020 Xtra Blog Company Co. Ltd.
        </div>
    </footer>
@endsection

@section('css')
    @include('client.single-post.style')
@endsection

@section('js')
    @include('client.single-post.script')
@endsection

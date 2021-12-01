
@extends('client.layouts.master')

@section('title')   
    {{$blog['title']}}
@endsection

@section('content')   
    <a href="{{route('client.posts')}}" id="button-home" style="height : 80px; width : 80px;">{{trans('blog.home')}}</a>           
        <div class="row" style="display : flex; justify-content: center; text-align : center;">
            <img src="{{showImage('cover',$blog['cover'])}}" alt="" sizes="" srcset="" style="max-height: 300px;">
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="col-6">                    
                    <div class="mb-12">
                        <h2 class="pt-2 tm-color-primary d-flex justify-content-center">{{$blog['title']}}</h2>
                        <p class="tm-mb-40 d-flex justify-content-center">{{changeTime(substr($blog['created_at'],0,-17))}} posted by @isset($blog['user']['user_name'])
                            {{$blog['user']['user_name']}}
                        @endisset </p>
                        <?php echo $blog['content'] ?>
                        <span class="d-block text-right tm-color-primary">Creative . Design . Business</span>
                    </div>
                    
                    <!-- Comments -->
                    <!-- Comments -->
                    <h2 class="tm-color-primary tm-post-title">Comments</h2>
                    <hr class="tm-hr-primary tm-mb-45">
                    <div id="comment">

                    </div>
                    <div>
                        <hr class="tm-hr-primary tm-mb-45">                           
                            <h2 class="tm-color-primary tm-post-title mb-4">Your comment</h2>
                            <div class="mb-4">
                                <input class="form-control" name="email" type="text" placeholder="email">
                            </div>
                            <div class="mb-4">
                                <input class="form-control" name="user_name" type="text" placeholder="user name">
                            </div>
                            <div class="mb-4">
                                <textarea class="form-control" name="comment_message" rows="6" id="comment_message"></textarea>
                            </div>
                            <div class="text-right">
                                <?php $blog_id = $blog['id']?>
                                <button class="tm-btn tm-btn-primary tm-btn-small" onclick="Commentable({{$blog_id}})">Submit</button>                        
                            </div>                                
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

    <script>
        // load comment 
        
    </script>
@endsection

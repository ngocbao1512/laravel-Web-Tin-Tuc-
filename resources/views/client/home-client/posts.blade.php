@foreach ($blogs as $key => $blog)
<article class="col-12 col-md-3">
    <a href="{{route('client.posts.show',['slug'=>$blog['slug']])}}" class="effect-lily tm-post-link tm-pt-60">
        <div class="tm-post-link-inner" style="max-height: 300px;">
            <img src="{{showImage('cover',$blog['cover'])}}" alt="Image" class="img-fluid" >                            
        </div>
        @if ($key < 7)
            <span class="position-absolute tm-new-badge">New</span>
        @endif
        <h2 class="tm-pt-30 tm-color-primary">{{$blog['title']}}</h2>
    </a>                    

    <div class="d-flex justify-content-between">
        <span class="tm-color-primary">{{substr($blog['created_at'],0,-17)}}</span>
    </div>
    <hr>
    <div class="d-flex justify-content-between" >
        <span>by {{$blog['user']['user_name']}}</span>
    </div>
</article>  
@endforeach
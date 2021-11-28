@isset($comments)
    @foreach($comments as $key => $comment)
    <div>
        <div class="tm-comment tm-mb-45">
            <figure class="tm-comment-figure">
                <figcaption class="tm-color-primary text-center">{{$comment->customer->name}}</figcaption>
            </figure>
            <div>
                <p>
                    {{$comment->content}}
                </p>
                <div class="d-flex justify-content-between">
                    <span class="tm-color-primary">{{$comment->created_at}}</span>
                </div>                                                 
            </div>                                
        </div>
    </div>
    @endforeach
@endisset
    
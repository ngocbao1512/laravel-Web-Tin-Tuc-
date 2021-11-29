@isset($blog)
    @if($blog->is_verifited == 1)
    <?php $link = route('client.posts.show',['slug'=>$blog->slug]);?>
    <button class="btn btn-primary"
    onclick="show_blog('{{$link}}');"
    >
    <i class="fas fa-eye"></i>
    </button>
    @endif
@endisset
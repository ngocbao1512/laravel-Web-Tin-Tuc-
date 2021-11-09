@extends('admin.layouts.master')

@section('title')
    All Post
@endsection

@section('css')
    
@endsection


@section('avatar')
   
@endsection


@section('header')
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="index3.html" class="nav-link">Home</a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">Contact</a>
  </li>
</ul>
@endsection


@section('sidebar')
    <li class="nav-item menu-open">
        <a href="#" class="nav-link active">
            <p>
                Post
            </p>
        </a>
        
@endsection


@section('content')
    
@endsection

@section('js')
    
<script>
  $(document).ready(function() {
     console.log('ok');
     $.ajaxSetup({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
     });


     $('#mainbutton').click(function(e) {
      console.log('ok');
       e.preventDefault();
       var title = $('#title-blog').val();
       var content = $('#content-blog').val();
       var publish_at = $('#publish-at').val();
       var image = $('#image').val();
       var url = "{{ route('admin.blogs.store') }}";

       $.ajax(url, {
             type: 'POST',
             data: {
             title: title,
             content: content,
             publish_at: publish_at,
             image: image,
             },
             success:function(data) {
                 console.log('success');
             },
             error:function(data) {
                 console.log('some thing went wrong');
             }
         });
     });
 });
</script>
@endsection
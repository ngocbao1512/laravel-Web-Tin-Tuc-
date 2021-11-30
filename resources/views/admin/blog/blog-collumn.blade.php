<?php
   $blogId = !isset($blog) ? 0 : $blog->id;
   $title = !isset($blog) ? '' : $blog->title;
   $content = !isset($blog) ? '' : $blog->content;
   $author = !isset($blog) ? 'auth has been delete' : $blog->user->user_name;
   $status = ($blog->is_verifited == 0) ? 'wait verify' : 'verifited';
   $publishDate = !isset($blog) ? '' : $blog->publish_date;
   $cover = !isset($blog) ? '' : $blog->cover;
?>
<tr class="odd" data-id = "{{$blogId}}" id="{{$blogId}}">
  <td class="dtr-control sorting_1" tabindex="0"></td>
  <td>{{$title}}</td>
  <td>
    <img src="{{showImage('cover',$cover)}}" alt="" sizes="" srcset="" style="max-height: 100px;">
   </td>
  <td>{{$author}}</td>
  <td>{{$publishDate}}</td>
  <td>
    <label class="switch">
      <button type="button" 
      @if ($blog->is_verifited == 1)  checked @endif 
      data-blog_id = "{{$blog->id}}" 
      onclick="verify_blog(this)"
      >
      </button>
      <span class="slider"></span>
    </label>
   </td>
  <td>
    <button type="button" class="btn btn-warning"
    data-toggle="modal"
    data-target="#modal-edit-blog"
    data-blog_id = "{{$blog->id}}"
    onclick="loadBlogEdit(this)"
    >
      <span><i class="fas fa-edit"></i></span>
    </button>
    <button class="btn btn-danger confirm-delete" 
      data-toggle="modal"
      data-blog_id="{{$blog->id}}"
      onclick="deleteBlog(this);"
      >
      <i class="far fa-trash-alt tm-product-delete-icon"></i>
    </button>
    <?php $link = route('client.posts.show',['slug'=>$blog->slug]);?>
    <button class="btn btn-info inline-block d-none"
      onclick="show_blog('{{$link}}');"
     id="button-view-blog-{{$blog->id}}"
     >
      <i class="fas fa-eye"></i>
    </button>

   
  </td>
</tr>
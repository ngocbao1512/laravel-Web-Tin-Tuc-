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
    <button type="button" class="btn btn-default"
    data-toggle="modal"
    data-target="#modal-edit-blog"
    data-blog_id = "{{$blog->id}}"
    onclick="loadBlogEdit(this)"
    >
      <span><i class="fas fa-edit"></i></span>
    </button>
    <button class="btn btn-primary confirm-delete" 
      style="background-color: #50697f;"
      data-toggle="modal"
      data-blog_id="{{$blog->id}}"
      onclick="deleteBlog(this);"
      >
      <i class="far fa-trash-alt tm-product-delete-icon"></i>
    </button>
  </td>
</tr>
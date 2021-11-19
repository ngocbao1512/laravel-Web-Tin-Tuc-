<?php
   $blogId = !isset($blog) ? 0 : $blog->id;
   $title = !isset($blog) ? '' : $blog->title;
   $content = !isset($blog) ? '' : $blog->content;
   $author = !isset($blog) ? '' : $blog->created_user_id;
   $status = ($blog->is_verifited == 0) ? 'wait verify' : 'verifited';
   $publishDate = !isset($blog) ? '' : $blog->publish_date;
   $cover = !isset($blog) ? '' : $blog->cover;
?>
<tr class="odd" data-id = "{{$blogId}}" id="{{$blogId}}">
  <td class="dtr-control sorting_1" tabindex="0"></td>
  <td>{{$title}}</td>
  <td>{{$blog->content}}</td>
  <td>{{$author}}</td>
  <td>{{$publishDate}}</td>
  <td>{{$status}}</td>
  <td>
    <button type="button" class="btn btn-primary"
    data-toggle="modal"
    data-target="#modal-edit-blog"
    data-blog_id = "{{$blogId}}"
    onclick="loadBlogEdit(this)"
    >
      <span> <i class="fas fa-blog-edit"></i></span>
    </button>
    <button class="btn btn-primary confirm-delete" 
      style="background-color: #50697f;"
      data-toggle="modal"
      data-blog_id="{{$blogId}}"
      onclick="deleteBlog(this);"
      >
      <i class="far fa-trash-alt tm-product-delete-icon"></i>
    </button>
  </td>
</tr>
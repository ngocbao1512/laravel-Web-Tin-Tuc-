<?php
   $action = !isset($blog) ? 'create' : 'edit';
   $blogId = !isset($blog) ? 0 : $blog->id;
   $title = !isset($blog) ? '' : $blog->title;
   $content = !isset($blog) ? '' : $blog->content;
   $author = !isset($blog) ? '' : $blog->user->name;
   $status = !isset($blog) ? 0 : $blog->is_verifited;
   $datePulish = !isset($blog) ? '' : $blog->publish_date;
   $password = !isset($blog) ? '' : $blog->password;
   $cover = !isset($blog) ? '' : $blog->cover;
?>
<div class="modal-header">
   <h4>
       @if($action == 'create')
           {{trans('blog.create-.blog')}}
       @else
       {{trans('blog.edit-.blog')}}
       @endif
   </h4>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">×</span>
   </button>
</div>
<div class="modal-body">
   <div class="row" >
       <div class="col-12" style="min-height: 70vh">
           <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
               <form class="tm-edit-product-form" enctype="multipart/form-data">
                   <div class="row tm-edit-product-row">
                       <div class="col-xl-6 col-lg-6 col-md-12">
                           <div class="form-group">
                               <div class="row">
                                   <div class="col-xs-12 col-sm-6">
                                       <label for="title">
                                           <b>
                                               {{trans('blog.title')}}
                                           </b>
                                       </label>
                                       <input id="title-{{$blogId}}" name="title" type="text"  placeholder="{{trans('blog.title')}}" class="form-control validate" required/>
                                   </div>
                               </div>
                           </div>
                           <hr>
                           <div class="form-group">
                               <label for="content">{{trans('blog.content')}}</label>
                               <textarea class="form-control validate" style="resize: none" class="form-control" cols="30" rows="20" placeholder="{{trans('blog.content')}}" name="content" id="content-{{$blogId}}"></textarea>
                           </div>
                       </div>
                       <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
  
                           <div class="tm-product-img-dummy mx-auto" style=" background-color : rgb(243, 243, 243); min-height : 20vh;
                           border-radius : 10px; display: flex; justify-content : center; text-align : center;"
                           onclick="document.getElementById('input-avatar-{{$blogId}}').click();">
                               <img id="preview-avatar-{{$blogId}}"
                               src="{{showImage('cover',$cover)}}"
                               alt="" style="max-width: 100%; max-height : 30vh;"
                               />
 
                               <div>
                                   <input id="input-avatar-{{$blogId}}" type="file" style="display:none;" name="avatar" required target-id="#preview-avatar-{{$blogId}}"
                                       onchange="initReadImage(this);"
                                   />
                               </div>
                           </div>
                           <hr>
                           <div class="form-group">
                               <label>Date Publish:</label>
                                 <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                     <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" id="date_publish-{{$blogId}}">
                                     <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                         <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                     </div>
                                 </div>
                             </div>
                           @if($action == 'update')
                               <div class="form-group">
                                   <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                           <label for="public">
                                               {{trans('blog.public')}}
                                           </label>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                           <label class="switch">
                                               <input type="checkbox" name="is_verifited" @if ($status == 1)
                                                   checked
                                               @endif>
                                               <span class="slider round"></span>
                                           </label>  
                                       </div>
                                   </div>
                               </div>
                           @endif
                          
                       </div>
                       <div class="col-12">
                           @if ($action =='create')
                               <button  type="button" class="btn btn-primary btn-block text-uppercase "
                                   style="color:white;background-color:rgb(24 89 230);"
                                   onclick="saveData(this,'{{trans('blog.do_you_want.create')}}')"
                               >
                               {{trans('blog.create-.blog')}} 
                               </button>
                           @else
                               <button  type="button" class="btn btn-primary btn-block text-uppercase "
                                   style="color:white;background-color:rgb(24 89 230);"
                                   onclick="saveData(this,'{{trans('blog.do_you_want.update')}}',{{$blogId}})"
                               >
                               {{trans('blog.edit-.blog')}}
                               </button>
                           @endif
                       </div>
                   </div>
               </form>
           </div>
       </div>        
   </div>
</div>
 

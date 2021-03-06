@extends('admin.layouts.master')
 
@section('title')
   {{ trans('blog.all_blog') }}
@endsection
 
 
@section('avata')
https://img.thuthuatphanmem.vn/uploads/2018/11/06/anh-songoku-be-dep_044039827.jpg
@endsection
 
 
@section('header')
<?php
$language = session('website_language', config('app.locale'));
?>
 <div class="col-12">
   <div class="row">
     <div class="col-10">
       <ul class="navbar-nav">
         <li class="nav-item">
           <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
           <a href="" class="nav-link">{{ trans('user.home') }}</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
           <a href="" class="nav-link">{{ trans('user.contact') }}</a>
         </li>
       </ul>
     </div>
     <div class="col-2">
       <div id="lang-switch">
         <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Vietnam.svg/1024px-Flag_of_Vietnam.svg.png" class="vn  @if ($language == 'vi') active-flag @endif" style="height: 25px; width: 50px; margin: 0;" onclick="changeLanguage(this,'vi')">
         <img src="https://cdn3.iconfinder.com/data/icons/finalflags/256/United-Kingdom-flag.png" class="en @if ($language == 'en') active-flag @endif" style="height: 25px; width: 50px; margin: 0;" onclick="changeLanguage(this,'en')">
       </div>
     </div>
   </div>
 </div>
 @endsection
 
 
@section('sidebar')
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
 <li class="nav-item menu-open">
   <a href="{{route('admin.blogs')}}" class="nav-link  active">
       <p>
           {{trans('user.post')}}
       </p>
   </a>
 </li>
 <li class="nav-item menu-open">
   <a href="{{route('admin.users')}}" class="nav-link">
       <p>
           {{trans('user.user')}}
       </p>
   </a>
 </li>
</ul>
  
@endsection
 
 
@section('content')
{{-- SECTION CREATE USER --}}
<div class="modal" id="modal-create-blog" aria-modal="true" role="dialog" >
 <div class="modal-dialog" style="min-width: 85vw;">
   <div class="modal-content" style="background-color: rgb(255 255 255 / 93%);" id="modal-create-blog-content">
       @include('admin.blog.blog-form')
   </div>
 </div>
</div>
{{-- END SECTION --}}
 
{{-- SECTION EDIT USER --}}
<div class="modal modal-bootstrap" id="modal-edit-blog" role="dialog" tabindex="-1">
 <div class="modal-dialog" style="min-width: 85vw;">
   <div class="modal-content" style="background-color: rgb(255 255 255 / 93%);" id="modal-edit-blog-content">
   
   </div>
 </div>
</div>
{{-- END SECTION --}}

{{-- SECTION SHOW IFRAME BLOG --}}
  <div class="modal" id="modal-show-iframe" aria-modal="true" role="dialog" >
    <div class="modal-dialog" style="min-width: 85vw;">
      <div class="modal-content" style="background-color: rgb(255 255 255 / 93%);" id="modal-show-iframe-content">
      </div>
    </div>
  </div>
{{-- END SECTION --}}
 
   <div class="card">
     <div class="card-header">
       <h3 class="card-title">{{trans('blog.all_blog')}}</h3>
     </div>
     <div class="card-body">
   
     <div class="col-sm-12">
       <div id="example1_filter" class="dataTables_filter">
         <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
           <div class="row">
            @can('create_blog')
             <div class="col-sm-12 col-md-2 float-right">
               <div class="dt-buttons btn-group flex-wrap">
                 <button type="button"
                 class="btn btn-success"
                 data-toggle="modal"
                 data-target="#modal-create-blog"
                 >
                   <span> <i class="fas fa-user-plus"></i> {{trans('blog.add_blog')}}</span>
                 </button>
               </div>
             </div>
             @endcan
           </div>
           <br>
         </div>
       </div>
     </div>
          
     <div class="col-sm-12">
       <div class="row">
         <div class="container" id="loading" style="display:none">
           <div class="ring"></div>
           <div class="ring"></div>
           <div class="ring"></div>
         </div>
         <table id="dataTable" class="table table-bordered table-striped dtr-inline" data-datatable="table" aria-describedby="example1_info" >
           <thead>
             <tr>
               <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending"
               aria-label="Rendering engine: activate to sort column descending">{{trans('general.index')}}
               </th>
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                 {{trans('blog.title')}}
               </th>
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                {{trans('blog.cover')}}
              </th>
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                 {{trans('blog.author')}}
               </th>
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                 {{trans('blog.publish_date')}}
               </th>
              
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                 {{trans('blog.status')}}
               </th>
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                 <center><i class="fas fa-user-edit"></i></center>
               </th>
 
             </tr>
           </thead>
           <tbody>
             @isset($blogs)
               @foreach ($blogs as $blog)
                    <tr class="odd" data-id = "{{$blog->id}}" id="{{$blog->id}}">
                      <td class="dtr-control sorting_1" tabindex="0"></td>
                      <td>{{$blog->title}}</td>
                      <td>
                       <img src="{{showImage('cover',$blog->cover)}}" alt="" sizes="" srcset="" style="max-height: 100px;">
                      </td>
                      <td>{{$blog->author_name}}</td>
                      <td>{{substr($blog->publish_date,0,10)}} </td>
                     <!-- button verify publish !-->  
                      <td>
                        @can('verify_blog')
                          <label class="switch">
                              <button type="button" 
                              @if ($blog->is_verifited == 1)  checked @endif 
                              data-blog_id = "{{$blog->id}}" 
                              onclick="verify_blog(this)"
                              class="@if ($blog->is_verifited == 1) active  @endif"
                              >
                              </button>
                              <span class="slider"></span>
                          </label>
                        @else
                          @if ($blog->is_verifited == 1)
                            verifited
                          @else
                            wait verify...  
                          @endif
                        @endcan
                      
                     </td>
                      <td style="min-width:180px;">
                       @can('update_blog')
                        <button type="button" class="btn btn-warning"
                        data-toggle="modal"
                        data-target="#modal-edit-blog"
                        data-blog_id = "{{$blog->id}}"
                        onclick="loadBlogEdit(this)"
                        >
                          <span><i class="fas fa-edit"></i></span>
                        </button>
                       @endcan
                       
                       @can('delete_blog')
                        <button class="btn btn-danger confirm-delete" 
                          data-toggle="modal"
                          data-blog_id="{{$blog->id}}"
                          onclick="deleteBlog(this);"
                          >
                          <i class="far fa-trash-alt tm-product-delete-icon"></i>
                        </button>
                       @endcan
                       <?php $link = route('client.posts.show',['slug'=>$blog->slug]);?>
                       <button class="btn btn-info @if($blog->is_verifited == 0 ) d-none @endif"
                       onclick="show_blog('{{$link}}');"
                       id="button-view-blog-{{$blog->id}}"
                       >
                         <i class="fas fa-eye"></i>
                       </button>
                      </td>
                    </tr>
                  
               @endforeach              
             @endisset
           </tbody>
         </table>
       </div>
     </div>
   </div> 
            
@endsection
 
 
@section('footer')
 <div class="float-right d-none d-sm-block">
   <b>Version</b> 3.2.0-rc
 </div>
 <strong>Copyright ?? 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
@endsection
 
@section('js')
 @include('admin.blog.script')
<script>
 $(document).ready(function() {
 });
</script>
 
@endsection


@section('css')
    @include('admin.blog.style')
@endsection
 

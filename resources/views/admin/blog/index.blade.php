@extends('admin.layouts.master')

@section('title')
    All Blog
@endsection

@section('css')
    @include('admin.blog.style')
@endsection


@section('avata')
https://img.thuthuatphanmem.vn/uploads/2018/11/06/anh-songoku-be-dep_044039827.jpg
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
    </li>
    <li class="nav-item menu-open">
      <a href="{{route('admin.users')}}" class="nav-link">
          <p>
              User
          </p>
      </a>
  </li>
        
@endsection


@section('content')

    <div class="modal" id="modal-create-blog" aria-modal="true" role="dialog" >
      <div class="modal-dialog" style="min-width: 85vw;">
        <div class="modal-content" style="background-color: rgb(206 236 234 / 93%);" id="modal-create-blog-content">
            @include('admin.blog.blog-form')
        </div>
      </div>
    </div>
    {{-- END SECTION --}}

    {{-- SECTION EDIT USER --}}
    <div class="modal" id="modal-edit-blog" aria-modal="true" role="dialog" >
      <div class="modal-dialog" style="min-width: 85vw;">
        <div class="modal-content" style="background-color: rgb(206 236 234 / 93%);" id="modal-edit-blog-content">
        
        </div>
      </div>
    </div>
    {{-- END SECTION --}}

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">DataTable Of All Blog</h3>
      </div>
      <div class="card-body">
        
     
        <div class="col-sm-12">
          <div id="example1_filter" class="dataTables_filter">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="dt-buttons btn-group flex-wrap">
                    <button type="button"
                    class="btn btn-primary" 
                    data-toggle="modal"
                    data-target="#modal-create-blog"
                    >
                      <span> <i class="fas fa-user-plus"></i> add blog</span>
                    </button>
                  </div>
                  <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1">
                  </label>
                </div>
                
              </div>
            </div>
          </div>
        </div>
            
      <div class="col-sm-12">
        <div class="row">
          <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
            <thead>
              <tr>
                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" 
                aria-label="Rendering engine: activate to sort column descending">
                  title
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                  Content
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                  Author
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                  Status
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                  Date Publish
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                  More Infomation <i class="fas fa-angle-double-right"></i>
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                  <center><i class="fas fa-user-edit"></i></center>
                </th>
              </tr>
            </thead>
            <tbody>
              @isset($blogs)
                  @foreach ($blogs as $blog)
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{$blog->title}}</td>
                    <td>{{$blog->content}}</td>
                    <td>{{$blog->user->name}}</td>
                    <td>
                      @if ($blog->is_verifited==1)
                        verifited
                      @else
                        wait verify....
                      @endif
                    </td>
                    <td>{{$blog->publish_date}}</td>
                    <td><a href="#"><i class="fas fa-caret-right"></i></a></td>
                    <td>
                      <button type="button" class="btn btn-primary"
                      data-toggle="modal" 
                      data-target="#modal-edit-blog"
                      data-userid = "{{$blog->id}}"
                      onclick="loadUserEdit('{{route('admin.blogs.find')}}','{{$blog->id}}')"
                      >
                        <span> <i class="fas fa-user-edit"></i></span>
                      </button>
                      <button class="btn-danger"><i class="fas fa-user-slash"></i></button>
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

@section('modalscreatealert')
<div class="modal fade" id="modal-primary" style="display: none;" aria-hidden="true" >
  <div class="modal-dialog" style="min-width: 85vw;">
    <div class="modal-content" style="background-color: rgb(206 236 234 / 93%);">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection

@section('footer')
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0-rc
  </div>
  <strong>Copyright © 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
@endsection

@section('js')
    @include('admin.blog.script')
@endsection


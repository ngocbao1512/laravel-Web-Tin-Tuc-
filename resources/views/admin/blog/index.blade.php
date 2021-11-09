@extends('admin.layouts.master')

@section('title')
    All Blog
@endsection

@section('css')
    
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
        <a href="#" class="nav-link">
            <p>
                Post
            </p>
        </a>
    </li>
    <li class="nav-item menu-open">
      <a href="#" class="nav-link active">
          <p>
              Blog
          </p>
      </a>
  </li>
        
@endsection


@section('content')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">DataTable Of All Blog</h3>
      </div>
      <div class="card-body">
        
     
      <div class="col-sm-12">
        <div id="example1_filter" class="dataTables_filter">
          <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dt-buttons btn-group flex-wrap">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
              <span> <i class="fas fa-user-plus"></i> add blog</span>
            </button>
            
          </div>
          <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1">
          </label>
        </div>
        
      </div>
            
      <div class="col-sm-12">
        <div class="row">
          <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
            <thead>
              <tr>
                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" 
                aria-label="Rendering engine: activate to sort column descending">Name
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                  Email
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                  User Name
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                  Role
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
              <tr class="odd">
                <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                <td>Firefox 1.0</td>
                <td>Win 98+ / OSX.2+</td>
                <td>1.7</td>
                <td>A</td>
                <td>
                  <button><i class="fas fa-user-edit"></i></button>
                  <button class="btn-danger"><i class="fas fa-user-slash"></i></button>
                </td>
                
              </tr>
              <tr class="even">
                <td class="sorting_1 dtr-control">Gecko</td>
                <td>Camino 1.5</td>
                <td>OSX.3+</td>
                <td>1.8</td>
                <td>A</td>
                <td>
                  <button><i class="fas fa-user-edit"></i></button>
                  <button class="btn-danger"><i class="fas fa-user-slash"></i></button>
                </td>
              </tr>
            </tbody>
            
          </table>
        </div>
      </div>
    </div>
     
    </div>
              
@endsection

@section('modalsalert')
<div class="modal fade" id="modal-primary" style="display: none;" aria-hidden="true">
  <div class="modal-dialog" style="min-width: 85vw;">
    <div class="modal-content bg-primary" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        @include('partials.formblog')
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


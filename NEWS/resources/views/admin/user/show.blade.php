@extends('admin.layouts.master')

@section('title')
    {{$user->username}}
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
    <a href="#" class="nav-link">
        <p>
            Post
        </p>
    </a>
  </li>
  <li class="nav-item menu-open">
  <a href="#" class="nav-link active">
      <p>
          USER
      </p>
  </a>
  </li>
@endsection


@section('content')
    {{$user->username}}
@endsection

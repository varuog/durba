@extends('layouts.admin')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item">User List</li>
              <li class="breadcrumb-item active">{{$user->full_name}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-primary">
            </div>
          <!-- /.col -->
          </div>

          <div class="col-md-8">
            <div class="card card-primary">
            </div>
          <!-- /.col -->
          </div>
          
      </div><!-- /.container-fluid -->
    </section>
@endsection
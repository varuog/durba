@extends('layouts.admin')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">User List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            {{-- <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Quick Example</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <!-- <label for="exampleInputEmail1">Email address</label> -->
                          <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" name="email" value="" placeholder="Enter email">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <!-- <label for="exampleInputEmail1">Email address</label> -->
                          <input type="text" class="form-control form-control-sm" id="exampleInputEmail1" name="email" value="" placeholder="Enter name">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <!-- <label for="exampleInputEmail1">Email address</label> -->
                          <input type="text" class="form-control form-control-sm" id="exampleInputEmail1" name="mobile" value="" placeholder="Enter mobile">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <!-- select -->
                        <div class="form-group">
                          <!-- <label>Select</label> -->
                          <select class="form-control form-control-sm">
                            <option value=''>Select Role</option>
                            <option value=''>option 2</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                  </div>
                </form>
            </div> --}}
            <!-- / Filter -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customers</h3>
                <button type="button" class="btn btn-default float-right" data-toggle="modal" data-target="#modal-lg">
                  Add New
                </button>
              </div>
              
              <!-- /.card-header -->
             
                @if(count($users) > 0)
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Role</th>
                        <th style="width: 40px">Active</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                      <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->full_name}}</td>
                        <td>
                            {{$user->email}}
                            <span class="badge {{(is_null($user->email_verified_at)) ? 'bg-danger' : 'bg-success'}}"> 
                              <i class="fa {{(is_null($user->email_verified_at)) ? 'fa-exclamation-circle' : 'fa-check-circle'}}" title="{{(is_null($user->email_verified_at)) ? 'Not verified' : 'Verified'}}"></i>
                            </span>
                        </td>
                        <td>
                            {{$user->mobile ?? 'N/A'}}
                            <span class="badge {{(is_null($user->mobile_verified_at)) ? 'bg-danger' : 'bg-success'}}"> 
                              <i class="fa {{(is_null($user->mobile_verified_at)) ? 'fa-exclamation-circle' : 'fa-check-circle'}}" title="{{(is_null($user->mobile_verified_at)) ? 'Not verified' : 'Verified'}}"></i>
                            </span>
                        </td>
                         <td>
                          @foreach($user->roles as $role) 
                            <span class="badge bg-success">{{Str::title($role->name)}}</span>
                          @endforeach
                        </td>
                        <td>
                          <span class="badge {{($user->is_active)? 'bg-success' : 'bg-danger'}}">{{($user->is_active)? 'Active' : 'Inactive'}}</span>
                        </td>
                        <td>
                          <!-- Extra Group -->
                            <a class="btn btn-success btn-flat" href="{{route('admin.users.show', ['user' => $user])}}"><i class="fa fa-eye" title="View Details"></i></a>                            
                            {{-- <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#list{{ $user->id }}"><i class="fa fa-eye" title="View Details"></i></a> --}}
                            <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#assign-role-{{ $user->id }}"><i class="fa fa-eye" title="Assign Role"></i></a>
                            <a class="btn btn-primary btn-flat" data-toggle="modal" data-target="#editlist{{ $user->id }}"><i class="fa fa-edit" title="Edit"></i></a>
                            <a class="btn btn-danger btn-flat" href=""><i class="fa fa-trash" title="Delete"></i></a>
                          <!-- /Extra Group -->
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                @else
                <div class="card-body">
                  <div class="callout callout-info">
                    <h5>Ooops!</h5>

                    <p>Nothing can be found</p>
                  </div>
                </div>
                @endif

                <!-- Card Footer -->
                <div class="card-footer">
                  <nav aria-label="Contacts Page Navigation">
                    {{$users->links()}}
                  </nav>
                </div>
                <!-- /Card Footer -->
            
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->

      @foreach($users as $userr)
      <!-- User show -->
      {{-- <div class="modal fade" id="list{{ $userr->id }}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Customer Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                         <label for="exampleInputEmail1">Name</label>
                         <p>{{ $userr->first_name }} {{ $userr->last_name }}</p>                        
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label for="exampleInputEmail1">Email address</label>
                         <p>{{ $userr->email }}</p>                        
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label for="exampleInputEmail1">Mobile</label>
                         <p>{{ $userr->mobile }}</p>                        
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                       <p>{{ $userr->status }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> --}}
       <!-- /User show -->


         <!-- Assign Role show -->
      <div class="modal fade" id="assign-role-{{ $userr->id }}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Assign Roles</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{route('admin.users.assign-role', ['user' => $userr->id])}}"}>
                <div class="card-body">
                  <div class="row">
                    @foreach($allRoles as $role)
                      <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="roles_id[]" value="{{$role->id}}" {{$userr->isA($role->name) ? 'checked' : ''}}>
                              <label class="form-check-label">{{$role->title}}</label>
                            </div>
                        </div>
                      </div>
                     @endforeach
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          @csrf
                          <button type="submit" class="btn btn-primary">Assign</button>                        
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
       <!-- /Assign Role -->
      @endforeach
    </section>
@endsection
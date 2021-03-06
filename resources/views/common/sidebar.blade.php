 <!-- Brand Logo -->
 <a href="{{route('admin.dashboard')}}" class="brand-link">
   <img src="{{asset('images/logo.png')}}" alt="{{Str::title(config('app.name'))}} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
   <span class="brand-text font-weight-light">{{Str::title(config('app.name'))}}</span>
 </a>

 <!-- Sidebar -->
 <div class="sidebar">
   <!-- Sidebar user panel (optional) -->
   <div class="user-panel mt-3 pb-3 mb-3 d-flex">
     <div class="image">
       <img src="{{auth()->user()->profile_picture}}" class="img-circle elevation-2" alt="User Image">
     </div>
     <div class="info">
       <a href="#" class="d-block">{{Str::title(auth()->user()->full_name)}}</a>
     </div>
   </div>

   <!-- SidebarSearch Form -->
   <div class="form-inline">
     <div class="input-group" data-widget="sidebar-search">
       <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
       <div class="input-group-append">
         <button class="btn btn-sidebar">
           <i class="fas fa-search fa-fw"></i>
         </button>
       </div>
     </div>
   </div>

   <!-- Sidebar Menu -->
   <nav class="mt-2">
     <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
       <li class="nav-item">
         <a href="{{route('admin.dashboard')}}" class="nav-link">
           <i class="nav-icon fas fa-tachometer-alt"></i>
           <p>
             Dashboard
             <!-- <span class="right badge badge-danger">New</span> -->
           </p>
         </a>
       </li>
       <li class="nav-header">USER MANAGEMENT</li>
       <li class="nav-item menu-open">
         <a href="#" class="nav-link active">
           <i class="nav-icon fas fa-tachometer-alt"></i>
           <p>
             User
             <i class="right fas fa-angle-left"></i>
           </p>
         </a>
         <!-- User Module -->
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{route('admin.users.create')}}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>Add User</p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{route('admin.users.index')}}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>Search User</p>
             </a>
           </li>
         </ul>
         <!-- /User Module -->
       </li>

       <li class="nav-item menu-open">
         <a href="#" class="nav-link active">
           <i class="nav-icon fas fa-tachometer-alt"></i>
           <p>
             Roles & Ability
             <i class="right fas fa-angle-left"></i>
           </p>
         </a>

         <!-- User Module -->
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{route('admin.users.create')}}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>Add Role</p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{route('admin.users.index')}}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>Search Role</p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{route('admin.users.index')}}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>Search Ability</p>
             </a>
           </li>
         </ul>
         <!-- /User Module -->

         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{route('admin.category.index')}}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>Category</p>
             </a>
           </li>
         </ul>
       </li>
       <!-- /User Module -->
       </li>

       <!-- /User Module -->
       </li>
       <li class="nav-header">CMS MANAGEMENT</li>
       <li class="nav-item menu-open">
         <a href="#" class="nav-link active">
           <i class="nav-icon fas fa-tachometer-alt"></i>
           <p>
             CMS Pages
             <i class="right fas fa-angle-left"></i>
           </p>
         </a>
         <!-- User Module -->
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{route('admin.cms.index')}}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>CMS Page List</p>
             </a>
           </li>
         </ul>
         <!-- /User Module -->
       </li>

     </ul>
   </nav>
   <!-- /.sidebar-menu -->
 </div>
 <!-- /.sidebar -->
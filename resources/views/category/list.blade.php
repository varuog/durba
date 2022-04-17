@extends('layouts.admin')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Category List</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Category List</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Categories</h3>
          </div>
          <!-- /.card-header -->

          @if(count($productCategories) > 0)
          <div class="card-body p-0">
            <div id="category-dynamic-tree"></div>
          </div>
          @else
          <div class="card-body">
            <div class="callout callout-info">
              <h5>Ooops!</h5>

              <p>Nothing can be found</p>
            </div>
          </div>
          @endif


          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Category Details</h3>
          </div>
          <!-- /.card-header -->

          @if(count($productCategories) > 0)
          <div class="card-body p-0">
            <!-- <div id="category-tree"></div> -->


            @foreach($flatProductCategories as $category)
            <div class="collapse categoryDetails" id="category-{{$category['id']}}">
              <div class="row">
              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#category-delete-{{$category['id']}}">
Delete
</button>
                <div class="col-md-12">
                  @include('category.update', ['category' => $category])
                </div>  
              </div>
            </div>

            @include('common.delete-confirmation'
                    , ['target' => "category-delete-{$category['id']}", 'action' =>route('admin.category.destroy', ['category' =>$category])])
            @endforeach

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
          <!-- <div class="card-footer">
                      <nav aria-label="Contacts Page Navigation">
                      </nav>
                    </div> -->
          <!-- /Card Footer -->

          <!-- /.card-body -->

        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->


    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection

@section('script')
<script>
  $(function() {
    $('#category-tree').treeview({
      enableLinks: true,
      data: {!!json_encode($bootstrapCategories) !!},
      onNodeSelected: function(event, data) {
        // Your logic goes here
        console.log(data);
      }
    });

    //$('#category-tree').treeview('collapseAll', { silent: true });

  });

  $("#category-dynamic-tree").tree({
      data: {!!json_encode($categories) !!},
      autoOpen: true,
      dragAndDrop: true
    })
    .on(
      'tree.move',
      function(event) {
        console.log('moved_node', event.move_info.moved_node);
        console.log('target_node', event.move_info.target_node);
        console.log('position', event.move_info.position);
        console.log('previous_parent', event.move_info.previous_parent);
      }
    ).on(
      'tree.dblclick',
      function(event) {
        // event.node is the clicked node
        console.log(event.node);
        $('.categoryDetails').each(function(index, elem) {
          //console.log(elem);
          $(elem).collapse('hide');
        })
        $('#category-' + event.node.id).collapse('toggle');
      }
    );
</script>
@endsection
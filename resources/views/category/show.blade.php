@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>E-commerce</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                 <a href="{{route('admin.products.index')}}">Products</a>
              </li>
              @foreach($product->categories as $category)
               <li class="breadcrumb-item">
                 <a href="{{route('admin.products.index', ['category_id' => $category->id])}}">{{Str::title($category->name)}}</a>
                </li>
              @endforeach
              <li class="breadcrumb-item active">{{$product->name}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">{{$product->name}}</h3>
              <div class="col-12">
                <img src="{{$product->erp_medias[0]}}" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                @foreach($product->erp_medias as $media)
                  <div class="product-image-thumb {{$loop->first ? 'active' : ''}}"><img src="{{$media}}" alt="Product Image"></div>
                @endforeach
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">{{$product->name}}</h3>
              <p>{{$product->description}}</p>

              <hr>

              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                    {{$product->listing_price}} {{config('blueprintecom.product.currency')}}
                </h2>
                <h4 class="mt-0">
                  <small>Original Price: {{$product->original_price}} {{config('blueprintecom.product.currency')}}</small>
                </h4>
              </div>
              
              <hr>

              <!-- Properties -->
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product Properties</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Property</th>
                      <th>Value</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($product->productAttributes as $attribute)
                      <tr>
                        <td>{{$attribute->productAttributeType->name}}</td>
                        <td>{{$attribute->attribute_value}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

              <!-- <h4>Available Colors</h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center active">
                  <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked="">
                  Green
                  <br>
                  <i class="fas fa-circle fa-2x text-green"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a2" autocomplete="off">
                  Blue
                  <br>
                  <i class="fas fa-circle fa-2x text-blue"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a3" autocomplete="off">
                  Purple
                  <br>
                  <i class="fas fa-circle fa-2x text-purple"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a4" autocomplete="off">
                  Red
                  <br>
                  <i class="fas fa-circle fa-2x text-red"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a5" autocomplete="off">
                  Orange
                  <br>
                  <i class="fas fa-circle fa-2x text-orange"></i>
                </label>
              </div> -->

              <!-- <h4 class="mt-3">Size <small>Please select one</small></h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                  <span class="text-xl">S</span>
                  <br>
                  Small
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                  <span class="text-xl">M</span>
                  <br>
                  Medium
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                  <span class="text-xl">L</span>
                  <br>
                  Large
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                  <span class="text-xl">XL</span>
                  <br>
                  Xtra-Large
                </label>
              </div> -->

            

              <!-- <div class="mt-4">
                <div class="btn btn-primary btn-lg btn-flat">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Add to Cart
                </div>

                <div class="btn btn-default btn-lg btn-flat">
                  <i class="fas fa-heart fa-lg mr-2"></i>
                  Add to Wishlist
                </div>
              </div> -->

              <!-- <div class="mt-4 product-share">
                <a href="#" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-envelope-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-rss-square fa-2x"></i>
                </a>
              </div> -->

            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <!-- <a class="nav-item nav-link " id="product-description-tab" data-toggle="tab" href="#product-description" role="tab" aria-controls="product-description" aria-selected="true">Description</a> -->
                <a class="nav-item nav-link active" id="product-key-benefits-tab" data-toggle="tab" href="#product-key-benefits" role="tab" aria-controls="product-key-benefits" aria-selected="false">Key benefits</a>
                <a class="nav-item nav-link" id="product-dosage-instruction-tab" data-toggle="tab" href="#product-safety-instruction" role="tab" aria-controls="product-dosage-instruction" aria-selected="false">Dosage Instruction</a>
                <a class="nav-item nav-link" id="product-safety-instruction-tab" data-toggle="tab" href="#product-safety-instruction" role="tab" aria-controls="product-safety-instruction" aria-selected="false">Safety Instruction</a>
                <a class="nav-item nav-link" id="product-other-instruction-tab" data-toggle="tab" href="#product-other-instruction" role="tab" aria-controls="product-other-instruction" aria-selected="false">Other Instruction</a>

              </div>
              
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <!-- <div class="tab-pane fade " id="product-description" role="tabpanel" aria-labelledby="product-description-tab">{{$product->description}}</div> -->
              <div class="tab-pane fade show active" id="product-key-benefits" role="tabpanel" aria-labelledby="product-key-benefits-tab"> {{$product->key_benefits}}</div>
              <div class="tab-pane fade" id="product-dosage-instruction" role="tabpanel" aria-labelledby="product-dosage-instruction-tab"> {{$product->dosage_instruction}}</div>
              <div class="tab-pane fade" id="product-safety-instruction" role="tabpanel" aria-labelledby="product-safety-instruction-tab"> {{$product->safety_instruction}}</div>
              <div class="tab-pane fade" id="product-other-instruction" role="tabpanel" aria-labelledby="product-other-instruction-tab">{{$product->other_instruction}}</div>
            </div>
            
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
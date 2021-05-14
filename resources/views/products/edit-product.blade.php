@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Product</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if (Session::has('product_update'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('product_update')}}
                                <button type="button" class="close text-success" data-dismiss="alert">×</button>
                            </div>
                        @endif
                        <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="pname">Product Name</label>
                                    <input type="hidden" name="pid" value="{{ $products->pid }}">
                                    <input type="text" name="pname" class="form-control" value="{{ $products->pname }}">
                                    @error('pname')
                                        <span class="text-danger font-weight-light">{{$message}}</span>        
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pprice">Product Price</label>
                                    <input type="text" name="pprice" class="form-control" value="{{ $products->pprice }}">
                                    @error('pprice')
                                        <span class="text-danger font-weight-light">{{$message}}</span>        
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="file">Product Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="form-control" name="file" value="{{asset('product_images')}}/{{$products->pimage}}">                                       
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>                                    
                                    </div>
                                    @if($products->pimage)
                                        <img id="original" src="{{asset('product_images')}}/{{$products->pimage}}" height="100" width="120">
                                    @endif
                                    @error('file')
                                        <span class="text-danger font-weight-light">{{$message}}</span>        
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pcategory">Product Category</label>
                                    <select class="custom-select rounded-0" name="pcategory" id="pcategory">
                                        @foreach($category as $item)
                                            <option value="{{ $item->cid }}" {{$products->pcategory == $item->cid ? 'selected' : '' }}>{{ $item->cname }}</option>
                                            @foreach ($item->categories as $sub )
                                                <option value="{{ $sub->cid }}" {{$products->pcategory == $sub->cid ? 'selected' : '' }}>&nbsp;--&nbsp;{{ $sub->cname }}</option>
                                            @endforeach
                                        @endforeach
                                </select>
                                    @error('pcategory')
                                        <span class="text-danger font-weight-light">{{$message}}</span>        
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
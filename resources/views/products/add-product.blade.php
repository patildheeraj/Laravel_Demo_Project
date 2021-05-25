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
                    <h3 class="card-title">Add New Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if (Session::has('product_added'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('product_added')}}
                        <button type="button" class="close text-success" data-dismiss="alert">×</button>
                    </div>
                @endif
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="pname">Product Name</label>
                                <input type="text" name="pname" class="form-control" value="{{ old('pname') }}" placeholder="Enter Product Name">
                                @error('pname')
                                    <span class="text-danger font-weight-light">{{$message}}</span>        
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pprice">Product Price</label>
                                        <input type="text" name="pprice" class="form-control" value="{{ old('pprice') }}" placeholder="Enter Product Price">
                                        @error('pprice')
                                            <span class="text-danger font-weight-light">{{$message}}</span>        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pstock">Product Stock</label>
                                        <input type="number" name="pstock" class="form-control" value="{{ old('pstock') }}" placeholder="Enter Product stock">
                                        @error('pstock')
                                            <span class="text-danger font-weight-light">{{$message}}</span>        
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file">Product Description</label>
                                <textarea name="description" class="form-control" placeholder="Enter Product Description">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger font-weight-light">{{$message}}</span>        
                                @enderror
                            </div>
                             <div class="form-group">
                                <label for="file">Material & Care</label>
                                <textarea name="care" class="form-control" placeholder="Enter Product Material & care">{{ old('care') }}</textarea>
                                @error('care')
                                    <span class="text-danger font-weight-light">{{$message}}</span>        
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">Product Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" name="file" id="file">
                                        {{-- <label class="custom-file-label" for="file">Choose file</label> --}}
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                                @error('file')
                                    <span class="text-danger font-weight-light">{{$message}}</span>        
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pcategory">Product Category</label>
                                <select name='pcategory' class="custom-select rounded-0" value="{{ old('pcategory') }}">
                                  <option value="">Select Category</option>
                                  @foreach ($category as $item)
                                    <option value="{{ $item->cid }}">{{ $item->cname }}</option> 

                                    @foreach ($item->categories as $sub )
                                        <option value="{{ $sub->cid }}">&nbsp;--&nbsp;{{ $sub->cname }}</option>
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
            </div>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection
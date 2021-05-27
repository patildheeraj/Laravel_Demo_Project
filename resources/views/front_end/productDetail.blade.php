@extends('front_end.layout')
@section('content')
<section>
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Product Detail</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="row">
				<div class="col-sm-3">
					@include('front_end.front_sidebar')
				</div>

				<div class="col-sm-9 padding-right">
					 @if (Session::get('success'))
		<div class="alert alert-success alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{{ Session::get('success') }}
		</div>
	@endif
	@if (Session::get('fail'))
		<div class="alert alert-danger alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{{ Session::get('fail') }}
		</div>
	@endif
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{asset('product_images')}}/{{$product->pimage}}" alt="" />
							</div>

						</div>
						<div class="col-sm-7">
							<form action="{{ url('add-cart') }}" method="POST">
								@csrf
								<input type="hidden" name="product_id" value="{{ $product->pid }}">
								<div class="product-information"><!--/product-information-->
									<img src="{{ asset('frontend/images/product-details/new.jpg') }}" class="newarrival" alt="" />
									<h2>{{ $product->pname }}</h2>
									<p>Product Code: {{ $product->product_code }}</p>
									<img src="{{ asset('frontend/images/product-details/rating.png') }}" alt="" />
									<span>
										<span>{{ $product->pprice }} Rs.</span>
										<label>Quantity:</label>
										<input type="text" value="1" name="quantity"/>
										@if ($product->pstock >0)
											<button type="submit" class="btn btn-fefault cart">
											<i class="fa fa-shopping-cart"></i>
											Add to cart
											</button>
										@else
											<button type="submit" class="btn btn-fefault cart" style="pointer-events: none">
											<i class="fa fa-shopping-cart"></i>
											Add to cart
											</button>
										@endif
									</span>
									@if ($product->pstock >0)
										<p><b>Availability:</b> In Stock</p>
									@else
										<p><b>Availability:</b> Out Of Stock</p>
									@endif
									<p><b>Condition:</b> New</p>
									<a href=""><img src="{{ asset('frontend/images/product-details/share.png') }}" class="share img-responsive"  alt="" /></a>
								</div>
							</form>
						</div>
					</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
								<li><a href="#care" data-toggle="tab">Material & Care</a></li>
								<li><a href="#delivary" data-toggle="tab">Delivary Option</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="description" >
                                    <div class="col-sm-12">
                                        <p>{{ $product->description }}</p>
                                    </div>
							</div>

							<div class="tab-pane fade" id="care" >
                                    <div class="col-sm-12">
                                        <p>{{ $product->care }}</p>
                                    </div>
							</div>

							<div class="tab-pane fade" id="delivary" >
                                    <div class="col-sm-12">
                                        <p>100% Original Product <br> Cash On Delivary is available.</p>
                                    </div>
							</div>
                        </div>
					</div>


				</div><!--/category-tab-->


			</div>
		</div>
	</div>
</section>
@endsection

@extends('front_end.layout')
@section('content')	
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
    <section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							@foreach ($banner as $key => $value)
								<li data-target="#slider-carousel" data-slide-to="0" @if ($key==0)  class="active"@endif></li>
							@endforeach
							{{-- <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li> --}}
						</ol>
						<div class="carousel-inner">
							@foreach ($banner as $key => $value)
								<div class="item @if ($key==0) active @endif">
									<div class="col-sm-6">
										<h1><span>E</span>-SHOPPER</h1>
										<h2>100% Responsive Design</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
										<button href="www.google.com" type="button" class="btn btn-default get">Get it now</button>
									</div>
									<div class="col-sm-6">
										<img src="{{asset('banner_images')}}/{{$value->bimage}}" class="img-responsive" alt="{{ $value->title }}" />
										{{-- <img src="{{ asset('frontend/images/home/pricing.png')}}"  class="pricing" alt="" /> --}}
									</div>
								</div>
							@endforeach
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								@foreach ($data as $item)
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#{{ $item->cid }}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{ $item->cname }}
										</a>
									</h4>
								</div>
								<div id="{{ $item->cid }}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											@foreach ($item->categories as $sub)
												
											<li><a href="/categories-products/{{ $sub->slug }}">{{ $sub->cname }} </a></li>
											@endforeach
										</ul>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						

						{{-- <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach ($category as $data)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="#">{{ $data->cname }}</a></h4>
                                    </div>
							    </div>
                            @endforeach
							
						</div> --}}
						
						<div class="shipping text-center"><!--shipping-->
							<img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						@foreach ($products as $item)
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<a href="#"><img src="{{asset('product_images')}}/{{$item->pimage}}" alt="" /></a>
											<h2>{{ $item->pprice }} Rs.</h2>
											<p>{{ $item->pname }}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										{{-- <div class="product-overlay">
											<div class="overlay-content">
												<h2>{{ $item->pprice }}</h2>
												<p>{{ $item->pname }}</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div> --}}
									</div>
									<div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
											<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
										</ul>
									</div>
								</div>
							</div>
						@endforeach
						
					</div><!--features_items-->
					
				</div>
			</div>
		</div>
	</section>
@endsection
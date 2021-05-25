@extends('front_end.layout')
@section('content')
    <section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@include('front_end.front_sidebar')
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Products Items</h2>
						@foreach ($products as $item)
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('product_images')}}/{{$item->pimage}}" alt="" width="200px" height="180px"/>
											<h2>{{ $item->pprice }} Rs.</h2>
											<p>{{ $item->pname }}</p>
											<a href="{{ url('/add-cart') }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
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
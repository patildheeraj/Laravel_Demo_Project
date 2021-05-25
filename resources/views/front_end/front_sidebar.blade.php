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
						
						<div class="shipping text-center"><!--shipping-->
							<img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
						</div><!--/shipping-->
						
					</div>

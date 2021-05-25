<style>
	#btn1{
		margin-bottom: 10px;
	}
</style>
@extends('front_end.layout')
@section('content')
      <section id="form1"><!--form-->
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Forgot Password</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="row">
				<div class="col-sm-6 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Forgot Password?</h2>
						@if(Session::has('fail'))
							<div class="alert alert-danger alert-dismissible with-close" role="alert">
								{{ session('fail') }}
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
							</div>
						@endif
						@if($errors->any())
							<div class="alert alert-danger">
								<p><strong>Opps Something went wrong</strong></p>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						
						{{-- @if (Session::has('error'))
                            <div class="alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-warnig">Warning</span>
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif --}}
						<form action="{{ route('forgot.password') }}" method="POST">
							@csrf
                            <label for="email">Enter email for change the password</label>
							<input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" />
							
							<button type="submit" class="btn btn-default" id="btn1">Submit</button>
							I already have a account,<a href="{{ url('/login') }}" class="mt-3"><Strong> Sign in!</Strong></a>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection
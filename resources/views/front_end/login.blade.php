<style>
    #form1{
        margin-bottom: 20px;
    }
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
				  <li class="active">Login</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="row">
				<div class="col-sm-6 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						@if(Session::has('fail'))
							<div class="alert alert-danger alert-dismissible with-close" role="alert">
								{{ session('fail') }}
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
							</div>
						@endif
						@if(Session::has('success'))
							<div class="alert alert-success alert-dismissible with-close" role="alert">
								{{ session('success') }}
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
							</div>
						@endif
						@if($errors->any())
							<div class="alert alert-danger alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<p><strong>Opps Something went wrong</strong></p>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						<form action="{{ route('frontuser.login') }}" method="POST">
							@csrf
							<input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}"/>
							<input type="password" name="password" placeholder="Enter Password" />
							<button type="submit" class="btn btn-default" id="btn1">Login</button>
							{{-- <a href="{{ url('/google') }}" class="btn btn-primary"><i class="fa fa-google"></i> Google</a>
							<a href="{{ url('/facebook') }}" class="btn btn-info">Login with Facebook</a>
							<a href="{{ route('login.github') }}" class="btn btn-dark">Login with Github</a> --}}
							<br>
							Don't remember password.<a href="{{ url('/forgot-password') }}" class="mt-3"><Strong>Forgot Password?</Strong></a>
							<br>
							Don't have a account? <a href="{{ url('/register') }}" class="mt-3"><Strong>Register now!</Strong></a>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection

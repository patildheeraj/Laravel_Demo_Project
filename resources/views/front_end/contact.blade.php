 @extends('front_end.layout')
@section('content')
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">    		
                <div class="col-sm-12">    			   			
                    <h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
                </div>			 		
            </div>    	
            <div class="row">  	
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Get In Touch</h2>
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
                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="POST" action="{{ route('contact.form') }}">
                            @csrf
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger font-weight-light">{{$message}}</span> 
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger font-weight-light">{{$message}}</span> 
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <input type="tel" name="mobile" class="form-control" placeholder="Mobile" value="{{ old('mobile') }}">
                                @error('mobile')
                                    <span class="text-danger font-weight-light">{{$message}}</span> 
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject') }}">
                                @error('subject')
                                    <span class="text-danger font-weight-light">{{$message}}</span> 
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="message" id="message" class="form-control" rows="8" placeholder="Message">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-danger font-weight-light">{{$message}}</span> 
                                @enderror
                            </div>                        
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Contact Info</h2>
                        <address>
                            <p>E-Shopper Inc.</p>
                            <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                            <p>Newyork USA</p>
                            <p>Mobile: +2346 17 38 93</p>
                            <p>Fax: 1-714-252-0026</p>
                            <p>Email: info@e-shopper.com</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Social Networking</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>    			
            </div>  
        </div>	
    </div><!--/#contact-page-->
@endsection
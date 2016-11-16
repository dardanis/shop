@extends('main')

@section('content')
		<div class="container">
		<div id="content" class="space-top-none">
			@if (Session::get('message'))
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{Session::get('message')}}
				</div>
			@endif
			<div class="space50">&nbsp;</div>
			<div class="row">
				<div class="col-sm-8">
					<h2>Contact Form</h2>
					<div class="space20">&nbsp;</div>
					<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit ani m id est laborum.</p>
					<div class="space20">&nbsp;</div>
					<form action="{{ url('/contact') }}" method="post" class="contact-form">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">	
						<div class="form-block">
							<input name="name" type="text" placeholder="Your Name (required)">
						</div>
						<div class="form-block">
							<input name="email" type="email" placeholder="Your Email (required)">
						</div>
						<div class="form-block">
							<input name="subject" type="text" placeholder="Subject">
						</div>
						<div class="form-block">
							<textarea name="message" placeholder="Your Message"></textarea>
						</div>
						<div class="form-block">
							<button type="submit" class="beta-btn primary">Send Message <i class="fa fa-chevron-right"></i></button>
						</div>
					</form>
				</div>
				<div class="col-sm-4">
					<h2>Contact Information</h2>
					<div class="space20">&nbsp;</div>

					<h6 class="contact-title">Address</h6>
					<p>
						Suite 127 / 267 – 277 Brussel St,<br>
						62 Croydon, NYC <br>
						Newyork
					</p>
					<div class="space20">&nbsp;</div>
					<h6 class="contact-title">Business Enquiries</h6>
					<p>
						Doloremque laudantium, totam rem aperiam, <br>
						inventore veritatio beatae. <br>
						<a href="mailto:biz@betadesign.com">biz@betadesign.com</a>
					</p>
					<div class="space20">&nbsp;</div>
					<h6 class="contact-title">Employment</h6>
					<p>
						We’re always looking for talented persons to <br>
						join our team. <br>
						<a href="info@shop.com">info@shop.com</a>
					</p>
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->

@endsection

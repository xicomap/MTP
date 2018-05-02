@extends('user.layout.app')
@section('content')
<section class="content">	
	<div class="contact-section">		
		 @include('common.notify')
		<div class="row" >		 
			<div class="col-md-12" style="padding-top:70px;">
				<div class="contact-form">
					<div class="row">
						<center>
    							<h1>Thank you for your registration.</h1>

   
    							<h4>We are processing your request, and you will soon be told that your account has
    been activated.</h4>

    							<h4>Please check your email for further instructions.</h4>
						</center>
					</div>
				</div>
			</div>			
		</div>
	</div>
</section>
@endsection
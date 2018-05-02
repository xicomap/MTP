<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  	<title>{{config('app.name')}}</title>
	<link href="{{asset('asset/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/fontawesome/css/fontawesome-all.css')}}" rel="stylesheet">
    <link href="{{asset('asset/css/style.css')}}" rel="stylesheet"> 
    <link href="{{asset('asset/css/responsive.css')}}" rel="stylesheet"> 
    
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	
    <script src="{{asset('asset/js/jquery.min.js')}}"></script>
	<script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('asset/js/smk-accordion.js')}}"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$(".accordion_example2").smk_Accordion({
				closeAble: true, //boolean
			});

		});
	</script>
</head>
<body class="nav-md">
<div class="container body">
  <div class="row">
    <div class="main_container">
    	@include('user.includes.header') 
    	 @yield('content')  	    	
		@include('user.includes.footer')          
    </div>
  </div>
</div>
@include('user.includes.signup')
@include('user.includes.login')
</body>
</html>

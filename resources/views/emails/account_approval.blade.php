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
    <link href="{{asset('asset/font-awesome/css/fontawesome-all.css')}}" rel="stylesheet">
    <link href="{{asset('asset/css/style.css')}}" rel="stylesheet">     
</head>
<body class="nav-md">
<div class="container body">
  <div class="row">
    <div class="main_container">    	
    	 Dear {{$user->first_name}} {{$user->last_name}},
    	 <br><br>
    	 @if($user->status == 0)
    	 Your profile has been rejected from the innovation team. Kindly contact to administrator for more details.
    	 @else
    	 Your profile has been appvoed and activated. Kindly login to the website and update your profile.
    	 @endif    	 
    	 <br><br>
    	 Thank you
    	 <br>
    	 MTP Team    	 
    </div>
  </div>
</div>
</body>
</html>

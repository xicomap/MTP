@extends('admin.layout.base')

@section('title', 'Add User ')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.user.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">@lang('admin.users.Add_User')</h5>

            <form class="form-horizontal" action="{{route('admin.user.store')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}

            	@if(Auth::guard('admin')->user()->role_id == 4)
            	
					
						<select id="UserType" class="form-control" name="user_type" style="display:none">
						<option value="">Select</option>
						<option value="1">Competitor</option>
						<option value="2">Sponsor</option>
						<option value="3">Investor</option>
						<option value="6" selected="selected">METEC Employees</option>
						<option value="5">Mlt Employees</option>
						</select>		

				@elseif(Auth::guard('admin')->user()->role_id == 2)
					
					<select id="UserType" class="form-control" name="user_type" style="display:none">
						<option value="">Select</option>
						<option value="1">Competitor</option>
						<option value="2" selected="selected">Sponsor</option>
						<option value="3">Investor</option>
						<option value="6" >METEC Employees</option>
						<option value="5">Mlt Employees</option>
						</select>
				@elseif(Auth::guard('admin')->user()->role_id == 3)
					
					<select id="UserType" class="form-control" name="user_type" style="display:none">
						<option value="">Select</option>
						<option value="1">Competitor</option>
						<option value="2" >Sponsor</option>
						<option value="3" selected="selected">Investor</option>
						<option value="6" >METEC Employees</option>
						<option value="5">Mlt Employees</option>
						</select>			
				

				@else
					<div class="form-group row">
						<label for="first_name" class="col-xs-12 col-form-label">User Type</label>
						<div class="col-xs-10">
							{!! userTypeDropdown() !!}

						</div>
					</div>
				@endif


				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">@lang('admin.first_name')</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ old('first_name') }}" name="first_name" required id="first_name" placeholder="First Name">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">@lang('admin.last_name')</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ old('last_name') }}" name="last_name" required id="last_name" placeholder="Last Name">
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-xs-12 col-form-label">@lang('admin.email')</label>
					<div class="col-xs-10">
						<input class="form-control" type="email" required name="email" value="{{old('email')}}" id="email" placeholder="Email">
					</div>
				</div>

				<div class="form-group row">
					<label for="password" class="col-xs-12 col-form-label">@lang('admin.password')</label>
					<div class="col-xs-10">
						<input class="form-control" type="password" name="password" id="password" placeholder="Password">
					</div>
				</div>

				<div class="form-group row">
					<label for="password_confirmation" class="col-xs-12 col-form-label">@lang('admin.account.password_confirmation')</label>
					<div class="col-xs-10">
						<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-type Password">
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">@lang('admin.mobile')</label>
					<div class="col-xs-10">
						<input class="form-control" type="number" value="{{ old('mobile') }}" name="mobile" required id="mobile" placeholder="Mobile">
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Sex</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="Male" name="sex" id="sex"> Male </label> 
						<label class="radio-inline"> <input type="radio" value="Female" name="sex" id="sex"> Female</label> 									 
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Date of Birth</label>
					<div class="col-xs-10">
						<input class="form-control date" type="text" name="dob" required id="dob" readonly>
					</div>
				</div>				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Description</label>
					<div class="col-xs-10">
						<textarea name='description' class="form-control" rows="7"></textarea>
					</div>
				</div>
<!-- 				<div class="form-group row"> -->
<!-- 					<label for="picture" class="col-xs-12 col-form-label">@lang('admin.picture')</label> -->
<!-- 					<div class="col-xs-10"> -->
<!-- 						<input type="file" accept="image/*" name="picture" class="dropify form-control-file" id="picture" aria-describedby="fileHelp"> -->
<!-- 					</div> -->
<!-- 				</div> -->

				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">@lang('admin.users.Add_User')</button>
						<a href="{{route('admin.user.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>
<script type="text/javascript">

    $('.date').datepicker({  

       format: 'mm-dd-yyyy'

     });  

</script>  
@endsection

@extends('admin.layout.base')

@section('title', 'Update User ')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.user.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">@lang('admin.users.Update_User')</h5>


            <form class="form-horizontal" action="{{route('admin.user.update', $user->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">
            	@if(Auth::guard('admin')->user()->role_id == 4 )
            	
					
						<select id="UserType" class="form-control" name="user_type" style="display:none">
						<option value="">Select</option>
						<option value="1" @if($user->user_type == 1) selected="selected" @endif>Competitor</option>
						<option value="2" @if($user->user_type == 2) selected="selected" @endif>Sponsor</option>
						<option value="3" @if($user->user_type == 3) selected="selected" @endif>Investor</option>
						<option value="6" @if($user->user_type == 6) selected="selected" @endif>METEC Employees</option>
						<option value="5" @if($user->user_type == 5) selected="selected" @endif>Mlt Employees</option>
						</select>

				@elseif(Auth::guard('admin')->user()->role_id == 2)
					
					<select id="UserType" class="form-control" name="user_type" style="display:none">
						<option value="">Select</option>
						<option value="1" @if($user->user_type == 1) selected="selected" @endif>Competitor</option>
						<option value="2" @if($user->user_type == 2) selected="selected" @endif>Sponsor</option>
						<option value="3" @if($user->user_type == 3) selected="selected" @endif>Investor</option>
						<option value="6" @if($user->user_type == 4) selected="selected" @endif >METEC Employees</option>
						<option value="5" @if($user->user_type == 5) selected="selected" @endif>Mlt Employees</option>
						</select>
				@elseif(Auth::guard('admin')->user()->role_id == 3)
					
					<select id="UserType" class="form-control" name="user_type" style="display:none">
						<option value="">Select</option>
						<option value="1" @if($user->user_type == 1) selected="selected" @endif>Competitor</option>
						<option value="2" @if($user->user_type == 2) selected="selected" @endif>Sponsor</option>
						<option value="3" @if($user->user_type == 3) selected="selected" @endif>Investor</option>
						<option value="6" @if($user->user_type == 4) selected="selected" @endif >METEC Employees</option>
						<option value="5" @if($user->user_type == 5) selected="selected" @endif>Mlt Employees</option>
						</select>

				@else
					<div class="form-group row">
					<label for="first_name" class="col-xs-2 col-form-label">User Type</label>
					<div class="col-xs-10">
						{!! userTypeDropdown($user->user_type) !!}						
					</div>
				</div>
				@endif
            	
				<div class="form-group row">
					<label for="first_name" class="col-xs-2 col-form-label">@lang('admin.first_name')</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $user->first_name }}" name="first_name" required id="first_name" placeholder="First Name">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-2 col-form-label">@lang('admin.last_name')</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $user->last_name }}" name="last_name" required id="last_name" placeholder="Last Name">
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-xs-2 col-form-label">@lang('admin.email')</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $user->email }}" name="email" required id="email" placeholder="Email" readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">@lang('admin.mobile')</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $user->mobile }}" name="mobile" required id="mobile" placeholder="Mobile">
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Sex</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="Male" name="sex" id="sex" {{ @($user->sex == "Male") ? "checked='checked'" : '' }}> Male </label> 
						<label class="radio-inline"> <input type="radio" value="Female" name="sex" id="sex" {{ @($user->sex == "Female") ? "checked='checked'" : '' }}> Female</label> 
									 
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Date of Birth</label>
					<div class="col-xs-10">
						<input class="form-control date" type="text" value="{{ originalDate($user->dob) }}" name="dob" required id="dob" readonly>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="picture" class="col-xs-2 col-form-label">@lang('admin.picture')</label>
					<div class="col-xs-10">
						@if($user->picture)
	                    	<img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="{{ asset('/storage/'.$user->picture) }}">
	                    @endif
						<input type="file" accept="image/*" name="picture" class=" dropify form-control-file" aria-describedby="fileHelp">
					</div>
				</div>
			
			 @if ( userType($user->user_type) == "Competitors") 
			 	<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Description (Cover Letter)</label>
					<div class="col-xs-10">
						 <textarea name='description' class="form-control" rows="7">{{ $user->description }}</textarea>
					</div>
				</div>
              	<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Kebele ID</label>
					<div class="col-xs-10">
						 @if($user->kebel_id != "")
                         	<a href="{{ asset('/storage/'.$user->kebel_id) }}" target="_blank">View</a>
                         @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">CV</label>
					<div class="col-xs-10">
						 @if($user->cv != "")
                         <a href="{{ asset('/storage/'.$user->cv) }}" target="_blank">View</a>
                         @endif
					</div>
				</div>              
			  @elseif ( userType($user->user_type) == "Sponsors" || userType($user->user_type) == "Investors") 
			  	<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Type of the organization</label>
					<div class="col-xs-10">
						<label for="Org1">
                          <input type="radio" {{ @($user->org_type == "Governmental") ? "checked='checked'" : '' }} id="Org1" name="org_type" value="Governmental"/>
                          <div class="checked"></div> Governmental
                        </label>
                        <label for="Org2">
                          <input type="radio" {{ @($user->org_type == "Non Governmental") ? "checked='checked'" : '' }} id="Org2" name="org_type" value="Non Governmental"/>
                          <div class="checked"></div>  Non Governmental
                        </label>
                        <label for="Org3">
                          <input type="radio" {{ @($user->org_type == "Private Company") ? "checked='checked'" : '' }} id="Org3" name="org_type" value="Private Company"/>
                          <div class="checked"></div>  Private Company
                        </label>
                        <label for="Org4">
                          <input type="radio" {{ @($user->org_type == "Other") ? "checked='checked'" : '' }} id="Org4" name="org_type" value="Other"/>
                          <div class="checked"></div>  Other
                        </label>					
                     </div>
				</div>       
			  	<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Position</label>
					<div class="col-xs-10">
						 <input type="text" class="form-control" value="{{$user->position}}" name="position" id="Position" />
					</div>
				</div>        
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Description</label>
					<div class="col-xs-10">
						 <textarea name='description' class="form-control" rows="7">{{ $user->description }}</textarea>
					</div>
				</div> 

				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">ID</label>
					<div class="col-xs-10">
						 @if($user->kebel_id != "")
                         	<a href="{{ asset('/storage/'.$user->kebel_id) }}" target="_blank">View</a>
                         @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Business/Personal Profile</label>
					<div class="col-xs-10">
						 @if($user->cv != "")
                         <a href="{{ asset('/storage/'.$user->cv) }}" target="_blank">View</a>
                         @endif
					</div>
				</div> 
			  @elseif ( userType($user->user_type) == "METEC Employees") 
			  	<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Branch Name</label>
					<div class="col-xs-10">
						 {!!branchNameDropDown($user->org_type)!!}
					</div>
				</div> 	
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Position</label>
					<div class="col-xs-10">
						 <input type="text" class="form-control" value="{{$user->position}}" name="position" id="Position" />
					</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">ID</label>
					<div class="col-xs-10">
						 @if($user->kebel_id != "")
                         	<a href="{{ asset('/storage/'.$user->kebel_id) }}" target="_blank">View</a>
                         @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Letter</label>
					<div class="col-xs-10">
						 @if($user->cv != "")
                         <a href="{{ asset('/storage/'.$user->cv) }}" target="_blank">View</a>
                         @endif
					</div>
				</div>

			  @elseif ( $user->user_type == 5 || $user->user_type == 6) 	
			  	<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">ID</label>
					<div class="col-xs-10">
						 @if($user->kebel_id != "")
                         	<a href="{{ asset('/storage/'.$user->kebel_id) }}" target="_blank">View</a>
                         @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Letter</label>
					<div class="col-xs-10">
						 @if($user->cv != "")
                         <a href="{{ asset('/storage/'.$user->cv) }}" target="_blank">View</a>
                         @endif
					</div>
				</div>

			  @endif
				
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Status</label>
					<div class="col-sm-9">
	                	<div class="radio"> 
	                    	<label>
	                    		<input class="icheck" type="checkbox" name="status" id="status" value="1" {{ @($user->status == 1) ? 'checked' : ''}} >
                    		</label> 
	                  	</div>
	                </div>					
				</div>	

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">@lang('admin.users.Update_User')</button>
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

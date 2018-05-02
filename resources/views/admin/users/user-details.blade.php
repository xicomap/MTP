@extends('admin.layout.base')

@section('title', 'User Details ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
			<h5 style="margin-bottom: 2em;">View User Information</h5>       
				<!--<div class="form-group row">
					<label for="picture" class="col-xs-2 col-form-label">@lang('admin.picture')</label>
					<div class="col-xs-10">
						@if($user->picture)
	                    	<img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="{{ asset('/storage/'.$user->picture) }}">
	                    @endif
						
					</div>
				</div>-->     
            	<div class="form-group row">
					<label for="first_name" class="col-xs-2 col-form-label">User Type</label>
					<div class="col-xs-10">
						{{ userType($user->user_type) }}						
					</div>
				</div>
				<div class="form-group row">
					<label for="first_name" class="col-xs-2 col-form-label">@lang('admin.first_name')</label>
					<div class="col-xs-10">
						{{ $user->first_name }}
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-2 col-form-label">@lang('admin.last_name')</label>
					<div class="col-xs-10">
						{{ $user->last_name }}
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-xs-2 col-form-label">@lang('admin.email')</label>
					<div class="col-xs-10">
						{{ $user->email }}
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">@lang('admin.mobile')</label>
					<div class="col-xs-10">
						{{ $user->mobile }}
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Sex</label>
					<div class="col-sm-9">									
						{{ $user->sex }}
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Date of Birth</label>
					<div class="col-xs-10">
						{{ originalDate($user->dob) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Profile Image</label>
					<div class="col-xs-10">
						 @if($user->picture != "")
                         	<img src="{{ asset('/storage/'.$user->picture) }}" width="100">
                         @endif
					</div>
				</div>
				
			 @if ( userType($user->user_type) == "Competitors") 
			 	<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Description (Cover Letter)</label>
					<div class="col-xs-10">
						 {{ $user->description }}
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
						{{ @($user->org_type) }} 
                     </div>
				</div>       
			  	<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Position</label>
					<div class="col-xs-10">
						 {{$user->position}}
					</div>
				</div>        
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Description</label>
					<div class="col-xs-10">
						{{ $user->description }}
					</div>
				</div> 
			  @elseif ( userType($user->user_type) == "METEC Employees") 
			  	<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Branch Name</label>
					<div class="col-xs-10">
						 {{$user->org_type }}
					</div>
				</div> 	
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Position</label>
					<div class="col-xs-10">
						 {{$user->position}}
					</div>
				</div>			  		
			  @endif
				
			</form>
		</div>
    </div>
</div>

@endsection

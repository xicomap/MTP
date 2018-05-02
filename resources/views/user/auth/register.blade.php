@extends('user.layout.app')

@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	@include('common.notify')
            <div class="panel panel-default">
                <div class="short-heading">Register</div>                
                <div class="panel-body">
                	<div class="col-md-8 col-md-offset-2 register-form">
	                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/user/register') }}">
	                        {{ csrf_field() }}
						
							<div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
	                            <label for="name" class="col-md-4 control-label">Select User Type<sup>*</sup></label>
	
	                            <div class="col-md-6">
	                                {!! html_entity_decode(userTypeDropdown()) !!}	
	                                @if ($errors->has('user_type'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('user_type') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
	                            <label for="name" class="col-md-4 control-label">First Name<sup>*</sup></label>
	
	                            <div class="col-md-6">
	                                <input id="FirstName" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required="" placeholder="Type your first name" />
	
	                                @if ($errors->has('first_name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('first_name') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
	                            <label for="name" class="col-md-4 control-label">Last Name</label>
	
	                            <div class="col-md-6">
	                                <input id="LastName" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Type your last name" />
	
	                                @if ($errors->has('last_name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('last_name') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	
	                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                            <label for="email" class="col-md-4 control-label">E-Mail Address<sup>*</sup></label>
	
	                            <div class="col-md-6">
	                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required="" placeholder="Type your email address" />
	
	                                @if ($errors->has('email'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	
	                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                            <label for="password" class="col-md-4 control-label">Password<sup>*</sup></label>
	
	                            <div class="col-md-6">
	                                <input id="password" type="password" class="form-control" name="password" required="" placeholder="Type your password" />
	
	                                @if ($errors->has('password'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	
	                        <div class="form-group">
	                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password<sup>*</sup></label>
	
	                            <div class="col-md-6">
	                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="" placeholder="Confirm password" />
	                            </div>
	                        </div>
	                        
	                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
	                            <label for="email" class="col-md-4 control-label">Mobile<sup>*</sup></label>
	
	                            <div class="col-md-6">
	                                <input id="mobile" type="phone" class="form-control" name="mobile" value="{{ old('mobile') }}" required="" placeholder="Type contact no.">
	
	                                @if ($errors->has('"mobile"'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('"mobile"') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('document_id') ? ' has-error' : '' }} mb10">
	                            <label for="email" class="col-md-5 control-label">ID <span style=" font-size: 11px; font-weight: 100;">( Kebele id, Driving license or Passport )<sup>*</sup></span></label>
	
		                           <div class="col-md-5">
		                                <label class="input-group-btn">
		                                  <span class="btn btn-primary attach">
		                                    <img src="{{asset('/asset/images/file.png')}}" alt="" /> 
		                                  </span>
		                                <input type="file" accept=".pdf,.doc,.docx,.txt" name="kebel" class=" dropify form-control-file control-label" placeholder="Select file to upload" aria-describedby="fileHelp" required="required" />
		                                </label>
		                            <!-- <input type="text" class="form-control upload-btn" disabled="" id="picturetext" placeholder="Select file to upload"> -->
	                                @if ($errors->has('"kebel"'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('"kebel"') }}</strong>
	                                    </span>
	                                @endif
		                          </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('cv') ? ' has-error' : '' }} mb10">
	                            <label for="email" class="col-md-5 control-label" id="document">Document<sup>*</sup></label>
	
		                           <div class="col-md-5">
		                                <label class="input-group-btn">
		                                  <span class="btn btn-primary attach">
		                                    <img src="{{asset('/asset/images/file.png')}}" alt="" />
		                                  </span>
		                                   <input type="file" accept=".pdf,.doc,.docx,.txt" name="cv" class=" dropify form-control-file control-label" aria-describedby="fileHelp" required="required">
		                                </label>
	                               
	                                @if ($errors->has('"cv"'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('"cv"') }}</strong>
	                                    </span>
	                                @endif
		                          </div>
	                        </div>


							<div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                {!! html_entity_decode(Captcha::img('flat')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Security text</label>
                            <div class="col-md-6">
                               <input id="captcha" type="text" class="form-control" name="captcha" required>
                            </div>
                        </div>
	                        <div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                <button type="submit" class="btn yellow-btn">
	                                    Register
	                                </button>
	                            </div>
	                        </div>
	                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("#UserType").change(function(){
    	console.log($(this).val())
    	var selected_val = $(this).val();

    	if(selected_val == 1)
    	{
    		//Competitor
    		$("#document").text('');
    		$("#document").html('Upload CV <sup>*</sup>');
    	}
    	else if(selected_val == 2 || selected_val == 3)
    	{
    		//Competitor
    		$("#document").text('');
    		$("#document").html('Upload Business / Personal Profile <sup>*</sup>');
    	}
    	else if(selected_val == 4 || selected_val == 5 || selected_val == 6)
    	{
    		//Competitor
    		$("#document").text('');
    		$("#document").html('Upload Letter <sup>*</sup>');
    	}
    	
    })

</script> 
@endsection

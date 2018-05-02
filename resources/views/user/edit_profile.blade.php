@extends('user.layout.app')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<section class="content">
	<div class="user-page">
  <div class="row mr0">
    @include('user.includes.links')

    <div class="col-md-9 user-rigtpart table-sec">
    	 @include('common.notify')
        <h1>Edit Profile ({{userType($user->user_type)}})</h1>        
        <div class="edit-profile-info">
          <form action="{{route('user.updateprofile')}}" method="POST" enctype="multipart/form-data" role="form">
          {{csrf_field()}}           
            <div class="row">
              <div class="col-md-6 pull-left">
                <div class="form-group"> 
                  	<label>First Name</label>                 
                  <input class="form-control" type="text" value="{{ $user->first_name }}" name="first_name" required id="first_name" placeholder="First Name">
                </div>
              </div>
              <div class="col-md-6 pull-left">
                <div class="form-group">
                  	<label>Last Name</label>
                  <input class="form-control" type="text" value="{{ $user->last_name }}" name="last_name" required id="last_name" placeholder="Last Name">
                </div>
              </div>
              <div class="col-md-6 pull-left labels">
                <span>Sex:</span>                
                <label for="Sex1">
                  <input type="radio" id="Sex1" name="sex" {{ ($user->sex == "Male") ? "checked=''" : '' }} value="Male"/>
                  <div class="checked"></div> Male
                </label>
                <label for="Sex2">
                  <input type="radio" id="Sex2" name="sex" {{ ($user->sex == "Female") ? "checked=''" : '' }} value="Female"/>
                  <div class="checked"></div> Female
                </label>
              </div>
              <div class="col-md-6 pull-left">
              	<div class="choose-file">
                  	<label>Date of Birth</label>
                    <div class="form-group">                
                      <input type="text" class="form-control date" value="{{originalDate($user->dob)}}" placeholder="Select Date" readonly name="dob"/>
                    </div>
                </div>
              </div>
              <div class="col-md-6 pull-left">
              	<div class="choose-file">
                  	<label>Mobile</label>
                    <div class="form-group">
                      <input class="form-control" type="text" value="{{ $user->mobile }}" name="mobile" required id="mobile" placeholder="Mobile">
                    </div>
                </div>
              </div>
              <div class="col-md-6 pull-left">
                <div class="choose-file">
                  <label>Profile Picture</label>
                  @if(Auth::guard('user')->user()->picture != "")
                  	<figure class="profile-img">
            			<img src="{{ asset('/storage/'.Auth::guard('user')->user()->picture) }}" alt="" width='100'>
            		</figure>            		
            		@endif
                  <div class="input-group mr0">
                    <label class="input-group-btn">
                      <span class="btn btn-primary attach">
                      	<span class="btn btn-primary attach">
                        <img src="{{asset('/asset/images/file.png')}}" alt="" /> 
                        </span>
                      </span>
                      <input type="file" name="profilepic">
                    </label>                   
		
                    <input type="text" class="form-control" disabled="" id="profilepictext" placeholder="Select file to upload">
                  </div>
                </div>
              </div>
              
              @if ( userType($user->user_type) == "Competitors") 
              <div class="col-md-12 pull-left">
             	 <div class="choose-file">
                  	<label>Description (Cover Letter)</label>
                    <div class="form-group">
                      <textarea name='description' class="form-control" rows="7">{{ $user->description }}</textarea>
                    </div>
                 </div>
              </div>
              <div class="col-md-12 pull-left">
                <div class="choose-file">
                  <label>Kebele ID</label>
                  <div class="input-group mr0">
                    <label class="input-group-btn">
                      <span class="btn btn-primary attach">
                        <img src="{{asset('/asset/images/file.png')}}" alt="" /> 
                      </span>
                      <input type="file" name="kebel">
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-12 pull-left">
                <div class="choose-file">
                  <label>CV</label>
                  <div class="input-group mr0">
                    <label class="input-group-btn">
                      <span class="btn btn-primary attach">
                        <img src="{{asset('/asset/images/file.png')}}" alt="" />
                      </span>
                    <input type="file" name="cv">
                    </label>
                    <!-- <input type="text" class="form-control" disabled="" id="cvtext" placeholder="Select file to upload" style="max-width:100%; min-width:255px;"> -->
                  </div>
                </div>
              </div>
			  @elseif ( userType($user->user_type) == "Sponsors" || userType($user->user_type) == "Investors") 
			  <div class="col-md-12 pull-left org">
                    <span>Type of the organization</span>
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
                  <div class="col-md-12 pull-left">
                    <div class="form-group">
                      <span>Position</span>
                      <input type="text" class="form-control" value="{{$user->position}}" name="position" id="Position" />
                    </div>
                  </div>
                 <div class="col-md-12 pull-left">
             	 <div class="choose-file">
                  	<label>Description</label>
                    <div class="form-group">
                      <textarea name='description' class="form-control" rows="7">{{ $user->description }}</textarea>
                    </div>
                 </div>
              </div>
			  
			  @elseif ( userType($user->user_type) == "METEC Employees") 
			  	<div class="col-md-6 pull-left">
                    <div class="form-group">
                      <span class="branch">Branch Name</span>                     
                      {!! html_entity_decode(dropdown2('org_type',$bchs,$user->org_type)) !!}	
                    </div>
                  </div>			  
			  	<div class="col-md-6 pull-left">
                    <div class="form-group">
                      <span>Position</span>
                      <input type="text" class="form-control" value="{{$user->position}}" name="position" id="Position" />
                    </div>
                  </div>   			  
			  @endif
			  			  
              <div class="action col-md-12">
                <input type="submit" class="btn btn-default yellow-btn" value="Update" name="submit">                
              </div>
            </div>
          </form>
        </div>
    </div>  
  </div>
</div>
</section>
<script type="text/javascript">
	$('.date').datepicker({
       format: 'mm-dd-yyyy'
     }); 
	 $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            var name = $(this).attr('name');
            $("#"+name+"text").val(fileName +  ' selected');            
        });
    }); 
</script>  
@endsection

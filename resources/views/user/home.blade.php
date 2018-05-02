@extends('user.layout.app')
@section('content')
<section class="content">
    <div class="user-page">
      <div class="row mr0">
         @include('user.includes.links')           
        <div class="col-md-9 user-rigtpart table-sec">
          <h1>{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}} ({{userType($user->user_type)}})<span><i class="fas fa-map-marker-alt"></i> </span></h1>
          <div class="user-type"></div>          
          <div class="user-detail">
          
          	<div class="u-row">
              <label>Picture:</label>
              <div class="u-content">
                 @if($user->picture != "")
                 <img src="{{ asset('/storage/'.$user->picture) }}" width="100">
                 @endif
              </div>
            </div>
            
          	<div class="u-row">
              <label>Email:</label>
              <div class="u-content">
                 {{$user->email}}
              </div>
            </div>
            
            <div class="u-row">
              <label>Phone:</label>
              <div class="u-content">
                {{$user->mobile}}
              </div>
            </div>           
            
            <div class="u-row">
              <label>Sex:</label>
              <div class="u-content">
                 {{$user->sex}}
              </div>
            </div>
            <div class="u-row">
              <label>Date of Birth:</label>
              <div class="u-content">
                 {{ ($user->dob != "") ? date("M d, Y", strtotime($user->dob)) : '' }}
              </div>
            </div>
            
             @if ( userType($user->user_type) == "Competitors")              
              <div class="u-row">
              <label>Description (Cover Letter):</label>
              <div class="u-content">
                 {{ $user->description }}
              </div>
            </div>
            <div class="u-row">
              <label>Kebele ID:</label>
              <div class="u-content">
                 @if($user->kebel_id != "")
                 <a href="{{ asset('/storage/'.$user->kebel_id) }}" target="_blank">View</a>
                 @endif
              </div>
            </div>
            <div class="u-row">
              <label>CV:</label>
              <div class="u-content">
                  @if($user->cv != "")
                 <a href="{{ asset('/storage/'.$user->cv) }}" target="_blank">View</a>
                 @endif
              </div>
            </div>
			  @elseif ( userType($user->user_type) == "Sponsors" || userType($user->user_type) == "Investors") 
			   <div class="u-row">
                  <label>Type of the organization:</label>
                  <div class="u-content">
                     {{$user->org_type}}
                  </div>
                </div>
            	<div class="u-row">
                  <label>Position:</label>
                  <div class="u-content">
                     {{$user->position}}
                  </div>
                </div>
			  	<div class="u-row">
                  <label>Description:</label>
                  <div class="u-content">
                     {{ $user->description }}
                  </div>
                </div>			  
			  @elseif ( userType($user->user_type) == "METEC Employees") 
			  <div class="u-row">
                  <label>Branch Name:</label>
                  <div class="u-content">
                     {{ $user->org_type }}
                  </div>
                </div>	
			  	<div class="u-row">
                  <label>Position:</label>
                  <div class="u-content">
                     {{$user->position}}
                  </div>
                </div>		  	  
			  @endif            
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
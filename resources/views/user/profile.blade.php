@extends('user.layout.app')
@section('content')
<section class="content">
    <div class="user-page">
      <div class="row">        
        @include('user.includes.links')           
        <div class="col-md-9 user-rigtpart">
          <h1>{{ucfirst($userinfo->first_name)}} {{ucfirst($userinfo->last_name)}}<span><i class="fas fa-map-marker-alt"></i> </span></h1>
          <div class="user-type">{{userType($userinfo->user_type)}}</div>
          <div class="user-detail">
            <div class="u-row">
              <label>Phone:</label>
              <div class="u-content">
                {{$userinfo->mobile}}
              </div>
            </div>           
            <div class="u-row">
              <label>Email:</label>
              <div class="u-content">
                 {{$userinfo->email}}
              </div>
            </div>
            <div class="u-row">
              <label>Bio:</label>
              <div class="u-content">
                 {{$userinfo->description}}
              </div>
            </div>
            <div class="u-row">
              <label>Sex:</label>
              <div class="u-content">
                 {{$userinfo->sex}}
              </div>
            </div>
            <div class="u-row">
              <label>Bio:</label>
              <div class="u-content">
                 {{$userinfo->dob}}
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
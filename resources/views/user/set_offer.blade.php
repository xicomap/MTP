@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row mr0">
    @include('user.includes.links')           
    <div class="col-md-9 user-rigtpart table-sec edit-profile-info">
    	@include('common.notify')
      @if($idea->applicant)
      <p>{!! $idea->applicant->comment !!}</p>
      @endif
       <form action="{{route('submitoffer',$id)}}" method="post" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal">
            {{ csrf_field() }}    
        	
        	<div class="input-row">
            	Are you looking to invest or sponsor?: <br>
           			 @if($idea->lookingfor == "")
					 <input type="radio" name="lookingfor" value="Sponsor" checked> Sponsor
					 <input type="radio"  name="lookingfor" value="Invest"> Invest
					@else
						{{ $idea->lookingfor }}
					@endif             
            </div>
          
            <div class="input-row">
            	<label class="col-sm-3 pd0">Offer:</label> 
            	<div class="col-sm-6 pd0">
           			 @if($idea->offer == 0)
					 <input type="number" class="form-control" name="offer" placeholder="USD" min="0">
					@else
						${{ $idea->offer }}
					@endif            
				</div> 
            </div>
            
			  <div class="scroll-sec">
                @if(!empty($convs))
    				@foreach ($convs as $con)				
    				<div class="form-group row">
    					<label for="mobile" class="col-xs-12 col-form-label">
    					@if($con->from_admin_id != 0)
    					{{$con->fromadmin->first_name}} {{$con->fromadmin->last_name}}
    					@elseif($con->from_user_id != 0) 
    					{{$con->fromuser->first_name}} {{$con->fromuser->last_name}}
    					@endif
    					
    					 (Date: {{date("M d, Y", strtotime($con->created_at))}})</label>
    					<div class="col-xs-12">
    						{!!$con->description!!}
    					</div>
    					<div class="col-xs-12">
    						Attachment:
               
    							@if($con->attach_file != "")
                                 <a href="{{ asset('/storage/'.$con->attach_file) }}" target="_blank">View</a>
                                @else
                                 N/A
                                @endif
    					</div>
    				</div>
    				@endforeach
    				@endif
    			 </div>
            
            <div class="form-group row">
				<label for="mobile" class="col-form-label">Post message</label>
				<div class="col-xs-12 pd0">
					<textarea class="form-control text-area" name="message" rows=7></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="mobile" class="col-xs-12 col-form-label pd0">Attach document</label>
				<div class="col-xs-10 pd0">
                    <label class="input-group-btn">
                      <span class="btn btn-primary attach">
                        <img src="{{asset('/asset/images/file.png')}}" alt="" />
                      </span>
                      <input type="file" name="picture">
                    </label>
                	<input type="text" class="form-control upload-btn" id="picturetext" placeholder="Select file to upload">
              	</div>
              	
              	
			</div>
			<div class="input-row">
              <button type="submit" class="btn btn-primary yellow">Submit</button>
              <a href="{{route('userwishlist')}}"><button type="button" class="btn btn-primary yellow">Back</button></a>
            </div>	
            
    		
            <button type="submit" class="btn btn-primary yellow">Submit</button>
      </form>
    </div>
  </div>
</div>
</section>
<script>
$(document).ready(function(){
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        var name = $(this).attr('name');
        $("#"+name+"text").val(fileName +  '" selected');            
    });
}); 
</script>
@endsection
@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row mr0">
    @include('user.includes.links')           
    <div class="col-md-9 user-rigtpart table-sec edit-profile-info">
    	@include('common.notify')

      
      <h1>{{$idea->idea->title}}</h1>
      <p>{!! $idea->idea->description !!}</p>

       <form action="{{route('submitsolution',$id)}}" method="post" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal">
            {{ csrf_field() }}    
        
          
            <div class="input-row">
            	@if ($idea->idea->type == 1)
				<label for="mobile" class="col-form-label">Your Idea: </label>            	
            	@elseif($idea->idea->type == 2)
            	Your Solution: 
            	@endif
            	<br>
           			 @if($idea->comment == "")
					 <textarea placeholder="" class="form-control text-area" required name="comment"></textarea>
					@else
						{!!$idea->comment!!}
					@endif
             
            </div>
            
			  <div class="scroll-sec competition-details">
                @if(!empty($convs))
    				@foreach ($convs as $con)	

    				<div class="form-group row">
    					
    					@if($con->from_admin_id != 0)
              <label for="mobile" class="col-form-label admtxt">
    					  {{$con->fromadmin->first_name}} {{$con->fromadmin->last_name}}
    					@elseif($con->from_user_id != 0) 
              <label for="mobile" class="col-form-label">
    					  {{$con->fromuser->first_name}} {{$con->fromuser->last_name}}
    					@endif
    					
    					 (Date: {{date("M d, Y", strtotime($con->created_at))}})</label>
    					<div class="full-row">
    						{!!$con->description!!}
    					</div>
    					<div class="full-row">
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
			<div class="form-group row"><br />
				<label for="mobile" class="col-xs-12 col-form-label pd0">Attach document</label>
			  <div class="col-xs-10 pd0">
                    <label class="input-group-btn">
                      <span class="btn btn-primary attach">
                        <img src="{{asset('/asset/images/file.png')}}" alt="" /> 
                      </span>
                      <input type="file" name="attach">
                    </label>
                <input class="form-control upload-btn" disabled="" id="picturetext" placeholder="Select file to upload" type="text">
                <!-- <input type="text" class="form-control upload-btn" disabled="" id="attachtext" placeholder="Select file to upload" style="max-width:100%; min-width:255px;"> -->
              </div>              
			</div>
			
			<div class="input-row buttons-sec">
              <button type="submit" class="btn btn-primary yellow">Submit</button>
              <a href="{{route('invitations')}}"><button type="button" class="btn btn-primary yellow">Back</button></a>
            </div>	
            
    		
            
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

    $.ajax({
       type:'POST',
       url:"{{URL::to('read')}}",
       data:{'_token':'<?php echo csrf_token() ?>', idea_id: {{$idea->idea_id}}},
       success:function(data){
         console.log(data);                  
         
       }
    });


}); 
</script>
@endsection
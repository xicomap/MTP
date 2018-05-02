@extends('user.layout.app')
@section('content')
<section class="content post-page">
	<div class="user-page">
  <div class="row mr0">
    @include('user.includes.links')           
    <div class="col-md-9 user-rigtpart table-sec">
    <div class="post-section">
    <div class="top-title">
    	@include('common.notify')
      <h1>{{$mp->title}}</h1>
      <p class="posted">by <span class="user_name">{{ ($mp->user_id > 0) ? $mp->user->first_name.' '.$mp->user->last_name : 'Admin' }}</span> on 	<span class="post-date">{{date("M d, Y H:i", strtotime($mp->created_at))}}</span></p>
      </div>
      <div class="desc-sec">		
	      <div class="desc"><p>{!! $mp->description !!}</p></div>
	      
	      <div class="col-md-12 row flex-sec">
	          <div class="img-container flexi-sec">
	      		@if($mp->picture_file != "")
	             <img src="{{ asset('/storage/'.$mp->picture_file) }}" width=250/>                    
	            @endif
	          </div>    
	          <div class="video-container flexi-sec">
	          	@if($mp->video_file != "")
	            	 <video width="250" controls>
	                      <source src="{{ asset('/storage/'.$mp->video_file) }}" type="video/mp4">  
	                </video>
	            @endif
	          </div>       
	      </div>
	      
	       <form action="{{route('mltsubmitcomment',$mp->id)}}" method="post" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal full-form">
	            {{ csrf_field() }}     
	            
				  <div class="comment-container">              
	    				@foreach ($comments as $con)				
	    				<div class="form-group comment-sec">
	    					<span class="col-sm-1 pd0 text-center hide-xs">
	    						@if(($mp->correctans == 0) && ($mp->user_id == Auth::guard('user')->user()->id))
	    							<a class="tick" href="{{route('mltupdatesol',$con->id)}}" onClick="return confirm('Are you sure?')"><i class="fas fa-check"></i></a>
	    						@elseif($mp->correctans == $con->id)
	    							<a class="tick green" href="#;"><i class="fas fa-check"></i></a>
	    						
	    						@endif
	    					</span>
	    					<span class="col-sm-10 row pd0">    					
	    					<div class="comments">
	    						<span class="comnt-by">{{$con->user->first_name}} {{$con->user->last_name}}</span>  {!!$con->comment!!}
	    						<span class="comnt-on">{{date("M d, Y H:i", strtotime($con->created_at))}}</span>
	    					</div>   
	    					<label for="mobile" class="col-xs-12 col-form-label">   						    					
	    					</label> 				
	    					</span>	
	    				</div>
	    				@endforeach    				
					</div>
					
	            <div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label pd0">Post Comment</label>
					<div class="col-xs-12 pd0">
						<textarea class="form-control cmnt-text-area" name="comment" placeholder="Write Your Comment Here.. "></textarea>
					</div>
				</div>			
				<div class="form-group row">
	              <button type="submit" class="btn btn-primary yellow">Submit</button>
	              <a href="{{route('index')}}"><button type="button" class="btn btn-primary yellow">Back</button></a>
	              </div>
	            
	      </form>
      </div>
      </div>
      
      
      <div class="add-comments">
      	<div class="">
      	</div>
      </div>
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
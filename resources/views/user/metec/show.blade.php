@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row mr0">
    @include('user.includes.links')           
    <div class="col-md-9 user-rigtpart table-sec">
    	@include('common.notify')
      <h1>{{$mp->title}}</h1>
      <p>by {{ ($mp->user_id > 0) ? $mp->user->first_name.' '.$mp->user->last_name : 'Admin' }} on 	{{date("M d, Y H:i", strtotime($mp->created_at))}}</p>		
      <p>{!! $mp->description !!}</p>
      
      <div class="col-md-12 row">
          <div class="col-md-4" >
      		@if($mp->picture_file != "")
             <img src="{{ asset('/storage/'.$mp->picture_file) }}" width=250/>                    
            @endif
          </div>    
          <div class="col-md-8" >
          	@if($mp->video_file != "")
            	 <video width="250" controls>
                      <source src="{{ asset('/storage/'.$mp->video_file) }}" type="video/mp4">  
                </video>
            @endif
          </div>       
      </div>
      
       <form action="{{route('submitcomment',$mp->id)}}" method="post" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal full-form">
            {{ csrf_field() }}     
            
			  <div class="">              
    				@foreach ($comments as $con)				
    				<div class="form-group comment-sec">
    					<span class="col-sm-1 col-xs-1 pd0 text-center">
    						@if(($mp->correctans == 0) && ($mp->user_id == Auth::guard('user')->user()->id))
    							<a class="tick" href="{{route('updatesol',$con->id)}}" onClick="return confirm('Are you sure?')"><i class="fas fa-check"></i></a>
    						@elseif($mp->correctans == $con->id)
    							<a class="tick green" href="#;"><i class="fas fa-check"></i></a>
    						@else
    							<a class="tick" href="#;"><i class="fas fa-check"></i></a>
    						@endif
    					</span>
    					<span class="col-sm-10 col-xs-11 row">    					
    					<div class="col-xs-12">
    						{!!$con->comment!!}
    					</div>   
    					<label for="mobile" class="col-xs-12 col-form-label">    					
    					Comment by {{$con->user->first_name}} {{$con->user->last_name}} on 	{{date("M d, Y H:i", strtotime($con->created_at))}}				
    					
    					</label> 				
    					</span>	
    				</div>
    				@endforeach    				
				</div>
				
            <div class="form-group row">
				<label for="mobile" class="col-xs-12 col-form-label">Post Comment</label>
				<div class="col-xs-12">
					<textarea class="form-control" name="comment" rows=7></textarea>
				</div>
			</div>			
			<div class="input-row buttons-sec">
              <button type="submit" class="btn btn-primary yellow">Submit</button>
              <a href="{{route('index')}}"><button type="button" class="btn btn-primary yellow">Back</button></a>
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
}); 
</script>
@endsection
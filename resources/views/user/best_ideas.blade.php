@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row mr0">
    @include('user.includes.links')
    <div class="col-md-9 user-rigtpart table-sec">
    	 @include('common.notify')
    	 @if ($type == 1) 			
        <h1>Best Idea Competitions</h1>      
         @elseif($type == 2)
         <h1>Best Public Challenges</h1>      
         @endif        
         
         
  		
  		<div class="detail-row">
                @foreach($ideas as $index => $inv) 

		  		<div class="detail-column">
		  			<div class="competition">
		  				<div class="sec-row">
		  					<label> Competator ID </label>   
		  					<span>
		  						{{ $inv->user_id }}
		  					</span>
		  				</div>
		  				<div class="sec-row">
		  					@if ($type == 1)  
		  						<label> Idea Competition Name</label> 
		  					 @elseif($type == 2) 
		  					 	<label> Public Challenge Name</label>
		  					 @endif    
		  					<span>
		  						{{ $inv->title }}
		  					</span>
		  				</div>
		  				<div class="sec-row">
		  					<label>Description</label>   
		  					<span>
		  						{!! $inv->description !!}
		  					</span>
		  				</div>

		  				@if(!empty($ideaids))


		  					@if (in_array($inv->id, $ideaids))
						     <div class="sec-row">
				  					<label>Action </label>
				  				<span> <button type="submit" class="apply btn yellow-btn" href="#_">Already in the Wishlist </button></span>
				  				</div>
				  			@else
				  				<form action="{{route('ideaswishlist')}}" method="POST" role="form" class="form-horizontal clear">
                    				{{ csrf_field() }}   
				  				<div class="sec-row">
				  					<label> Action </label>
		                    		<input type="hidden" name="appid" value="{{$inv->id}}">
		                    		<input type="hidden" name="type" value="{{$type}}">
				  					<span> <button type="submit" class="apply btn yellow-btn" href="#_">Send this to Wishlist </button></span>
				  				</div>    
	                    		</form>	

						 	@endif
						@else	  				

		  				<form action="{{route('ideaswishlist')}}" method="POST" role="form" class="form-horizontal clear">
                    		{{ csrf_field() }}   
			  				<div class="sec-row">
			  					<label> Action </label>
	                    		<input type="hidden" name="appid" value="{{$inv->id}}">
	                    		<input type="hidden" name="type" value="{{$type}}">
			  					<span> <button type="submit" class="apply btn yellow-btn" href="#_">Send this to Wishlist </button></span>
			  				</div>    
                    	</form>	
                    	@endif	  				
		  			</div>
		  		</div>
                @endforeach
  		</div>
  		
    </div>  
  </div>
</div>
</section>
@endsection

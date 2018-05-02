@extends('user.layout.app')
@section('content')
<section class="content">
	
	<div class="col-md-12 pd0">
  
		<div class="content-area clearfix">
            <div class="post-list">
            <h3 class="mb-1">
                Public Challanges  
            </h3>			
        
        <div class="para-desc top-set">
        	<p><?php echo strip_tags($page_content->content );?></p>
        </div>
            
  		<div class="detail-row challanges">
  			@if($pchallanges)
                    @foreach($pchallanges as $index => $pidea)
                   
		  		<div class="detail-column">
		  			<div class="article-no"><label class="title"> <a href="{{url('/detail/'.$pidea->id)}}">{{$pidea->title}}</a></label></div>		  			
		  			<div class="description-sec">
		  				{!! $pidea->description !!}
		  			</div>
		  			<div class="competition">
		  				<div class="sec-row">
		  					<label> Date posted </label>
		  					<span class="desc"> {{ Carbon\Carbon::parse($pidea->start_date)->format('M d, Y') }} </span>
		  				</div>
		  				<div class="sec-row">
		  					<label> Deadline </label>
		  					<span class="desc"> {{ Carbon\Carbon::parse($pidea->end_date)->format('M d, Y') }} </span>
		  				</div>

		  				@if(!empty($ideaids))
			  				

		  					@if (in_array($pidea->id, $ideaids))
						     <div class="sec-row">
				  					<label> Do you have an Idea </label>
				  					<span> <button type="submit" class="apply btn yellow-btn" href="#_">Already Applied </button></span>
				  				</div>
				  			@else

				  			<div class="sec-row">
			  					<label> Do you have solution? </label>	
			  					<span class="desc">	  					
			                        <form method="post" action="{{route('innovationapply')}}" class="clear">
	        				{{ csrf_field() }}       
			        				 	<input type="hidden" name="idea_id" value="{{$pidea->id}}">
			            				<div class="">               					
			                                <button type="submit" class="apply btn yellow-btn">Suggest solution and get reward</button>                                         					
			            			 	</div>
			        				</form>
		        				</span> 
			  				</div>


						 	@endif
						@else

			  				<div class="sec-row">
			  					<label> Do you have solution? </label>	
			  					<span class="desc">	  					
			                        <form method="post" action="{{route('innovationapply')}}" class="clear">
	        				{{ csrf_field() }}       
			        				 	<input type="hidden" name="pidea_id" value="{{$pidea->id}}">
			            				<div class="">               					
			                                <button type="submit" class="apply btn yellow-btn">Suggest solution and get reward</button>                                         					
			            			 	</div>
			        				</form>
		        				</span> 
			  				</div>
		  				@endif

		  			</div>
		  		</div>
                    @endforeach

                    @else
                    <p>Public challenge competing is coming soon!</p>
                @endif
  		</div>
            
            </div>
		
			
			
			
            
          	
        	
		</div>
	</div> 		
	 
	
</section>
@endsection
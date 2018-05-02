@extends('user.layout.app')
@section('content')
<section class="content">


	
	<div class="col-md-12 idea-comp">
  
		<div class="content-area clearfix">
            <div class="post-list">
            <h3 class="mb-1">
               Idea Competitions
            </h3>		
        
        <div class="para-desc top-set">
   
        <p><?php echo strip_tags($page_content->content );?></p>
        </div>
		<div class="list-grp comptetion">
			
  		
  		<div class="detail-row">
			@if (!empty($ideas))
				@foreach($ideas as $index => $idea)
					  		
		  		<div class="detail-column">
		  			<div class="article-no"><label class="title"> <a >{{$idea->title}}</a></label></div>
		  			<p><?php echo strip_tags($idea->description );?></p>
		  			
		  			<div class="competition">
		  				<div class="sec-row">
		  					<label> Date posted </label>
		  					<span>
		  					{{ Carbon\Carbon::parse($idea->start_date)->format('M d, Y') }}</span>
		  				</div>
		  				<div class="sec-row">
		  					<label> Deadline </label>
		  					<span> {{ Carbon\Carbon::parse($idea->end_date)->format('M d, Y') }} </span>
		  				</div>

		  				@if(!empty($ideaids))
		  				
			  				

		  					@if (in_array($idea->id, $ideaids))
						     <div class="sec-row">
				  					<label> Do you have an Idea </label>
				  					<span> <button type="submit" class="apply btn yellow-btn" href="#_">Already Applied </button></span>
				  				</div>
				  			@else

				  			 <form method="post" action="{{route('innovationapply')}}" class="clear">
		        				{{ csrf_field() }}

				  				<div class="sec-row">
				  					<label> Do you have an Idea </label>
				  					<span> <button type="submit" class="apply btn yellow-btn" href="#_">Apply now </button></span>
				  				</div>
				  				</form>


						 	@endif

						@else
							 <form method="post" action="{{route('innovationapply')}}" class="clear">
		        				{{ csrf_field() }}

				  				<div class="sec-row">
				  					<label> Do you have an Idea </label>
				  					<span> <button type="submit" class="apply btn yellow-btn" href="#_">Apply now </button></span>
				  				</div>
				  				</form>
		  				@endif

		  				

		  			</div>
		  		</div>
				@endforeach

			@else
				<p> Idea Competitions,  Coming Soon!</p>
			@endif	  	
  		</div>
  		
			<!-- <ul class="side-menu scroll-way">
				@if (!empty($ideas))
	    			@foreach($ideas as $index => $idea)
	    				<li> <a href="{{url('/detail/'.$idea->id)}}">{{$idea->title}}</a> <i class="fa fa-angle-right"></i></li>
	    			@endforeach
				@endif
			</ul> -->
		</div>
            
            </div>
			<div class="pagination">
				{{ $ideas->links() }}
			</div>
			
			
			
           		
        	
		</div>
	</div> 		
	  
	
</section>
@endsection
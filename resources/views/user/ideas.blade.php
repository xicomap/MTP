@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row mr0">
    @include('user.includes.links')
    <div class="col-md-9 user-rigtpart table-sec">
    	 @include('common.notify')
    	@if ($type == 1) 
        <h1>Idea Competition List</h1>
        @elseif ($type == 2)
        <h1>Public Challenges</h1>
        @endif  
        
        
  		
  		<div class="detail-row">
                @foreach($ideas as $index => $ida) 
		  		<div class="detail-column">
		  			<div class="article-no"><label class="title"><a href="#;">{{ $ida->title }}</a></label></div>
		  			<p>{!! $ida->description !!}</p>

		  			@if(!empty($ideaids))


		  					@if (in_array($ida->id, $ideaids))
		  					<div class="competition">
		  						<div class="sec-row">
		  							<label class="col-sm-2 action"> Action :  Already in the Wishlist </label>		  		
				  				</div>
				  			</div>
				  			@else
		  			
		  			<div class="competition">
		  				<div class="sec-row">
		  					<label class="col-sm-2 action"> Action </label>
		  					<span class="col-sm-6">		  					
		                    	<form method="post" action="{{route('innovationapply')}}" class="clear">
		        				{{ csrf_field() }}        
		        					<input type="hidden" name="idea_id" value="{{$ida->id}}">
		            				<div class="col-md-12">    
		            					@if ($type == 1) 
		                                <button type="submit" class="btn btn-default yellow-btn">Send me to my competition</button>
		                                @elseif ($type == 2)
		                                <button type="submit" class="btn btn-default yellow-btn">Suggest solution and get reward</button>
		                                @endif                  					
		            				</div>
		        				</form>
	        				</span>
		  				</div>
		  			</div>

		  			@endif
						@else

						<div class="competition">
		  				<div class="sec-row">
		  					<label class="col-sm-2 action"> Action </label>
		  					<span class="col-sm-6">		  					
		                    	<form method="post" action="{{route('innovationapply')}}" class="clear">
		        				{{ csrf_field() }}        
		        					<input type="hidden" name="idea_id" value="{{$ida->id}}">
		            				<div class="col-md-12">    
		            					@if ($type == 1) 
		                                <button type="submit" class="btn btn-default yellow-btn">Send me to my competition</button>
		                                @elseif ($type == 2)
		                                <button type="submit" class="btn btn-default yellow-btn">Suggest solution and get reward</button>
		                                @endif                  					
		            				</div>
		        				</form>
	        				</span>
		  				</div>
		  			</div>

		  			@endif
		  		</div>
                @endforeach
  		</div>
  		
  		    
    </div>  
  </div>
</div>
</section>
@endsection

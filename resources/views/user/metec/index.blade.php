@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page pdb0">
  <div class="row mr0">
    @include('user.includes.links')
    <div class="col-md-9 user-rigtpart table-sec">
    	 @include('common.notify')
    	 
	 	<div class="right-sec col-md-4">
	 		<h3 class="short-heading"> Filters  </h3>
	 		<div class="filters">
	       	<form class="form-horizontal" action="{{route('index')}}" method="GET" role="form">
				{{csrf_field()}}	
	 			<div class="form-group">
		 			<label class="">Categories </label>
	            	<select name="ca_id" class="select">
	            		<option value="">Select Category</option>
	            		@foreach ($cats as $ca)
	            		<option value="{{$ca['id']}}"  @if($ca['id'] == $ca_id) selected="selected" @endif >{{$ca['name']}}</option>
	            		@endforeach                    		                    	
	            	</select>
				</div>
				
	 			
	 			<div class="form-group">
	 				<label> Keyword </label>
	            	<div class="form-group">
	                    <input type="text" name="keyword" value="{{$keyword}}" class="search-bar" placeholder="Type your Keyword.." /> 
			 			<button class="search-btn"> </button>
					</div>
				</div>
				
		 			
		 		<div class="form-group">
		 			<button type="submit" class="btn yellow">Search</button>
		 		</div>
	        </form> 
			</div>
 		</div>     
 		
 		    	
        <div class="left-sec col-md-8">
        <h1>Metec Posts</h1><br>
        
  			<div class="detail-row mr0">
                @foreach($mps as $index => $inv) 
                	
				  		<div class="detail-column">
				  			<div class="article-no"><label class="title"> <a href="{{route('viewpost',$inv->id)}}">{{ $inv->title }}</a></div>
				  			
				  			<div class="competition">
				  				<div class="sec-row">
				  					<label> Category </label>
				  					<span>
				  						{{ $inv->category->name }}
				  					</span>
				  				</div>
				  				<div class="sec-row">
				  					<label> Employee Name </label>
				  					 @if ($inv->user_id > 0)
					                    <span>{{ $inv->user->first_name }} {{ $inv->user->last_name}}</span>
		                    		@else
				                    <span>N/A</span>
				                    @endif
				  				</div>
				  				
				  				<div class="sec-row">
				  					<label> Position </label>
				  					 @if ($inv->user_id > 0)
					                    <span>{{ $inv->user->position }}</span>
		                    		@else
				                    <span>N/A</span>
				                    @endif
				  				</div>

				  				<div class="sec-row">
				  					<label> New Comments </label>

				  					<span>{{$comments[$inv->id][0]}}</span>
				  				</div>
				  				
				  				
				  				<form method="post" action="{{route('innovationapply')}}" class="clear">
			        				{{ csrf_field() }}   
					  				<div class="sec-row">
					  					<label> View </label>
					  					<span> <a href="{{route('viewpost',$inv->id)}}" class="apply btn yellow-btn">View Comments</a></span>
					  				</div>
				  				</form>
				  			</div>
				  		</div>
				  
                @endforeach
		  	</div>
		  	
		
     </div>
    </div>  
  </div>
</div>
</section>
@endsection

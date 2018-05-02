@extends('user.layout.app')
@section('content')
<section class="content marketing"> 


	<div class="left-sec col-md-8">
		<div class="cat-tags">
			<label>Search : </label><span class="tags"> {{$serach_name}} </span>
		</div>
	    @if($search) 
		    @foreach($search as $videos)
        		<div class="article-sec">
          			<h2 class="article-title"> {{$videos->title}} </h2>

				    
          			<div class="para">
	          			<?php echo substr(strip_tags($videos['description']), 0, 200) . '...';?>
          			</div>

          			
          			<a href="{{ url('/video/detail') }}/{{$videos->id}}" class="read-more"> Read More.. </a>
        		  		
        		</div>	
		@endforeach
	@endif
		
		
		
		</div>
	
			
</section>
@endsection
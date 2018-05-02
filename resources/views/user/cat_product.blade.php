@extends('user.layout.app')
@section('content')
<section class="content marketing details articles"> 

<div class="cat-tags">
			<label>Category : </label><span class="tags"> {{$cat_name->name}} </span>
	</div>  
	
 	
 	<div class="right-sec col-md-4"> 		
 		<div class="category-sec"> 			
 			<h3> Categories </h3>
 			<div class="scroll-way">
	 			<ul>
	 				@if($cats) 
						@foreach($cats as $cat)	
						  @if($cat->id == $cat_name->id)
			                <li class="active"> <a href="{{ url('/product/category')}}/{{$cat->id}}">{{$cat->name}} </a></li>
			              @else
			                <li> <a href="{{ url('/product/category')}}/{{$cat->id}}">{{$cat->name}} </a></li>
			              @endif
	 						
	 					@endforeach	
					@endif
	 			</ul> 		
 			</div>	
 		</div>

 		<div class="article-sec"> 			
 			<h3> Latest Articles </h3>
 			<div class="scroll-way">
 				@foreach($latest_articles as $latest)
		 			<div class="col-sm-12">
		 				<div class="short-para">
		 				<a href="{{ url('/article/detail') }}/{{$latest['id']}}"> {{$latest['title']}} </a>
		 				 <?php echo substr(strip_tags($latest['description']), 0, 100) . '...';?>
		 				</div> 		
		 				 
		 			</div>
	 			@endforeach
	 			
 			</div>	
	 			
	 			
	 		
 			</div>

 			<div class="article-sec"> 			
 			<h3> Latest Videos </h3>
 			<div class="scroll-way">
 				 @foreach($latest_videos as $videos)			
    	  			<div class="video-frame col-sm-12">
    	  				<div class="col-sm-4 pd0">  				
    	  				<iframe src="{{$videos->embd_code}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>  
    	  				</div>
    	  				<div class="col-sm-8">  				
    		  				<a class="titles" href="{{ url('/video/detail') }}/{{$videos->id}}"> {{$videos->title}} </a>
    		  				<span class="post-on"> Added {{$videos->created_at->diffForHumans()}}  </span>
    	  				</div>
    	  			</div>
	  			@endforeach	
	 			
 			</div>
	 			
	 			
	 		
 			</div>


 	</div>
 	
	<div class="left-sec col-md-8 list-section">

	@if($cat_article) 
		@foreach($cat_article as $videos)	
				<div class="products">
			<a href="{{ url('/product/detail') }}/{{$videos->id}}" class="inner-link">
  			<h2 class="product-name"> {{$videos->title}} </h2>
  			<!-- <div class="post-by"> <span class="post-on"> {{ $videos->created_at->format('M d, Y')}} by </span> <span class="user-name"> {{$videos->admin->first_name}} </span></div> -->

  			@if($videos->picture)
				<div class="products-img">
					<div class="img" style="background:url({{asset('/storage/'.$videos->picture)}}) no-repeat center center / cover;"> </div>
					<!-- <img src="{{asset('/storage/'.$videos->picture)}}"/> -->
				</div>
				    @endif
				    
          			<div class="para">
  						<?php echo substr(strip_tags($videos['description']), 0, 200) . '...';?>
  					</div>
  			
	  		</a>		  
	  		
  			<a class="read-more" href="{{ url('/product/detail') }}/{{$videos->id}}"> View Product </a>

	  				
		</div>
        	@endforeach

	@endif		
		
			
		
		

 	</div>
		
			
</section>
@endsection
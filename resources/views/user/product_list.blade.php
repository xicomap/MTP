@extends('user.layout.app')
@section('content')
<section class="content marketing details articles product-list">   
	
	<div class="col-md-8">
		<h4 class="short-heading"> Recent Products </h4>
		<div class="left-sec list-section">
			
	
		@if($cat_article) 
			@foreach($cat_article as $videos)
			<div class="products">
				<a href="{{ url('/product/detail') }}/{{$videos->id}}" class="inner-link">
	  			<h2 class="product-name"> {{$videos->title}} </h2>
	  			
	  			@if($videos->picture)
					<div class="products-img">
						<div class="img" style="background:url({{asset('/storage/'.$videos->picture)}}) no-repeat center center / cover;"> </div>
						
					</div>
					    @endif
					    
	          			<div class="para">
	  						<?php echo substr(strip_tags($videos['description']), 0, 200) . '...';?>
	  					</div>
	  			
		  		</a>		  
		  		
	  			<a class="read-more" href="{{ url('/product/detail') }}/{{$videos->id}}"> View Product </a>
	
		  				
			</div>
			@endforeach
			
			<?php echo $cat_article->render(); ?>
		@else
		  	   <p>No Recent Products at this moment </p>
	  	@endif

		@if($related_video)
		<h4 class="short-heading mt20"> Featured Products </h4>
			@foreach($related_video as $videos)
				<div class="products">
						<a href="{{ url('/product/detail') }}/{{$videos->id}}" class="inner-link">
			  			<h2 class="product-name"> {{$videos->title}} </h2>
			  			
			  			@if($videos->picture)
							<div class="products-img">
								<div class="img" style="background:url({{asset('/storage/'.$videos->picture)}}) no-repeat center center / cover;"> </div>
								<!-- <img src="{{asset('/storage/'.$videos->picture)}}"/> -->
							</div>
							    @endif
			  			<?php echo substr(strip_tags($videos['description']), 0, 200) . '...';?>
				  		</a>		  		
			  			<a class="read-more" href="{{ url('/product/detail') }}/{{$videos->id}}"> View Product </a>
			
				  		
			</div>
			@endforeach
		@else
		  	   <p>No Products at this moment </p>
	  	@endif


	
	 	</div>
 	</div>
 	
 	
 	<div class="right-sec col-md-4">

 		<div class="category-sec"> 			
 			<h3> Categories </h3>
 			<div class="scroll-way">
	 			<ul>
	 				@if($cats) 
						@foreach($cats as $cat)	
	 						<li> <a href="{{ url('/product/category')}}/{{$cat->id}}">{{$cat->name}} </a></li>
	 					@endforeach	
					@endif
	 			</ul> 		
 			</div>	
 		</div>


 			<div class="article-sec"> 			
 			<h3> Latest Articles </h3>
 			<div class="scroll-way">
 			@if($latest_articles) 
 				@foreach($latest_articles as $latest)
		 			<div class="col-sm-12">
		 				<div class="short-para">
		 				<a href="{{ url('/article/detail') }}/{{$latest['id']}}"> {{$latest['title']}} </a>
		 				 <?php echo substr(strip_tags($latest['description']), 0, 100) . '...';?>
		 				 </div>		
		 				 
		 			</div>
	 			@endforeach

  			@else
		  	   <p>No Latest Articles at this moment </p>
	  		@endif
	 			
 			</div>	
	 			
	 			
	 		
 			</div>

 			<div class="article-sec"> 			
 			<h3> Latest Videos </h3>
 			<div class="scroll-way">
 			@if($latest_videos)
 				 @foreach($latest_videos as $videos)			
    	  			<div class="video-frame col-sm-12">
			  			<a class="overlap" href="{{ url('/video/detail') }}/{{$videos->id}}"> </a>
    	  				<div class="col-sm-4 pd0">  				
    	  				<iframe src="{{$videos->embd_code}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>  
    	  				</div>
    	  				<div class="col-sm-8">  				
    		  				<a class="titles" href="{{ url('/video/detail') }}/{{$videos->id}}"> {{$videos->title}} </a>
    		  				<span class="post-on"> Added {{$videos->created_at->diffForHumans()}}  </span>
    	  				</div>
    	  			</div>
	  			@endforeach	
	  		@else
		  	   <p>No Latest Videos at this moment </p>
	  		@endif
	 			
 			</div>
	 			
	 			
	 		
 			</div>


 		</div>	
 	</div>
		
			
</section>
@endsection
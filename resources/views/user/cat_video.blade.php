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
			                <li class="active"> <a href="{{ url('/video/category')}}/{{$cat->id}}">{{$cat->name}} </a></li>
			              @else
			                <li> <a href="{{ url('/video/category')}}/{{$cat->id}}">{{$cat->name}} </a></li>
			              @endif	
	 						
	 					@endforeach	
					@endif
	 				
	 			</ul> 		
 			</div>

 			@if($latest_articles) 
 		<div class="article-sec"> 			
 			<h3> Latest Articles </h3>
 			<div class="scroll-way">
 				@foreach($latest_articles as $latest)
		 			<div class="col-sm-12">
		 				<a href="{{ url('/article/detail') }}/{{$latest['id']}}"> {{$latest['title']}} </a>
		 				 <?php echo substr($latest['description'], 0, 100) . '...';?>		
		 				 
		 			</div>
	 			@endforeach
	 			
 			</div>			
 		</div>
 	@endif
 		
 	@if($featured_product)	
 		<div class="product-sec"> 			
	 		<h3> Featured Product </h3>
	 			<div class="scroll-way">
	 				@foreach($featured_product as $product)	 				
			  			<div class="product-cat col-sm-6">
						  	<div class="product-img">
						  		<div class="img" style="background: url({{asset('/storage/'.$product->picture)}}) no-repeat center center / cover;"> </div>
			  					<!-- <img class="video-img" src="{{asset('/storage/'.$product->picture)}}" /> -->
			  				</div>  				
			  				<a class="titles" href="{{$product->url}}" target="_blank">  {{$product->title}}</a>
			  				<span class="post-on">  Added {{$product->created_at->diffForHumans()}}  </span>
			  			</div>
			  		@endforeach
		  			
		  		</div>	
	 	</div>
 		
 	@endif	
 		</div>	
 	</div>
		
	
	<div class="left-sec col-md-8">

	@if($cat_video) 
		@foreach($cat_video as $videos)	
			<div class="article-sec">
	  			<h2 class="article-title"> {{$videos->title}} </h2>
	  			<div class="post-by"> <span class="post-on"> Feb 17, 2016 by </span> <span class="user-name"> Mr. Admin </span></div>
	  			 <?php echo substr($videos['description'], 0, 200) . '...';?>

		  		<div class="video-sec">
		  			<iframe src="{{$videos->embd_code}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		  			<!-- <a class="link" href="{{ url('/video/detail') }}/{{$videos->id}}"> {{$videos->title}} </a> -->
		  			<a href="{{ url('/video/detail') }}/{{$videos->id}}" class="read-more"> Read More.. </a>
		  		</div>  		  		
			</div>
		@endforeach	
	@endif	
		
		
		

 	</div>
 	
			
</section>
@endsection
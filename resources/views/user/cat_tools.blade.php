@extends('user.layout.app')
@section('content')
<section class="content marketing">   
	

 	<div class="right-sec col-md-4">
 		<h3> Filters  </h3>
 		<div class="filters">
 		<form action="{{ url('tool/search') }}" method="POST" role="search">
	 		{{ csrf_field() }}
 			<div class="form-group">
	 			<label class="">Categories </label>
	 			{!! dropdown('branch_name',$cats, $cat_id ,['class' => 'select']) !!}
	 			
 			</div>
 			
 			<div class="form-group">
 				<label> Keyword </label>
            	<div class="form-group">
		 			<input class="search-bar" placeholder="Type your Keyword.." name="q" type="text">
		 			<button class="search-btn"> </button>
	 			</div>
	 		</div>
	 			
	 		<div class="form-group">
	 			<button class="btn yellow" type="submit">Search </button>
	 		</div>
	 	</form>
 		</div>
 	
  		
 		
 		</div>	
			
	
	<div class="left-sec col-md-8">
		<h3>  Tools and Machinaries  </h3>  	
	<div class="details">
			<dl>
				<dt>
					Catagory
				</dt>
				<dd>
				@if($cat_name)
					{{$cat_name->name}}
				@endif
				</dd>
			</dl>
		</div> 
  			
  		
  	
  		
  		<div class="detail-row">

  		@if($tools) 
  		@foreach($tools as $tool)

  		@if(Auth::guard('user')->check() OR (Auth::guard('user')->check() && (Auth::guard('user')->user()->user_type == 6) ) )

		  	
  		
	  		<div class="detail-column">
	  			<div class="article-no"><label class="title"> {{$tool->title}} </label></div>
	  			
	  			<div class="description-sec">
	  				<?php echo strip_tags($tool->description);?>
	  			</div>
	  			
	  			<div class="download-sec">
	  			  	@if($tool->pdf)
				      <a href="{{asset('/storage/'.$tool->pdf)}}" class="view-btn btn yellow" download>View/Download PDF</a>
				    @endif
	  				
	  			</div>
	  				@if($tool->private == 1) 
	  			
		  				<div class="private tag"> Private</div>
		  			@endif

	  			

	  		</div>
	  		@else

	  		<div class="detail-column">
	  			<div class="article-no"><label class="title"> {{$tool->title}} </label></div>
	  			
	  			<div class="description-sec">
	  				<?php echo strip_tags($tool->description);?>
	  			</div>
	  			
	  			<div class="download-sec">
	  			  	@if($tool->pdf)
				      <a href="{{asset('/storage/'.$tool->pdf)}}" class="view-btn btn yellow" download>View/Download PDF</a>
				    @endif
	  				
	  			</div>
	  				
	  			

	  		</div>

	  		@endif
	  		@endforeach
	  		<?php echo $tools->render(); ?>
	  	@endif
	  		
	  	
  		</div>
  		
  		<div class="para">
  			<p> Suggest additional tools or machanary manual contact <a href="#_">Support team</a> </p>
  		</div>
 	</div>
</section>
@endsection
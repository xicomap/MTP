@extends('user.layout.app')
@section('content')
<section class="content marketing">   
	

 	<div class="right-sec col-md-4">
 		<h3> Filters  </h3>
 		<div class="filters">		

 			<form action="{{ url('rule/search') }}" method="POST" role="search">
 			 {{ csrf_field() }}
	 			<div class="form-group">
		 			<label class="">Branch </label>
		 			{!! dropdown('branch_name',$branch, $branch_id ,['class' => 'select']) !!}

		 			
	 			</div>
	 			
	 			<div class="form-group">
		 			<label class="">Department  </label>
		 			{!! dropdown('department_name',$dept, $department_id, ['class' => 'select']) !!}
	 			</div>
	 			
	 			<div class="form-group">
	 				<label> Keyword</label>
	            	<div class="form-group">
			 			<input class="search-bar" placeholder="Type your Keyword.." name="q" type="text" value="{{$term}}">
			 			
		 			</div>
		 		</div>
		 		
		 		<div class="form-group">
		 			<button class="btn yellow" type="submit">Search </button>
		 		</div>
	 		</form>
 		</div>
 		</div>	
			
	<div class="left-sec col-md-8">
		<h3>  Rules and regulation  </h3>  	
		
		
		<div class="details">
			<dl>
				<dt>
					Branch
				</dt>
				<dd>
					{{$branch_name}}
				</dd>
			</dl>
			<dl>
				<dt>
					Department
				</dt>
				<dd>
					{{$department_name}}
				</dd>
			</dl>
		</div>
  	
	  <div class="detail-row">
  		@if($rules) 
  		@foreach($rules as $tool)
  		
	  		<div class="detail-column">

	  			@if(Auth::guard('user')->check() OR (Auth::guard('user')->check() && (Auth::guard('user')->user()->user_type == 6) ) )

	  			<div class="article-no"><label class="title"> {{$tool->article_number}}</label> <strong>  </strong></div>
	  			
	  			<div class="description-sec">
	  				<?php echo strip_tags($tool->description);?>
	  			</div>
	  			
	  			<div class="download-sec">
	  				@if($tool->pdf)
	  				<a href="{{asset('/storage/'.$tool->pdf)}}" class="view-btn btn yellow" download> View/Download PDF</a>
	  				@endif	  			
	  				<div class="branches">
	  					<div class="details">
							<dl>
								<dd>
									{{$branch_name}}
								</dd>
							</dl>
							<dl>
								<dd>
									{{$department_name}}
								</dd>
							</dl>
						</div>	  					
	  				</div>
	  			</div>		  			

		  			@if($tool->private == 1) 
		  				<div class="private tag"> Private</div>
		  			@endif

		  		@else
		  			<div class="article-no"><label class="title"> {{$tool->article_number}}</label> <strong>  </strong></div>
	  			
	  			<div class="description-sec">
	  				<?php echo strip_tags($tool->description);?>
	  			</div>
	  			
	  			<div class="download-sec">
	  				@if($tool->pdf)
	  				<a href="{{asset('/storage/'.$tool->pdf)}}" class="view-btn btn yellow" download> View/Download PDF</a>
	  				@endif	  			
	  				<div class="branches">
	  					<div class="details">
							<dl>
								<dd>
									{{$branch_name}}
								</dd>
							</dl>
							<dl>
								<dd>
									{{$department_name}}
								</dd>
							</dl>
						</div>	  					
	  				</div>
	  			</div>	



	  			@endif 		
			</div>
			
	  		@endforeach
	  		<?php echo $rules->render(); ?>
	  	@endif
	  </div>
	  	
  	
  		
  		<div class="para">
  			<p> Suggest additional Rules and regulation detail contact <a href="#_">Support team</a> </p>
  		</div>
 	</div>
</section>

<script type="text/javascript">
 	$(document).ready(function(){
 		$("#branch_name").change(function(){
 			var selected_category = $("#branch_name").val();
 			console.log(selected_category);
 			$.ajax({
	           type:'POST',
	           url:"{{ url('x') }}",
	           data:{'_token':'<?php echo csrf_token() ?>', 'category_name': selected_category},
	           success:function(data){

	                   console.log(data); 
	                   $("#department_name").html('');
	                    $("#department_name").html(data);    
	             
	           }
	        });
 		});
    });    
</script>
@endsection
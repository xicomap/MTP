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
		 			<select class="select" id="branch_name" name="branch_name" required>
		 				<option value="">Select Branch</option>
		 				@foreach($branch as $cat)
		 				<option value="{{$cat['id']}}">{{$cat['name']}}</option>
		 			@endforeach 				
		 			</select>

		 			
	 			</div>
	 			
	 			<div class="form-group">
		 			<label class="">Department  </label>
		 			<select class="select" id="department_name" name="department_name" required>
		 			<option value="">Select Department</option>
		 				@foreach($dept as $cat)
		 				<option value="#">{{$cat['name']}}</option>
		 			@endforeach 				
		 			</select>
	 			</div>
	 			
	 			<div class="form-group">
	 				<label> Keyword</label>
	            	<div class="form-group">
			 			<input class="search-bar" placeholder="Type your Keyword.." name="q" type="text" >
			 			
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
		
		
	<!-- 	<div class="details">
			<dl>
				<dt>
					Branch
				</dt>
				<dd>
					Branch one
				</dd>
			</dl>
			<dl>
				<dt>
					Department
				</dt>
				<dd>
					Marketing
				</dd>
			</dl>
		</div> -->	 
  		<!-- <div class="detail-row">
  			<div class="tr">
  				<div class="th"> No. </div>
  				<div class="th"> Article No. </div>
  				<div class="th"> description </div>
  				<div class="th"> PDF </div>
  			</div>
  			<div class="tr">
  				<div class="td">1.</div>
  				<div class="td">Artice 5</div>
  				<div class="td"> detail ...</div>
  				<div class="td"> <a href="#_" class="view-btn btn yellow"> View/Download PDF</a></div>
  			</div>
  			<div class="tr">
  				<div class="td">2.</div>
  				<div class="td">Artice 10</div>
  				<div class="td">  Cutter...</div>
  				<div class="td"> <a href="#_" class="view-btn btn yellow"> View/Download PDF</a></div>
  			</div>
  			<div class="tr">
  				<div class="td">3.</div>
  				<div class="td">Artice 13</div>
  				<div class="td">short detail here ...	</div>
  				<div class="td"> <a href="#_" class="view-btn btn yellow"> View/Download PDF</a></div>
  			</div>
  		</div> -->
	  <div class="detail-row">
  		@if($rules) 
  		@foreach($rules as $tool)
  		
	  		<div class="detail-column">
	  			<div class="article-no"><label class="title"> {{$tool->article_number}}</label> <strong>  </strong></div>
	  			
	  			<div class="description-sec">
	  				<?php echo strip_tags($tool->description);?>
	  			</div>
	  			
	  			<div class="download-sec">
	  				@if($tool->pdf)
	  				<a href="{{asset('/storage/'.$tool->pdf)}}" class="view-btn btn yellow" download> View/Download PDF</a>
	  				@endif	  			
	  				<div class="branches">
	  					<!-- <div class="details">
							<dl>
								<dd>
									Eithopia
								</dd>
							</dl>
							<dl>
								<dd>
									Machinery
								</dd>
							</dl>
						</div>	 -->  					
	  				</div>
	  			</div>

	  			@if($tool->private == 1) 
	  				<div class="private tag"> Private</div>
	  			@endif	  		
			</div>
			
	  		@endforeach
	  		<?php echo $rules->render(); ?>

	  		@else
	  		<p> Sorry no rules found with the search keywords </p>
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


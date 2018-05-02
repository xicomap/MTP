@extends('admin.layout.base')

@section('title', 'Update Idea ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.rule.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Update Rule</h5>

            <form class="form-horizontal" action="{{route('admin.rule.update', $rule->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Branch Name</label>
					<div class="col-xs-10">
						{!! dropdown('branch_name',$branch , $rule->branch_name) !!}
						
					</div>
				</div>
				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Department Name</label>
					<div class="col-xs-10">
						<!-- <input class="form-control" type="text" value="{{ $rule->department_name }}" name="department_name" required id="department_name" placeholder="Department Name"> -->

						{!! dropdown('department_name',$department,$rule->branch_name) !!}
					</div>
				</div>
				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Article Number</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $rule->article_number }}" name="article_number" required id="article_number" placeholder="Article Number">
					</div>
				</div>
				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Description</label>
					<div class="col-xs-10">
						<textarea name="description" id="myeditor">{{ $rule->description }}</textarea>
					</div>
				</div>	
		
				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Private</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="private" id="status1" {{ @($rule->private == 1) ? "checked='checked'" : '' }}> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="private" id="status2" {{ @($rule->private == 0) ? "checked='checked'" : '' }}> No</label> 									 
					</div>
				</div>


				<div class="form-group row">
 					<label for="picture" class="col-xs-12 col-form-label">PDF</label>
					<div class="col-xs-10">
 						<input type="file" accept="pdf/*" name="pdf" class="dropify form-control-file" id="pdf_link" aria-describedby="fileHelp" required>
					</div>
 				</div>			

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update Rule</button>
						<a href="{{route('admin.rule.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>
@endsection


@section('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('myeditor');
</script>

<script type="text/javascript">
     $(function(){
     	$( "#branch_name" ).change(function() {
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
     })	
</script>
@endsection
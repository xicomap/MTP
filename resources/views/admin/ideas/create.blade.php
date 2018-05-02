@extends('admin.layout.base')

@section('title', 'Idea ')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.idea.index') }}?type={{$type}}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">New {{$heading}}</h5>

            <form class="form-horizontal" action="{{route('admin.idea.store')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}      
            	<input type="hidden" name="type" value="{{$type}}" id="type">  
            	
            	@if ($type == 3 | $type == 4)
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Select Category</label>
					<div class="col-xs-10">
						{!! dropdown('category_id',$cats) !!}	
					</div>
				</div>
				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Select Industry</label>
					<div class="col-xs-10">
						{!! dropdown('industry_id',$inds) !!}	
					</div>
				</div>
            	@endif
            	    	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Compition ID</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ old('compid') }}" name="compid" required id="compid" placeholder="Compition Id">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Title</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ old('title') }}" name="title" required id="title" placeholder="Title">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Description</label>
					<div class="col-xs-10">
						<textarea name="description" id="myeditor"></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Publish</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="publish" id="publish"> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="publish" id="publish"> No</label> 									 
					</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Approve</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="approve" id="approve"> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="approve" id="approve"> No</label> 									 
					</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Active</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="active" id="active"> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="active" id="active"> No</label> 									 
					</div>
				</div>				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Start Date</label>
					<div class="col-xs-10">
						<input class="form-control date" type="text" name="start_date" required id="StartDate" readonly>
					</div>
				</div>		
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">End Date</label>
					<div class="col-xs-10">
						<input class="form-control date" type="text" name="end_date" required id="EndDate" readonly>
					</div>
				</div>						
<!-- 				<div class="form-group row"> -->
<!-- 					<label for="picture" class="col-xs-12 col-form-label">@lang('admin.picture')</label> -->
<!-- 					<div class="col-xs-10"> -->
<!-- 						<input type="file" accept="image/*" name="picture" class="dropify form-control-file" id="picture" aria-describedby="fileHelp"> -->
<!-- 					</div> -->
<!-- 				</div> -->

				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Create</button>
						<a href="{{route('admin.idea.index')}}?type={{$type}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div> 
<script type="text/javascript">
    $('.date').datepicker({  
       format: 'mm-dd-yyyy'
     });  
</script> 
@endsection
@section('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('myeditor');
</script>
@endsection
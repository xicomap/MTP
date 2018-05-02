@extends('admin.layout.base')

@section('title', 'Update Idea ')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.idea.index') }}?type={{$idea->type}}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Update {{$heading}}</h5>

            <form class="form-horizontal" action="{{route('admin.idea.update', $idea->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">
            	
            	@if ($idea->type == 3 || $idea->type == 4)
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Select Category</label>
					<div class="col-xs-10">
						{!! dropdown('category_id',$cats, $idea->category_id) !!}	
					</div>
				</div>
				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Select Industry</label>
					<div class="col-xs-10">
						{!! dropdown('industry_id',$inds, $idea->industry_id) !!}	
					</div>
				</div>
            	@endif
            	<div class="form-group row">
            		@if ($idea->type == 1)
						<label for="first_name" class="col-xs-12 col-form-label">Compition ID</label>
					@elseif ($idea->type == 2)
						<label for="first_name" class="col-xs-12 col-form-label">Challenge ID</label>
					@endif
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $idea->compid }}" name="compid" required id="compid" placeholder="Compition Id">
					</div>
				</div>
				
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Title</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $idea->title }}" name="title" required id="title" placeholder="First Name">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Description</label>
					<div class="col-xs-10">
						<textarea name="description" id="myeditor">{{ $idea->description }}</textarea>
					</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Publish</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="publish"  {{ @($idea->publish == 1) ? "checked='checked'" : '' }}> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="publish" {{ @($idea->publish == 0) ? "checked='checked'" : '' }}> No</label> 									 
					</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Approve</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="approve" {{ @($idea->approve == 1) ? "checked='checked'" : '' }}> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="approve" {{ @($idea->approve == 0) ? "checked='checked'" : '' }}> No</label> 									 
					</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Active</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="active" {{ @($idea->active == 1) ? "checked='checked'" : '' }}> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="active" {{ @($idea->active == 0) ? "checked='checked'" : '' }}> No</label> 									 
					</div>
				</div>				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Start Date</label>
					<div class="col-xs-10">
						<input class="form-control date" type="text" name="start_date" required id="StartDate" readonly value=" {{ originalDate($idea->start_date) }} ">
					</div>
				</div>		
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">End Date</label>
					<div class="col-xs-10">
						<input class="form-control date" type="text" name="end_date" required id="EndDate" readonly  value=" {{ originalDate($idea->end_date) }} ">
					</div>
				</div>		

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{route('admin.idea.index')}}?type={{$idea->type}}" class="btn btn-default">@lang('admin.cancel')</a>
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
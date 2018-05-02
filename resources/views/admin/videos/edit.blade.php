@extends('admin.layout.base')

@section('title', 'Products ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.video.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Update Video</h5>

            <form class="form-horizontal" action="{{route('admin.video.update', $video->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Select Category</label>
					<div class="col-xs-10">
						{!! dropdown('category_id',$cats, $video->category_id) !!}	
					</div>
				</div>
				
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Title</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $video->title }}" name="title" required id="title" placeholder="Video Title">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Description</label>
					<div class="col-xs-10">
						<textarea name="description" id="myeditor">{{ $video->description }}</textarea>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Embed Code</label>
					<div class="col-xs-10">
						<textarea name="embd_code" class="form-control" style="height:100px;">{{ $video->embd_code }}</textarea>
					</div>
				</div>
				
				<div class="form-group row">
					
					@if(!empty($featured_video))
						<label for="mobile" class="col-xs-12 col-form-label">Featured ( There can be only one Featured Video )</label>
					@else
						<label for="mobile" class="col-xs-12 col-form-label">Featured</label>
					@endif
					<div class="col-sm-9">	

					@if(!empty($featured_video))								
						<label class="radio-inline"> <input type="radio" value="1" name="is_featured" id="featured1" disabled="disabled" {{ @($video->is_featured == 1) ? "checked='checked'" : '' }}> Yes </label> 

					@else
						<label class="radio-inline"> <input type="radio" value="1" name="is_featured" id="featured1" {{ @($video->is_featured == 1) ? "checked='checked'" : '' }}> Yes </label> 
					@endif								
						
						<label class="radio-inline"> <input type="radio" value="0" name="is_featured" id="featured2" {{ @($video->is_featured == 0) ? "checked='checked'" : '' }}> No</label> 									 
					</div>
				</div>
				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Private</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="is_private" id="private1" {{ @($video->is_private == 1) ? "checked='checked'" : '' }}> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="is_private" id="private2" {{ @($video->is_private == 0) ? "checked='checked'" : '' }}> No</label> 									 
					</div>
				</div>
				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Status</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="status" id="status1" {{ @($video->status == 1) ? "checked='checked'" : '' }}> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="status" id="status2" {{ @($video->status == 0) ? "checked='checked'" : '' }}> No</label> 									 
					</div>
				</div>	

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{route('admin.product.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
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
@endsection
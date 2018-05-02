@extends('admin.layout.base')

@section('title', 'Articles ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.article.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Update Article</h5>

            <form class="form-horizontal" action="{{route('admin.article.update', $article->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Select Category</label>
					<div class="col-xs-10">
						{!! dropdown('category_id',$cats, $article->category_id) !!}	
					</div>
				</div>
				
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Title</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $article->title }}" name="title" required id="title" placeholder="Article Title">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Description</label>
					<div class="col-xs-10">
						<textarea name="description" id="myeditor">{{ $article->description }}</textarea>
					</div>
				</div>

				<div class="form-group row">
 					<label for="picture" class="col-xs-12 col-form-label">@lang('admin.picture')</label>
					<div class="col-xs-10">
 						<input type="file" accept="image/*" name="picture" class="dropify form-control-file" id="picture" aria-describedby="fileHelp">
					</div>
 				</div>
				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Status</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="status" id="status1" {{ @($article->status == 1) ? "checked='checked'" : '' }}> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="status" id="status2" {{ @($article->status == 0) ? "checked='checked'" : '' }}> No</label> 									 
					</div>
				</div>	

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{route('admin.article.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
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
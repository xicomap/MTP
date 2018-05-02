@extends('admin.layout.base')

@section('title', 'Mlt Posts ')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.mlt.index') }}?type={{$mp->type}}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">{{$heading}}</h5>

                 <form class="form-horizontal" action="{{route('admin.mlt.update', $mp->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH"> 	
            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Mlt ID</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $mp->mlt_id }}" name="mlt_id" required id="mlt_id" placeholder="MLT ID">
					</div>
				</div>
				
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Select Category</label>
					<div class="col-xs-10">
						{!! dropdown('category_id',$cats, $mp->category_id) !!}	
					</div>
				</div>         	
				
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Title</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $mp->title }}" name="title" required id="title" placeholder="Title">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Description</label>
					<div class="col-xs-10">
						<textarea name="description" id="myeditor">{{ $mp->description }}</textarea>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Upload Image</label>
					@if($mp->picture_file != "")
                     <img src="{{ asset('/storage/'.$mp->picture_file) }}" width=100/>                    
                    @endif
					<div class="col-xs-6">
                        <label class="input-group-btn">
                          <span class="btn btn-primary attach">
                            <img src="{{asset('/asset/images/file.png')}}" alt="" /> <input type="file" style="display: none;" name="picture">
                          </span>
                        </label>
                    <input type="text" class="form-control upload-btn" disabled="" id="picturetext" placeholder="Select file to upload" style="max-width:100%; min-width:255px;">
                  </div>
				</div>
				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Upload Video</label>
					@if($mp->video_file != "")
                    	 <video height="100" controls>
                              <source src="{{ asset('/storage/'.$mp->video_file) }}" type="video/mp4">  
                        </video>
                    @endif
					<div class="col-xs-6">
                        <label class="input-group-btn">
                          <span class="btn btn-primary attach">
                            <img src="{{asset('/asset/images/file.png')}}" alt="" /> <input type="file" style="display: none;" name="video">
                          </span>
                        </label>
                    <input type="text" class="form-control upload-btn" disabled="" id="videotext" placeholder="Select file to upload" style="max-width:100%; min-width:255px;">
                  </div>
				</div>
				
				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Status</label>
					<div class="col-xs-2">
						<select class="form-control" name="status" id="status">
							<option value="0" @if($mp->status == 0) selected @endif >Waiting</option>
							<option value="1" @if($mp->status == 1) selected @endif>Approve</option>
							<option value="2" @if($mp->status == 2) selected @endif>Decline</option>
							<option value="2" @if($mp->status == 3) selected @endif>Hide</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{route('admin.mlt.index')}}?type={{$mp->type}}" class="btn btn-default">@lang('admin.cancel')</a>
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
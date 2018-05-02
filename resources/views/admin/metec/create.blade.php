@extends('admin.layout.base')

@section('title', 'Metec Posts ')

@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.metec.index') }}?type=1" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">New Post</h5>

            <form class="form-horizontal" action="{{route('admin.metec.store')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}      
            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Metec ID</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="metec_id" required id="metec_id" placeholder="METEC ID">
					</div>
				</div>
				    	            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Select Category</label>
					<div class="col-xs-10">
						{!! dropdown('category_id',$cats) !!}	
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
					<label for="mobile" class="col-xs-12 col-form-label">Upload Image</label>
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
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Create</button>
						<a href="{{route('admin.metec.index')}}?type=1" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div> 
<script type="text/javascript">  
 	 $(document).ready(function(){
         $('input[type="file"]').change(function(e){
             var fileName = e.target.files[0].name;
             var name = $(this).attr('name');
             $("#"+name+"text").val(fileName +  ' selected');            
         });
     }); 
</script>  
@section('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('myeditor');
</script>
@endsection
@endsection
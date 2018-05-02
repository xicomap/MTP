@extends('admin.layout.base')

@section('title', 'Mlt Page Manager ')

@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.mlt.index') }}?type=1" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">MLT Page Manager</h5>

            <form class="form-horizontal" action="{{route('admin.mlt.updatepage')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}                  	

				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Upload Banner</label>
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
					<label for="last_name" class="col-xs-12 col-form-label">Page Text</label>
					<div class="col-xs-10">
						<textarea name="description" id="myeditor">{{$mp->description}}</textarea>
					</div>
				</div>	
				
				

				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update</button>						
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
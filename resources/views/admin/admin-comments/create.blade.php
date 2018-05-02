@extends('admin.layout.base')

@section('title', 'Articles ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.commentsettings') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">New Condition</h5>

            <form class="form-horizontal" action="{{route('admin.addcommentsetting')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}      
            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Select Name</label>
					<div class="col-xs-10">
						<select id="category_id" class="form-control" name="category_id" required="">
							<option value="">Select</option>
							<option value="Article">Article</option>
							<option value="Products">Products</option>
							<option value="Videos">Videos</option>
						</select>	
					</div>
				</div>					
				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Status</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="status" id="status1"> Only Registered User </label> 
						<label class="radio-inline"> <input type="radio" value="2" name="status" id="status2"> All Visitors</label> 
						<label class="radio-inline"> <input type="radio" value="3" name="status" id="status2"> Disable Comments</label> 									 
					</div>
				</div>

				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Create</button>
						<a href="{{route('admin.commentsettings')}}" class="btn btn-default">@lang('admin.cancel')</a>
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
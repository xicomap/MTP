@extends('admin.layout.base')

@section('title', 'Add User ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.user.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Footer Content</h5>

            <form class="form-horizontal" action="{{route('admin.footersettings')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Content</label>
					<div class="col-xs-10">
						<textarea name="content" id="content" required class="col-xs-10">{!! $setting->content !!}</textarea>				
					</div>
				</div>

				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Add</button>
						<a href="{{route('admin.user.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
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
    CKEDITOR.replace('content');
</script>
@endsection

@extends('admin.layout.base')

@section('title', 'Email Message ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.article.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Update Email Message</h5>

            <form class="form-horizontal" action="{{url('admin/update/email', $setting->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $setting->name }}" name="name" id="name" placeholder="Title" readonly="readonly">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Message</label>
					<div class="col-xs-10">
						<textarea name="message" id="myeditor">{{ $setting->message }}</textarea>
					</div>
				</div>

				
			    <input type="hidden" name="type" id="type" value="{{$setting->type}}" />

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{url('admin/emailsettings')}}" class="btn btn-default">@lang('admin.cancel')</a>
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
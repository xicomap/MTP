@extends('admin.layout.base')

@section('title', 'Add User ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.user.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Header Settings</h5>

            <form class="form-horizontal" action="{{route('admin.settings')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Script</label>
					<div class="col-xs-10">
						<textarea name="script" id="script" required class="col-xs-10">{!! $setting->script !!}</textarea>				
					</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Publish</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="publish" id="publish" {{ @($setting->publish == 1) ? "checked='checked'" : '' }}> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="publish" id="publish" {{ @($setting->publish == 0) ? "checked='checked'" : '' }}> No</label> 									 
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

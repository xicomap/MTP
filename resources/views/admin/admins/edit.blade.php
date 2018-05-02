@extends('admin.layout.base')

@section('title', 'Update Subadmin ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.admin.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Update Subadmin</h5>

            <form class="form-horizontal" action="{{route('admin.admin.update', $admin->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">
            	<div class="form-group row">
					<label for="first_name" class="col-xs-2 col-form-label">User Type</label>
					<div class="col-xs-10">
						{!! roleTypeDropdown($admin->role_id) !!}						
					</div>
				</div>
				<div class="form-group row">
					<label for="first_name" class="col-xs-2 col-form-label">@lang('admin.first_name')</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $admin->first_name }}" name="first_name" required id="first_name" placeholder="First Name">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-2 col-form-label">@lang('admin.last_name')</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $admin->last_name }}" name="last_name" required id="last_name" placeholder="Last Name">
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-xs-2 col-form-label">@lang('admin.email')</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $admin->email }}" name="email" required id="email" placeholder="Email">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Status</label>
					<div class="col-xs-10">
						<input class="form-control" type="checkbox" name="status" id="status" value="1" {{ @($admin->status == 1) ? 'checked' : ''}} >
					</div>
				</div>	

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update Admin User</button>
						<a href="{{route('admin.user.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection

@extends('admin.layout.base')
@section('title', 'Update Idea ')
@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('pcs.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">View Public Challenge</h5>

            <form class="form-horizontal" action="{{route('pcs.update', $pc->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Name</label>
					<div class="col-xs-10">
						{{$pc->name}}
					</div>
				</div>
				
				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Email</label>
					<div class="col-xs-10">
						{{$pc->email}}
					</div>
				</div>
				
				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Mobile</label>
					<div class="col-xs-10">
						{{$pc->mobile}}
					</div>
				</div>
				
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Title</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $pc->title }}" name="title" required id="title" placeholder="First Name">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Description</label>
					<div class="col-xs-10">
						<textarea name="description" id="myeditor" class="form-control" rows="5">{{ $pc->description }}</textarea>
					</div>
				</div>

				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Status</label>
					<div class="col-xs-2">
						<select class="form-control" name="status" id="status">
							<option value="0" @if($pc->status == 0) selected @endif >Waiting</option>
							<option value="1" @if($pc->status == 1) selected @endif>Approve</option>
							<option value="2" @if($pc->status == 2) selected @endif>Decline</option>
						</select>
					</div>
				</div>	

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{route('pcs.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>
@endsection
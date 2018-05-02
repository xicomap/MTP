@extends('admin.layout.base')

@section('title', 'Industrires ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.industry.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Add Industry</h5>

            <form class="form-horizontal" action="{{route('admin.industry.store')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}            	
				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ old('name') }}" name="name" required id="name" placeholder="Industry Name">
					</div>
				</div>

				

				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Add Industry</button>
						<a href="{{route('admin.industry.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div> 
@endsection
@extends('admin.layout.base')

@section('title', 'Update Idea ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.branchrule.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Update Branch</h5>

            <form class="form-horizontal" action="{{route('admin.branchrule.update', $category->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $category->name }}" name="name" required id="name" placeholder="Category Name">
					</div>
				</div>		

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update Category</button>
						<a href="{{route('admin.branchrule.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>
@endsection
@extends('admin.layout.base')

@section('title', 'Update Idea ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">    	    

			<h5 style="margin-bottom: 2em;">Send idea to Sponsor and Invester</h5>

            <form class="form-horizontal" action="{{route('admin.idea.sendidea', $id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}               	
				
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Compition Title</label>
					<div class="col-xs-10">{{ $appinfo->idea->title }}</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Description</label>
					<div class="col-xs-6">
						<textarea class="form-control" name="message" rows=7></textarea>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Send</button>
						<a href="{{route('admin.idea.solutions')}}?idea_id={{$appinfo->idea_id}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>
 
@endsection

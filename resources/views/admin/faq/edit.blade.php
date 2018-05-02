@extends('admin.layout.base')

@section('title', 'FAQS')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.faq.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Edit FAQ</h5>

                 <form class="form-horizontal" action="{{route('admin.faq.update', $mp->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH"> 	            	
				
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Title</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $mp->question }}" name="question" required id="Question" placeholder="Question">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Answer</label>
					<div class="col-xs-10">
						<textarea name="answer" id="myeditor" required>{{ $mp->answer }}</textarea>
					</div>
				</div>
								
				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{route('admin.faq.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
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

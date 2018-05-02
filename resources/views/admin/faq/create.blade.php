@extends('admin.layout.base')

@section('title', 'FAQs ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.faq.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">New FAQ</h5>

            <form class="form-horizontal" action="{{route('admin.faq.store')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}               	
				
				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Question</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ old('question') }}" name="question" required id="question" placeholder="Question">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Description</label>
					<div class="col-xs-10">
						<textarea name="answer" id="myeditor" required></textarea>
					</div>
				</div>	

				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Create</button>						
					</div>
				</div>
			</form>
		</div>
    </div>
</div> 
@section('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('myeditor');
</script>
@endsection
@endsection

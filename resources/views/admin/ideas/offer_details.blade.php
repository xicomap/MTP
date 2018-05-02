@extends('admin.layout.base')

@section('title', 'Update Idea ')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">    	    

			<h5 style="margin-bottom: 2em;">Offer Details</h5>

            <form class="form-horizontal" action="{{route('admin.idea.submitoffer', $sol->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	
            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Looking For</label>
					<div class="col-xs-10">{{ $sol->lookingfor }}</div>
				</div>
				
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Offer</label>
					<div class="col-xs-10">${{ $sol->offer }}</div>
				</div>

				<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Update Status</label>
					<div class="col-xs-2">
						<select class="form-control" name="status" id="status">
							<option value="0" @if($sol->status == 0) selected @endif >Waiting</option>
							<option value="1" @if($sol->status == 1) selected @endif>Approve</option>
							<option value="2" @if($sol->status == 2) selected @endif>Decline</option>
						</select>
					</div>
				</div>
				
				<div class="scroll-sec">
				@if(!empty($convs))
				@foreach ($convs as $con)				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">
					@if($con->from_admin_id != 0)
					{{$con->fromadmin->first_name}} {{$con->fromadmin->last_name}}
					@endif
					
					@if($con->from_user_id != 0) 
					{{$con->fromuser->first_name}} {{$con->fromuser->last_name}}
					@endif
					
					 (Date: {{date("M d, Y", strtotime($con->created_at))}})</label>
					<div class="col-xs-12">
						{!!$con->description!!}
					</div>
					<div class="col-xs-12">
						Attachment:  
							@if($con->attach_file != "")
                             <a href="{{ asset('/storage/'.$con->attach_file) }}" target="_blank">View</a>
                            @else
                             N/A
                            @endif
					</div>
				</div>
				@endforeach
				@endif
				</div>
				
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Post message</label>
					<div class="col-xs-6">
						<textarea class="form-control" name="message" rows=7></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Attach document</label>
					<div class="col-xs-6">
                        <label class="input-group-btn">
                          <span class="btn btn-primary attach">
                            <img src="{{asset('/asset/images/file.png')}}" alt="" /> <input type="file" style="display: none;" name="attach">
                          </span>
                        </label>
                    <input type="text" class="form-control upload-btn" disabled="" id="attachtext" placeholder="Select file to upload" style="max-width:100%; min-width:255px;">
                  </div>
				</div>
				
				
				
				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Submit</button>
						<a href="{{route('admin.idea.sponserindex',$sol->idea_applicant_id)}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>
<script type="text/javascript">

    $('.date').datepicker({  

       format: 'mm-dd-yyyy'

     });  
   
 	 $(document).ready(function(){
         $('input[type="file"]').change(function(e){
             var fileName = e.target.files[0].name;
             var name = $(this).attr('name');
             $("#"+name+"text").val(fileName +  '" selected');            
         });
     }); 
</script>  
@endsection
@section('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('myeditor');
</script>
@endsection
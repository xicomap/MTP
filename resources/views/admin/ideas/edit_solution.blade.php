@extends('admin.layout.base')

@section('title', 'Update Idea ')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">    	    

			<h5 style="margin-bottom: 2em;">Participant Details</h5>

            <form class="form-horizontal" action="{{route('admin.idea.solupdate', $sol->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	
            	
            	<div class="form-group row">
            		@if($sol->idea->type == 1)
					<label for="first_name" class="col-xs-12 col-form-label">Compition ID</label>
					@elseif($sol->idea->type == 2)
					<label for="first_name" class="col-xs-12 col-form-label">Challenge ID</label>
					@endif
					<div class="col-xs-10">{{ $sol->idea->compid }}</div>
				</div>
				
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label">Title</label>
					<div class="col-xs-10">{{ $sol->idea->title }}</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Description</label>
					<div class="col-xs-10">
						{!! $sol->idea->description !!}
					</div>
				</div>
				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label">Participant Name</label>
					<div class="col-xs-10">
						{{ $sol->user->first_name }} {{ $sol->user->last_name }}
					</div>
				</div>
				
				<div class="form-group row">
					@if($sol->idea->type == 1)
					<label for="last_name" class="col-xs-12 col-form-label">Idea</label>
					@elseif($sol->idea->type == 2)
					<label for="last_name" class="col-xs-12 col-form-label">Solution</label>
					@endif
					
					<div class="col-xs-10">
						{!! $sol->comment !!}
					</div>
				</div>
			
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Publish</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="publish"  {{ @($sol->idea->publish == 1) ? "checked='checked'" : '' }}> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="publish" {{ @($sol->idea->publish == 0) ? "checked='checked'" : '' }}> No</label> 									 
					</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Approve</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="approve" {{ @($sol->idea->approve == 1) ? "checked='checked'" : '' }}> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="approve" {{ @($sol->idea->approve == 0) ? "checked='checked'" : '' }}> No</label> 									 
					</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Active</label>
					<div class="col-sm-9">									
						<label class="radio-inline"> <input type="radio" value="1" name="active" {{ @($sol->idea->active == 1) ? "checked='checked'" : '' }}> Yes </label> 
						<label class="radio-inline"> <input type="radio" value="0" name="active" {{ @($sol->idea->active == 0) ? "checked='checked'" : '' }}> No</label> 									 
					</div>
				</div>					
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">End Date</label>
					<div class="col-xs-10">
						<input class="form-control date" type="text" name="end_date" required id="EndDate" readonly  value=" {{ originalDate($sol->idea->end_date) }} ">
					</div>
				</div>	
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Score</label>
					<div class="col-xs-1">
						<input class="form-control" type="number" name="score" required id="score"  value="{{ $sol->score }}" min=0 max=100>
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-xs-12 col-form-label">Vote</label>
					<div class="col-xs-1">
						<input class="form-control" type="number" name="vote" required id="vote"  value="{{ $sol->vote }}" min=0 max=100>
					</div>
				</div>
				
				<div class="scroll-sec">
				@if(!empty($convs))
				@foreach ($convs as $con)
								
				<div class="form-group row">
					
					@if($con->from_admin_id != 0)
					<label for="mobile" class="col-xs-12 col-form-label admtxt">
						
							{{$con->fromadmin->first_name}} {{$con->fromadmin->last_name}}
						
					@endif
					
					@if($con->from_user_id != 0) 
					<label for="mobile" class="col-xs-12 col-form-label">
						@if($con->fromuser)
							{{$con->fromuser->first_name}} {{$con->fromuser->last_name}}
						@endif
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
                        <label class="input-group-btn attach">
                          <span class="btn btn-primary">
                            <img src="{{asset('/asset/images/file.png')}}" alt="" /> <input type="file" style="display: none;" name="attach">
                          </span>
                        </label>
                    <input type="text" class="form-control upload-btn" disabled="" id="attachtext" placeholder="Select file to upload" style="max-width:100%; min-width:255px;">
                  </div>
				</div>
				
				
				
				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{route('admin.idea.solutions')}}" class="btn btn-default">@lang('admin.cancel')</a>
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
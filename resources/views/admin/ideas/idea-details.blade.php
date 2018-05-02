@extends('admin.layout.base')

@section('title', 'Update Idea ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">    	    

			<h5 style="margin-bottom: 2em;">View Responses</h5>         
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label"><strong>Current Score</strong></label>
					<div class="col-xs-2">
						{{$idea->total_score}}		
					</div>
				</div>            	
            	<div class="form-group row">
					<label for="first_name" class="col-xs-12 col-form-label"><strong>Title</strong></label>
					<div class="col-xs-10">
						{{$idea->title}}
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label"><strong>Description</strong></label>
					<div class="col-xs-10">
						{!!$idea->description!!}
					</div>
				</div>
				
				<div class="form-group row">
					<label for="last_name" class="col-xs-12 col-form-label"><strong>Response from Users</strong></label>					
				</div>
				
				@if (count($idea->conversations)>0)
    				@foreach ($idea->conversations as $idcon)
    				<div class="form-group row" style="border-bottom: 1px #ccccc;" >
    					<label for="last_name" class="col-xs-12 col-form-label"><strong>User</strong>: {{$idcon->user->first_name}} {{$idcon->user->last_name}}</label>
    					<label for="last_name" class="col-xs-12 col-form-label"><strong>Quotation</strong>: {{$idcon->quotation}}</label>
    					<label for="last_name" class="col-xs-12 col-form-label"><strong>Description</strong>: {!!$idcon->description!!}</label>
    					<label for="last_name" class="col-xs-12 col-form-label"><strong>Date</strong>: {{ date("M d, Y", strtotime($idcon->created_at))}}</label>
    					<label for="last_name" class="col-xs-12 col-form-label"><hr style="height:1px;"</label>
    				</div>
    				@endforeach
				@endif
							
		</div>
    </div>
</div> 
@endsection
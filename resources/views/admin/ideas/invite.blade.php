@extends('admin.layout.base')

@section('title', 'Ideas ')

@section('content')
<form class="form-horizontal" action="{{route('admin.idea.submit_invite')}}" method="POST" role="form">
{{csrf_field()}}
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1" style="margin-left:25px;">
               Invite Competitors     
            </h5>
            
            <div style="margin-bottom: 20px; margin-right:5px;" class="row">
    			
                <div class="form-group col-sm-6">
                	<div class="col-lg-12 pull-left">
                        <div class="col-sm-12 pd0">
                        <h5 class="mb-1">Select Ideas (Select multiple ideas with press ctrl key) </h5>
                        	<select name="idea_ids[]" class="form-control"  multiple style="height:200px;">                        		
                        		@foreach ($ideas_list as $ide)
                        		<option value="{{$ide->id}}"  @if(in_array($ide->id, $idea_id)) selected="selected" @endif >{{$ide->title}}</option>
                        		@endforeach                    		                    	
                        	</select>
                        </div>                     
    				</div>            
    			</div>
    			
    			<div class="form-group col-sm-6">
                	<div class="col-lg-12 pull-left">
                        <div class="col-sm-12 pd0">
                        <h5 class="mb-1">Select Users (Select multiple users with press ctrl key) </h5>
                        	<select name="user_ids[]" class="form-control" multiple style="height:200px;">                        		
                        		@foreach ($users_list as $usr)
                        		<option value="{{$usr->id}}" >{{$usr->first_name}} {{$usr->last_name}}</option>
                        		@endforeach                    		                    	
                        	</select>        	
                        	
                        </div>                     
    				</div>            
    			</div>    			
			
            </div>
            <div class="row">
            	<div class="form-group col-sm-12">
                	<div class="col-lg-12 pull-left">
                        <div class="col-sm-12 pd0">
							<h5 class="mb-1">Enter notes </h5>
                        	<textarea name="notes" class="form-control" rows="5" style="width:98%"></textarea>
                        	
                        <div class="pull-left" style="margin-top:20px"><button type="submit" class="btn btn-primary">Invite</button></div>
    		
                        </div>                     
    				</div>            
    			</div>    			
            </div>
            
        </div>
    </div>
</div>
</form>
@endsection

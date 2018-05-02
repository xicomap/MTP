@extends('admin.layout.base')

@section('title', 'Ideas ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
               Invitations     
            </h5>
            <form class="form-horizontal" action="{{route('admin.idea.invitations')}}" method="GET" role="form">
			{{csrf_field()}}
            <div style="margin-bottom: 20px; margin-right:5px;" class="row">
            	<a href="{{ route('admin.idea.invite') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Invites More</a>
            	
            	
			<div class="col-sm-1">
					<label class="heading">Filters</label>
			</div>
            <div class="form-group col-sm-4">
            	<div class="col-lg-12 pull-left">
                    <div class="col-sm-12 pd0">
                    	<select name="idea_id" class="form-control">
                    		<option value="">Select Idea</option>
                    		@foreach ($ideas_list as $ide)
                    		<option value="{{$ide->id}}"  @if($ide->id == $idea_id) selected="selected" @endif >{{$ide->title}}</option>
                    		@endforeach                    		                    	
                    	</select>
                    </div>                     
				</div>            
			</div>
			
			<div class="form-group col-sm-3">
            	<div class="col-lg-12 pull-left">
                    <div class="col-sm-12 pd0">
                    	<select name="user_id" class="form-control">
                    		<option value="">Select User</option>
                    		@foreach ($users_list as $usr)
                    		<option value="{{$usr->id}}" @if($usr->id == $user_id) selected="selected" @endif >{{$usr->first_name}} {{$usr->last_name}}</option>
                    		@endforeach                    		                    	
                    	</select>                    	
                    	</select>
                    </div>                     
				</div>            
			</div>
			<div class="col-sm-1">
                    <div class="pull-left"><button type="submit" class="btn btn-primary">Search</button></div>
			</div>
            </div>
            </form>
            
            <form class="form-horizontal" action="{{route('admin.idea.binvdestroy')}}" method="POST" role="form">
			{{csrf_field()}}
            <table class="table table-striped table-bordered dataTable" style="font-size:14px;">
                <thead>
                    <tr>                   
                    	<td style="width:5px;"></td> 	
                        <th style="width:20px;">Id</th>
                        <th>Idea</th>
                        <th>User</th>
                        <th>Date</th>                        
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                @foreach($invs as $index=>$inv)
                    <tr>                  
                    <td><input type="checkbox" name="ids[]" value="{{$inv->id}}"></td>  	
                        <td>{{ $index + 1 }}</td>                        
                        <td>{{ $inv->idea->title }}</td>
                         <td>{{ $inv->user->first_name }} {{ $inv->user->last_name }}</td>
                         <td>{{ date("M d, Y", strtotime($inv->created_at)) }}</td>                              
                        <td><a href="{{ route('admin.idea.invdestroy', $inv->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> @lang('admin.delete')</a></td>
                    </tr>
                @endforeach
                <tbody>
                   
                </tbody>
                
            </table>
            <div class="form-group">
            	<div class="col-lg-12 pull-left">
					<label for="inputEmail3" class="pull-left control-label">Action</label>
                    <div class="col-sm-4">
                    	<select name="action" class="form-control" id="action">
                    		<option value="">Select Action</option>
                    		<option value="sponser">Remove Invitations</option>
                    	</select>
                    </div> 
                    <div class="pull-left"><button type="submit" class="btn btn-primary">Submit</button></div>                    
				</div>            
			</div>
			<br><br><br>
			</form>		
        </div>
    </div>
</div>

@endsection
<style>
.pd0 {padding:0px;}
</style>
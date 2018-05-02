@extends('admin.layout.base')

@section('title', 'Ideas ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
            	@if ($type == 1)
                Idea Participants
                @elseif ($type == 2)
                Public Challenge Participants
                @endif              
            </h5>
           
            <a href="{{ route('admin.idea.index') }}?type={{$type}}" style="margin-left: 1em;" class="btn btn-primary pull-right"> Back</a>
            
            <form class="form-horizontal" action="{{route('admin.idea.solutions')}}" method="GET" role="form">
			{{csrf_field()}}
            <div style="margin-bottom: 20px; margin-right:5px;" class="row">
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
            
            <table class="table table-striped table-bordered dataTable" >
                <thead>
                    <tr>
                    	<!-- <td style="width:5px;"></td> -->
                        <th>Id</th>                                 
                        <th>Participant Name</th>
                        @if ($type == 1)
                        <th>Project Idea</th>
                        @elseif ($type == 2)
                        <th>Solution</th>
                        @endif
                        <th style="width:70px;">Score</th>
                        <th style="width:70px;">Vote</th>          
                        <th style="width:70px;">Total</th> 
                        <th>Approve</th>
                        <th>@lang('admin.action')</th>
                        <th>Sponser/Invester</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solutions as $index => $sol)
                     @if($sol->user)
                    <tr>
                    	<!-- <td><input type="checkbox" name="ids[]" value="{{$sol->id}}"></td> -->
                        <td>{{ $index + 1 }}</td>                       
                      
                        <td><a href="{{ route('admin.user.show', $sol->user->id) }}">{{ $sol->user->first_name }} {{ $sol->user->last_name }}</a></td>
                              
                        <td>{{ $sol->idea->title }}</td>    
                        <td>{{ $sol->score }}</td> 
                        <td>{{ $sol->vote }}</td> 
                        <td>{{ $sol->total }}</td>           
                        
                        <td>{{ ($sol->status == 1) ? 'Yes' : 'No' }}</td>                      
                        <td>
                             <a href="{{ route('admin.idea.soledit', $sol->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>                             
                             <a href="{{ route('admin.idea.soldestroy', $sol->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> @lang('admin.delete')</a>                                                        
                        </td>
                        @if ($sol->sent_sponsor_investor == 1)
                        	<td><a href="#;" class="btn btn-info">Sent</a></td>
                        @else
                        	<td><a href="{{route('admin.idea.moves',$sol->id)}}" class="btn btn-info">Send</a></td>
                        @endif
                    </tr>
                     @endif       
                    @endforeach
                </tbody>
                
            </table>
           
			
			
        </div>
    </div>
</div>

@endsection

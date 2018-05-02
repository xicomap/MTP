@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row mr0">
    @include('user.includes.links')
    <div class="col-md-9 user-rigtpart table-sec">
    	 @include('common.notify')
    	@if ($type == 1)
        <h1>My Idea Competition List</h1>
        @elseif($type == 2)
        <h1>My Public Challenges</h1>
        @endif
        <div class="table-scroll">
	        <table class="table table-striped table-bordered dataTable" id="table-2">
	            <thead>
	                <tr>   						
	                    <th>No</th>  
	                    @if ($type == 1)
	                     <th>Competition Name</th>                 
	                    @elseif($type == 2)
	                     <th>Challenge Name</th>                 
	                    @endif                      
	                                     
	                    @if ($type == 1)
	                     <th>My Idea</th>                 
	                    @elseif($type == 2)
	                     <th>My Solution</th>                 
	                    @endif                   
	                    <th>Approve</th>
	                    <th>Score</th>
	                    <th>Vote</th>
	                    <th>Total</th>
	                    <th>Winner</th>
	                    <th>Unread Comments</th>
	                    <th>Edit</th>
	                </tr>
	            </thead>
	            <tbody>
	                @foreach($invs as $index => $inv) 
	                <tr>	
	                	                 	
	                    <td>{{ $index + 1 }}</td>                        
	                    <td><a href="{{route('invdetail',$inv->id)}}">{{ $inv->title }}</a></td>
	                    <td>{!! $inv->comment !!}</td>         
	                    <td>{{ ($inv->status == 1) ? 'Yes' : 'No' }}</td>
	                    <td>{{$inv->score}}</td>
	                    <td>{{$inv->vote}}</td>
	                    <td>{{$inv->total}}</td>
	                    <td>No</td>
	                    <td>@if($convs[$inv->ideaid])
	                            {{$convs[$inv->ideaid]}}
	                        @else
	                            0
	                        @endif</td>
	                    <td><a href="{{route('invdetail',$inv->id)}}">Edit</a></td>
	                </tr>
	                @endforeach
	            </tbody>            
	        </table>        
        </div>
    </div>  
  </div>
</div>
</section>
@endsection

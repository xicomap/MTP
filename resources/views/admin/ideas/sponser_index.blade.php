@extends('admin.layout.base')

@section('title', 'Ideas ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                View Offer Details      
            </h5>
             <a href="{{ route('admin.idea.investorindex') }}?type={{$type}}" style="margin-left: 1em;" class="btn btn-primary pull-right"> Back</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>                    	
                        <th>Name Sponsor/Invester</th>                        
                        <th >Offer</th>                       
                        <th>Status</th>
                        <th>Sponsor/Invester</th>
                        <th>Edit</th>                        
                    </tr>
                </thead>
                <tbody>
                @foreach($ideas as $ide)
                   <tr>                    	
                        <th><a href="{{ route('admin.user.show', $ide->user->id) }}">{{$ide->user->first_name}} {{$ide->user->last_name}}</a></th>                        
                        <th >{{$ide->offer}}</th>                       
                        <th>{{($ide->status == 0) ? 'Waiting' : 'Approved'}}</th>
                        <th>{{ $ide->lookingfor }} </th>
                        <th><a href="{{ route('admin.idea.offerdetails', $ide->id) }}">View</a></th>                        
                    </tr>               
                @endforeach     
                </tbody>
                
            </table>            
			<br><br><br><br><br>
        </div>
    </div>
</div>
<!-- <div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                List      
            </h5>
            
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>                    	
                        <th>Id</th>                        
                        <th >Title</th>                       
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ideas as $index => $idea)
                    <tr>                    	
                        <td>{{ $index + 1 }}</td>                       
                        <td style="width: 70%">{{ $idea->title }}</td>                       
                        <td>                                  
                             <a href="{{ route('admin.idea.show', $idea->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> View Responses</a> 
                             <a href="{{ route('admin.idea.destroy', $idea->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> @lang('admin.delete')</a>                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>            
			<br><br><br><br><br>
        </div>
    </div>
</div> -->
@endsection
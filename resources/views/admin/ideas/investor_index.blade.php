@extends('admin.layout.base')

@section('title', 'Ideas ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                View Offer List      
            </h5>           
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>                    	
                        <th>Participant ID</th>                        
                        <th >Participant Name</th>                       
                        <th>Sponsor/Invest</th>
                        <th>Published</th>                        
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($ideas as $ide)
                   <tr>                    	
                        <th>{{$ide->uid}}</th>                        
                        <th ><a href="{{ route('admin.user.show', $ide->uid) }}?type={{$type}}">{{$ide->first_name}} {{$ide->last_name}}</a></th>                       
                        <th><a href="{{route('admin.idea.sponserindex',$ide->id)}}?type={{$type}}">{{$ide->total_sponsor_invester}}</a></th>
                        <th>Yes</th>                        
                        <th><a href="{{route('admin.idea.sponserindex',$ide->id)}}?type={{$type}}">View</a></th>
                    </tr>               
                @endforeach     
                </tbody>
                
            </table>            
			<br><br><br><br><br>
        </div>
    </div>
</div>
<!--<div class="content-area py-1">
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
</div>-->
@endsection
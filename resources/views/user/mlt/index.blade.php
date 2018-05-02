@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row mr0">
    @include('user.includes.links')
    <div class="col-md-9 user-rigtpart table-sec">
    	 @include('common.notify')
    	
        <h1>Mlt Posts</h1><br>
       	<form class="form-horizontal" action="{{route('index')}}" method="GET" role="form">
			{{csrf_field()}}			
            <div style="margin-bottom: 20px; margin-right:5px;" class="row">
			<div class="col-sm-1">
					<label class="heading">Filters</label>
			</div>
            <div class="form-group col-sm-4">
            	<div class="col-lg-12 pull-left">
                    <div class="col-sm-12 pd0">
                    	<select name="ca_id" class="form-control">
                    		<option value="">Select Category</option>
                    		@foreach ($cats as $ca)
                    		<option value="{{$ca['id']}}"  @if($ca['id'] == $ca_id) selected="selected" @endif >{{$ca['name']}}</option>
                    		@endforeach                    		                    	
                    	</select>
                    </div>                     
				</div>            
			</div>
			
			<div class="form-group col-sm-3">
            	<div class="col-lg-12 pull-left">
                    <div class="col-sm-12 pd0">
                    	<input type="text" name="keyword" value="{{$keyword}}" class="form-control">                    	
                    </div>                     
				</div>            
			</div>
			<div class="col-sm-1">
                    <div class="pull-left"><button type="submit" class="btn btn-primary">Search</button></div>
			</div>
            </div>
        </form> 
        <table class="table table-striped table-bordered dataTable" id="table-2">
            <thead>
                <tr>   		
                	<th>No</th>                  				
                    <th>Title</th>                                      
                    <th>Category</th>  
                    <th>Employee Name</th>
                    <!-- <th>Position</th> -->                         
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mps as $index => $inv) 
                <tr>	
                	                 	
                    <td>{{ $index + 1 }}</td>                        
                    <td><a href="{{route('mltviewpost',$inv->id)}}">{{ $inv->title }}</a></td>
                    <td>{{ $inv->category->name }}</td>
                    @if ($inv->user_id > 0)
                    <td>{{ $inv->user->first_name }} {{ $inv->user->last_name}}</td>
                    <!-- <td>{{ $inv->user->position }}</td> -->
                    @else
                    <td>N/A</td>
                    <!--<td>N/A</td>  -->
                    @endif
                    <td><a href="{{route('mltviewpost',$inv->id)}}">View Comments</a></td>
                </tr>
                @endforeach
            </tbody>            
        </table>        
    </div>  
  </div>
</div>
</section>
@endsection

@extends('admin.layout.base')

@section('title', 'Mlt Posts ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                {{ $heading }}              
            </h5>
            @if ($type == 1)
            <a href="{{ route('admin.mlt.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New</a>
            @endif
            
            <form class="form-horizontal" action="{{route('admin.mlt.index')}}" method="GET" role="form">
			{{csrf_field()}}
			<input type="hidden" name="type" value={{$type}}>
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
            
            <table class="table table-striped table-bordered dataTable">
                <thead>
                    <tr>   						
                        <th>Id</th>
                        <th>Category</th> 
                        <th>Title</th> 
                        @if ($type == 2)
                        <th>Employee Name</th> 
                        <!-- <th>Designation</th> -->
                        @endif 
                        <th>Status</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $index => $idea)
                    <tr>                         	   	
                        <td>{{ $index + 1 }}</td>                        
                        <td>{{$idea->category->name}}</td>           
                        <td>{{$idea->title}}</td>
                         @if ($type == 2)
                        <td>{{$idea->user->first_name}} {{$idea->user->last_name}}</td>
                        <!--  <td>{{$idea->user->position}}</td>-->
                        @endif
                        <td>{{ getMetecPostStatus($idea->status) }}</td>                                 
                        <td> 
                                              
                             <form action="{{ route('admin.mlt.destroy', $idea->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                  <a href="{{ route('admin.mlt.edit', $idea->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
                                 @if($idea->type == 1)             
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> @lang('admin.delete')</button>
                                 @endif                             
                            </form>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>                
            </table>            
        </div>
    </div>
</div>

@endsection

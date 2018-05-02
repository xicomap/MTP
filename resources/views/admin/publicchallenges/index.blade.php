@extends('admin.layout.base')

@section('title', 'Ideas ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                Public Challenges       
            </h5>           
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>   						
                        <th>Id</th>                        
                        <th>Name</th>                                   
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Challenge Title</th>
                        <th>Challenge Description</th>                        
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pcs as $index => $pc)
                    <tr>                    	                 	
                        <td>{{ $index + 1 }}</td>                        
                        <td>{{$pc->name}}</td>           
                        <td>{{$pc->email}}</td>
                        <td>{{$pc->mobile}}</td>          
                        <td>{{$pc->title}}</td>         
                        <td>{{$pc->description}}</td>                         
                        <td>       
                        	 <form action="{{ route('pcs.destroy', $pc->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">                                
                                <a href="{{ route('pcs.show', $pc->id) }}" class="btn btn-info"><i class="fa fa-book"></i> View</a>
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> @lang('admin.delete')</button>
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

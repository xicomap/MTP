@extends('admin.layout.base')

@section('title', 'Manuals ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                {{ $heading }}              
            </h5>
            <a href="{{ route('admin.manual.create') }}?type={{$type}}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>   
                        <th style="width:50%">Title</th> 
                        <th>View</th>                       
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($manuals as $index => $manual)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $manual->category->name }}</td>    
                        <td>{{ $manual->title }}</td>  
                        <td><a href="{{ asset('/storage/'.$manual->picture) }}" target="_blank">View/Download</a></td>                            
                        <td>
                            <form action="{{ route('admin.manual.destroy', $manual->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">                                
                                <a href="{{ route('admin.manual.edit', $manual->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
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
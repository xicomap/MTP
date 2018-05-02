@extends('admin.layout.base')

@section('title', 'Products ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                Videos 
            </h5>
            <a href="{{ route('admin.video.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>   
                        <th style="width:30%">Video Name</th>
                        <th>Views</th>
                        <th>Comments</th>
                        <th>Featured</th>       
                        <th>Status</th>                   
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($videos as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->category->name }}</td>    
                        <td>{{ $product->title }}</td>          
                        <td>{{ $product->total_comments }}</td>      
                        <td>{{ $product->total_views }}</td>     
                        <td>{{ ($product->is_featured == 1) ? 'Featured' : 'No' }}</td>      
                        <td>{{ ($product->status = 1) ? 'Yes' : 'No' }}</td>                
                        <td>
                            <form action="{{ route('admin.video.destroy', $product->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">                                
                                <a href="{{ route('admin.video.edit', $product->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
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
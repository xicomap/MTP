@extends('admin.layout.base')

@section('title', 'Articles ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                Articles 
            </h5>
            <a href="{{ route('admin.article.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>   
                        <th style="width:50%">Article Name</th>
                        <th>Views</th>
                        <th>Comments</th> 
                        <th>Status</th>                                         
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->category->name }}</td>    
                        <td>{{ $product->title }}</td>          
                        <td>{{ $product->total_comments }}</td>                                   
                        <td>{{ $product->total_views }}</td>      
                        <td>{{ ($product->status = 1) ? 'Yes' : 'No' }}</td>                    
                        <td>
                            <form action="{{ route('admin.article.destroy', $product->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">                                
                                <a href="{{ route('admin.article.edit', $product->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
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
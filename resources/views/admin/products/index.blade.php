@extends('admin.layout.base')

@section('title', 'Products ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                Products 
            </h5>
            <a href="{{ route('admin.product.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>   
                        <th style="width:40%">Product Name</th>
                        <th>URL</th>   
                        <th>Featured</th>                     
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        @if($product->category_id)
                        <td>{{ $product->category->name}}</td> 
                        @else
                        <td></td>
                        @endif   
                        <td>{{ $product->title }}</td>          
                        <td>{{ $product->url }}</td>
                        @if($product->is_featured)
                            <td>Featured</td>   
                        @else
                            <td>No</td>
                        @endif                
                        <td>
                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">                                
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
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
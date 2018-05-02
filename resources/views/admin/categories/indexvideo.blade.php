@extends('admin.layout.base')

@section('title', 'Categories ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                Categories List                
            </h5>
            <a href="{{ route('admin.categoryvideo.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Category</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="width:70%">{{ $category->name }}</td>                        
                        <td>
                            <form action="{{ route('admin.categoryvideo.destroy', $category->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">                                
                                <a href="{{ route('admin.categoryvideo.edit', $category->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
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
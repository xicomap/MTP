@extends('admin.layout.base')

@section('title', 'Articles ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                Email Messages 
            </h5>
           
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th> 
                        <th>Message</th>                
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($setting as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->name }}</td>    
                        <td>{{ $product->message }}</td>         
                        <td>
                            <a href="{{ url('admin/edit/email/'.$product->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>                
            </table>
        </div>
    </div>
</div>
@endsection
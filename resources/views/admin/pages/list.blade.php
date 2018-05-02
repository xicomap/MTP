@extends('admin.layout.base')

@section('title', 'Static Pages ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                Static Pages                
            </h5>
            
            <table class="table table-striped table-bordered dataTable">
                <thead>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.heading')</th>                      
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $index => $page)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $page->heading }}</td>                              
                        <td>                 
                                <a href="{{ route('admin.page.edit', $page->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>                                
                         </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection
@extends('admin.layout.base')

@section('title', 'Comment Settings')

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
                        <th>@lang('admin.name')</th> 
                        <th>@lang('admin.type')</th>                       
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($setting as $index => $page)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $page->name }}</td>
                        <td>
                            @if($page->type == 1)   
                             <p>Only registered user</p>
                            @elseif($page->type == 2)
                              <p>All visitors</p>
                            @elseif($page->type == 3) 
                              <p>Disbale comments</p>
                            @endif
                        </td>                              
                        <td>                 
                                <a href="{{ route('admin.comment.edit', $page->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>                                
                         </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection
@extends('admin.layout.base')

@section('title', 'Admin Users ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                Subadmin Manager                
            </h5>
            <a href="{{ route('admin.admin.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Subadmin</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Admin Type</th>
                        <th>@lang('admin.first_name')</th>
                        <th>@lang('admin.last_name')</th>
                        <th>@lang('admin.email')</th>                        
                        <th>Created</th>
                        <th>@lang('admin.status')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $index => $admin)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ roleType($admin->role_id) }}</td>
                        <td>{{ $admin->first_name }}</td>
                        <td>{{ $admin->last_name }}</td>                        
                        <td>{{ $admin->email }}</td>                                  
                        <td>{{ date("M d, Y", strtotime($admin->created_at)) }}</td>                   
                        <td>{{ ($admin->status == 1) ? 'Active' : 'Inactive' }}</td>      
                        <td>
                            <form action="{{ route('admin.admin.destroy', $admin->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">                                
                                <a href="{{ route('admin.admin.edit', $admin->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
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
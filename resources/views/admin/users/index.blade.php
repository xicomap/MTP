@extends('admin.layout.base')

@section('title', 'Users ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                @lang('admin.users.Users')                
            </h5>
            <a href="{{ route('admin.user.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New User</a>
            <form class="form-horizontal" action="{{route('admin.user.submit_invite')}}" method="POST" role="form">
			{{csrf_field()}}
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                    	<th></th>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.user_type')</th>
                        <th>@lang('admin.first_name')</th>
                        <th>@lang('admin.last_name')</th>
                        <th>@lang('admin.email')</th>
                        <th>@lang('admin.mobile')</th>
                        <th>@lang('admin.signup_date')</th>
                        <th>@lang('admin.status')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user) 

                  

                 @if(Auth::guard('admin')->user()->role_id == 1)         
                    
                        <tr>
                        	<td><input type="checkbox" name="ids[]" value="{{$user->id}}"></td>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ userType($user->user_type) }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>                        
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile }}</td>          
                            <td>{{ date("M d, Y", strtotime($user->created_at)) }}</td>                   
                            <td>{{ ($user->status == 1) ? 'Active' : 'Inactive' }}</td>      
                            <td>                            
                                                        
                                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>                                
                                    <a href="{{ route('admin.user.destroy', $user->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> @lang('admin.delete')</a>
                                </form>
                            </td>
                        </tr>
                @elseif(Auth::guard('admin')->user()->role_id == 4)
                        @if($user->user_type == 6)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{$user->id}}"></td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ userType($user->user_type) }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>                        
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>          
                                <td>{{ date("M d, Y", strtotime($user->created_at)) }}</td>                   
                                <td>{{ ($user->status == 1) ? 'Active' : 'Inactive' }}</td>      
                                <td>                            
                                                            
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>                                
                                        <a href="{{ route('admin.user.destroy', $user->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> @lang('admin.delete')</a>
                                    </form>
                                </td>
                            </tr>
                     @endif
                @elseif(Auth::guard('admin')->user()->role_id == 2)
                        @if($user->user_type == 1 || $user->user_type == 2 || $user->user_type == 3 || $user->user_type == 4)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{$user->id}}"></td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ userType($user->user_type) }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>                        
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>          
                                <td>{{ date("M d, Y", strtotime($user->created_at)) }}</td>                   
                                <td>{{ ($user->status == 1) ? 'Active' : 'Inactive' }}</td>      
                                <td>                            
                                                            
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>                                
                                        <a href="{{ route('admin.user.destroy', $user->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> @lang('admin.delete')</a>
                                    </form>
                                </td>
                            </tr>
                        @endif
                @elseif(Auth::guard('admin')->user()->role_id == 3)
                        @if($user->user_type == 5)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{$user->id}}"></td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ userType($user->user_type) }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>                        
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>          
                                <td>{{ date("M d, Y", strtotime($user->created_at)) }}</td>                   
                                <td>{{ ($user->status == 1) ? 'Active' : 'Inactive' }}</td>      
                                <td>                            
                                                            
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>                                
                                        <a href="{{ route('admin.user.destroy', $user->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> @lang('admin.delete')</a>
                                    </form>
                                </td>
                            </tr>
                        @endif
                 
                 @endif

                @endforeach
                </tbody>
                
            </table>
            <div class="form-group">
            	<div class="col-lg-12 pull-left">
					<label for="inputEmail3" class="pull-left control-label">Action</label>
                    <div class="col-sm-4">
                    	<select name="action" class="form-control" id="action">
                    		<option value="">Select Action</option>
                    		<option value="invite">Invite to Post Challenges</option>                    		
                    	</select>
                    </div> 
                    <div class="pull-left"><button type="submit" class="btn btn-primary">Submit</button></div>                    
				</div>            
			</div>
			<br><br><br><br><br>
			</form>
        </div>
    </div>
</div>
@endsection
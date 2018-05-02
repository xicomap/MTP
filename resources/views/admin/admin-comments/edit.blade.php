@extends('admin.layout.base')

@section('title', 'Comment Settings ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5>{{$setting->name}}</h5>

            <div className="row">
                <form action="{{ route('admin.comment.update') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$setting->id}}">
                    <div class="form-group row">
    					<label for="first_name" class="col-xs-12 col-form-label">Name</label>
    					<div class="col-xs-10">
    						<input class="form-control" type="text" value="{{ $setting->name }}" name="name" required id="name" placeholder="Name" readonly="readonly">
    					</div>
    				</div>				
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="mobile" class="col-xs-12 col-form-label">Type</label>
							<div class="col-sm-9">									
								<label class="radio-inline"> <input type="radio" value="1" name="type" id="status1" {{ @($setting->type == 1) ? "checked='checked'" : '' }}> Only registered user </label> 
								<label class="radio-inline"> <input type="radio" value="2" name="type" id="status2" {{ @($setting->type == 2) ? "checked='checked'" : '' }}> All visitors</label>
								<label class="radio-inline"> <input type="radio" value="3" name="type" id="status2" {{ @($setting->type == 3) ? "checked='checked'" : '' }}> Disable Comments</label>  									 
							</div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-md-3">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-danger btn-block">Cancel</a>
                        </div>
                        <div class="col-xs-12 col-md-3 offset-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

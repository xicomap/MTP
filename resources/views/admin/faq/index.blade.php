@extends('admin.layout.base')

@section('title', 'FAQs ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1">
                FAQs
            </h5>
            
            <a href="{{ route('admin.faq.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New</a>
            
            
            
            
            <table class="table table-striped table-bordered dataTable">
                <thead>
                    <tr>   						
                        <th>Id</th>
                        <th>Question</th> 
                        <th>Answer</th> 
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $index => $idea)
                    <tr>                         	   	
                        <td>{{ $index + 1 }}</td>                        
                        <td>{{$idea->question}}</td>           
                        <td>{!!$idea->answer!!}</td>
                        <td> 
                                              
                             <form action="{{ route('admin.faq.destroy', $idea->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                  <a href="{{ route('admin.faq.edit', $idea->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
                                
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

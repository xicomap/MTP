@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
      <div class="row mr0">
        @include('user.includes.links')   
        <div class="col-md-9 user-rigtpart">
           	<!-- <form class="form-horizontal" action="{{route('manualindex')}}" method="GET" role="form">
    			{{csrf_field()}}			
                <div style="margin-bottom: 20px; margin-right:5px;" class="row">
    			<div class="col-sm-1">
    					<label class="heading">Filters</label>
    			</div>
                <div class="form-group col-sm-4">
                	<div class="col-lg-12 pull-left">
                        <div class="col-sm-12 pd0">
                        	<select name="cid" class="form-control">
                        		<option value="">Select Category</option>
                        		@foreach ($cats as $ca)
                        		<option value="{{$ca['id']}}"  @if($ca['id'] == $cid) selected="selected" @endif >{{$ca['name']}}</option>
                        		@endforeach                    		                    	
                        	</select>
                        </div>                     
    				</div>            
    			</div>
    			
    			<div class="form-group col-sm-3">
                	<div class="col-lg-12 pull-left">
                        <div class="col-sm-12 pd0">
                        	<input type="text" name="keyword" value="{{$keyword}}" class="form-control">                    	
                        </div>                     
    				</div>            
    			</div>
    			<div class="col-sm-1">
                        <div class="pull-left"><button type="submit" class="btn btn-primary">Search</button></div>
    			</div>
                </div>
            </form>  -->
            <!-- <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>   		
                    	<th>No</th>                  				
                        <th>Title</th>                                      
                        <th>Description</th>  
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($manuals as $index => $inv) 
                    <tr>                   	                 	
                        <td>{{ $index + 1 }}</td>                        
                        <td>{{ $inv->title }}</td>
                        <td>{!! $inv->description !!}</td>   
                        @if($inv->picture != "")                     
                        <td><a href="{{ asset('/storage/'.$inv->picture) }}" target="_blank">View/Download</a></td>
                        @else
                        <td>N/A</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>            
            </table>    --> 
            
      <div class="row mr0">
        <div class="col-md-8">
        	 @include('common.notify')
        	
            <h3 class="short-heading">{{$heading}}</h3>
	  		<div class="detail-row">
	           @foreach($manuals as $index => $inv) 
		  		<div class="detail-column">
		  			<div class="article-no"><label class="title"> {{ $inv->title }} </label></div>
		  			
		  			<div class="description-sec">{!! $inv->description !!} </div>
		  			
		  			@if($inv->picture != "")                     
	                        
		  			<div class="download-sec">
		  				<a  href="{{ asset('/storage/'.$inv->picture) }}" target="_blank" class="view-btn btn yellow"> View/Download PDF</a>
		  			</div>
	                        @else
		  			<div class="download-sec">
		  			</div>
	                        @endif
		  		</div>
	           @endforeach
	  		</div>    
  		</div>
	 	<div class="right-sec col-md-4">
	 		<h3 class="short-heading"> Filters  </h3>
	 		<div class="filters">
           	<form class="form-horizontal" action="{{route('manualindex')}}" method="GET" role="form">
    			{{csrf_field()}}		
	 			<div class="form-group">
		 			<label class="">Catagores </label>		 			
                	<select name="cid" class="form-control select">
                		<option value="">Select Category</option>
                		@foreach ($cats as $ca)
                		<option value="{{$ca['id']}}"  @if($ca['id'] == $cid) selected="selected" @endif >{{$ca['name']}}</option>
                		@endforeach                    		                    	
                	</select>
	 			</div>
	 			
	 			<div class="form-group">
	 				<label> Keyword </label>
	            	<div class="form-group">
                        <input type="text" name="keyword" value="{{$keyword}}" class="search-bar" placeholder="Type your Keyword..">   
			 			<button type="submit" class="search-btn"> </button>
		 			</div>
		 		</div>
		 			
		 		<div class="form-group">
		 			<button type="submit" class="btn yellow">Search </button>
		 		</div>
            </form> 
	 		</div>
	 	</div>
	 </div>
	 		
        </div>  
      </div>
    </div>
</section>
@endsection

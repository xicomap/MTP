@extends('user.layout.app')
@section('content')
<section class="content">
	
	<div class="left-sec col-md-8">
  
		<div class="content-area clearfix">
            <div class="post-list">
            <h3 class="mb-1">
                Public Challanges  
            </h3>		
        	<table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>   						
                        <th>No</th>                        
                        <th>Name</th>                                   
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pchallanges as $index => $pidea)
                    <tr>	
                    	                 	
                        <td>{{ $index + 1 }}</td>                        
                        <td>{{ $pidea->title }}</td>                        
                        <td>{!! $pidea->description !!}</td>     
                        <td>    
                           <form method="post" action="{{route('innovationapply')}}" class="clear">
            				{{ csrf_field() }}        
            					<input type="hidden" name="idea_id" value="{{$pidea->id}}">
                				<div class="col-md-12">               					
                                    <button type="submit" class="btn btn-default yellow-btn">Suggest solution and get reward</button>                                         					
                				</div>
            				</form> 
						</td> 
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
            
            </div>
			<div class="pagination">
				{{ $ideas->links() }}
			</div>
			
			
			<div class="col-md-12 user-rigtpart">
            	 @include('common.notify')
                <h1>Please send your challenges here</h1>        
                <div class="edit-profile-info pd0">
                  <form action="{{route('addchallenge')}}" method="POST" enctype="multipart/form-data" role="form">
                  {{csrf_field()}}           
                    <div class="row">
                      <div class="col-md-12 pull-left">
                      	<div class="col-md-2 pull-left"><label>Name</label></div>
                        <div class="col-md-10 pull-left">                  
                          <input class="form-control" type="text" name="name" required placeholder="Your Name">
                        </div>
                      </div>
                      
                      <div class="col-md-12 pull-left">
                      	<div class="col-md-2 pull-left"><label>Email</label></div>
                        <div class="col-md-10 pull-left">                  
                          <input class="form-control" type="email" name="email" required placeholder="Your Email">
                        </div>
                      </div>
                      
                      <div class="col-md-12 pull-left">
                      	<div class="col-md-2 pull-left"><label>Mobile</label></div>
                        <div class="col-md-10 pull-left">                  
                          <input class="form-control" type="text" name="mobile" required placeholder="Your Mobile">
                        </div>
                      </div>
                      
                      <div class="col-md-12 pull-left">
                      	<div class="col-md-2 pull-left"><label>Title</label></div>
                        <div class="col-md-10 pull-left">                  
                          <input class="form-control" type="text" name="title" required placeholder="Challenge Title">
                        </div>
                      </div>
                      
                      <div class="col-md-12 pull-left">
                      	<div class="col-md-2 pull-left"><label>Description</label></div>
                        <div class="col-md-10 pull-left">                  
                          <textarea class="form-control" name="description" required placeholder="Challenge Description" rows="7"></textarea>
                        </div>
                      </div>
        			  			  
                      <div class="action col-md-12">
                      <div class="col-md-2 pull-left"></div>
                        <div class="col-md-10 pull-left">                  
                          <input type="submit" class="btn btn-default yellow-btn" value="Submit" name="submit">       
                        </div>
                                 
                      </div>
                    </div>
                  </form>
                </div>
            </div>
            
            <h3 class="mb-1">
               Top ten public challange soloution providers winners
            </h3>		
        	<!-- <table class="table table-striped table-bordered dataTable">
                <thead>
                    <tr>   						
                        <th style="width:100px;">No</th>                        
                        <th>Name</th>                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($top10ch as $index => $ideach)
                    <tr>              	
                        <td >{{ $index + 1 }}</td>                        
                        <td>{{$ideach->first_name}} {{$ideach->last_name}}</td>   
                    </tr>
                    @endforeach
                </tbody>
                
            </table> -->
    
    
    		<div class="winner-sec">
    			<ul class="winner-list">
                    @foreach($top10ch as $index => $ideach)
    				<li>
    					<figure class="win-icon"> <img src="https://cdn2.iconfinder.com/data/icons/thin-line-icons-for-seo-and-development-1/64/SEO_awards-256.png" /> </figure> 
    					<span class="count"> {{ $index + 1 }} </span>
    					<span class="winner-name"> {{$ideach->first_name}} {{$ideach->last_name}} </span>
    				</li>
                    @endforeach
    			</ul>    			
    		</div>
		</div>
	</div> 		
	@include('user.includes.innovation_sidebar')   
	
</section>
@endsection
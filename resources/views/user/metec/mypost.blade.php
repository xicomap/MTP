@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row mr0">
    @include('user.includes.links')
    <div class="col-md-9 user-rigtpart table-sec">
        <h1>My Posts</h1>
       
       
  		
  		<div class="detail-row">
                @foreach($mps as $index => $inv) 
		  		<div class="detail-column">
		  			<div class="article-no"><label class="title"> <a href="{{route('editpost',$inv->id)}}">{{ $inv->title }}</a> </label></div>
		  			
		  			<div class="competition">
		  				<div class="sec-row">
		  					<label> Category </label>
		  					<span>
		  						{{ $inv->category->name }}
		  					</span>
		  				</div>
		  				<div class="sec-row">
		  					<label> Employee Name </label>
		  					<span> {{ $inv->user->first_name }} {{ $inv->user->last_name}} </span>
		  				</div>
		  				<div class="sec-row">
		  					<label> Position </label>
		  					<span> {{ $inv->user->position }} </span>
		  				</div>
		  				<div class="sec-row">
		  					<label> Status </label>
		  					<span> {{ getMetecPostStatus($inv->status) }} </span>
		  				</div>
		  				<div class="sec-row">
		  					<label> Action </label>
		  					<span class="action-btn"> <a href="{{route('metecupdate',$inv->id)}}" class="hide-btn"><span>Hide</span> </a> <a href="{{route('metecdelete',$inv->id)}}" onClick="return confirm('Are you sure?')" class="delete-btn"><span>Delete</span> </a> </span>
		  				</div>
		  			</div>
		  		</div>
                @endforeach
  		</div>
  		
        <!-- <table class="table table-striped table-bordered dataTable" id="table-2">
            <thead>
                <tr>   		
                	<th>No</th>                  				
                    <th>Title</th>                                      
                    <th>Category</th>  
                    <th class="emply-name">Employee Name</th>
                    <th>Position</th>                          
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mps as $index => $inv) 
                <tr>	
                	                 	
                    <td>{{ $index + 1 }}</td>                        
                    <td><a href="{{route('editpost',$inv->id)}}">{{ $inv->title }}</a></td>
                    <td>{{ $inv->category->name }}</td>
                    <td>{{ $inv->user->first_name }} {{ $inv->user->last_name}}</td>
                    <td>{{ $inv->user->position }}</td>
                    <td>
                    	{{ getMetecPostStatus($inv->status) }}
                    </td>
                    <td class="action-btn"><a href="{{route('metecupdate',$inv->id)}}" class="hide-btn"><span>Hide</span> </a> <a href="{{route('metecdelete',$inv->id)}}" onClick="return confirm('Are you sure?')" class="delete-btn"><span>Delete</span> </a></td>
                </tr>
                @endforeach
            </tbody>            
        </table> -->   
        
        <div class="col-md-12 user-rigtpart">
            	 @include('common.notify')
                <h1>Add New Post</h1>        
                <div class="edit-profile-info">
                  <form action="{{route('userpost')}}" method="POST" enctype="multipart/form-data" role="form">
                  {{csrf_field()}}           
                    <div class="row">
                      <div class="col-md-12 pull-left">
                      	<div class="col-md-2 pull-left"><label>Category</label></div>
                        <div class="col-md-10 pull-left">                  
                          {!! dropdown('category_id',$cats) !!}	
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
                      
                       <div class="col-md-12 pull-left">
                      	<div class="col-md-2 pull-left"><label>Image</label></div>
                           <div class="col-xs-10">
                                <label class="input-group-btn">
                                  <span class="btn btn-primary attach">
                                    <img src="{{asset('/asset/images/file.png')}}" alt="" />
                                  </span>
                                  <input type="file" name="picture">
                                </label>
                            	<input type="text" class="form-control upload-btn" disabled="" id="picturetext" placeholder="Select file to upload">
                          	</div>
                      </div>
                      
                      <div class="col-md-12 pull-left">
                      	<div class="col-md-2 pull-left"><label>Video</label></div>
                        <div class="col-xs-10">
                            <label class="input-group-btn">
                              <span class="btn btn-primary attach">
                                <img src="{{asset('/asset/images/file.png')}}" alt="" />
                              </span>
                              <input type="file" name="video">
                            </label>
                            <input type="text" class="form-control upload-btn" disabled="" id="videotext" placeholder="Select file to upload">
                            <p>Please upload only .mp4 files</p>
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
    </div>  
  </div>
</div>
</section>
<script type="text/javascript">  
 	 $(document).ready(function(){
         $('input[type="file"]').change(function(e){
             var fileName = e.target.files[0].name;
             var name = $(this).attr('name');
             $("#"+name+"text").val(fileName +  ' selected');            
         });
     }); 
</script>
@endsection

@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row">
    @include('user.includes.links')
    <div class="col-md-9 user-rigtpart">    
    	 @include('common.notify')
        <h1>Edit Post</h1>        
        <div class="edit-profile-info">
          <form action="{{route('mlteditpost',$mp->id)}}" method="POST" enctype="multipart/form-data" role="form">
          {{csrf_field()}}           
            <div class="row">
              <div class="col-md-12 pull-left">
              	<div class="col-md-2 pull-left"><label>Category</label></div>
                <div class="col-md-10 pull-left">                  
                  {!! dropdown('category_id',$cats,$mp->category_id) !!}	
                </div>
              </div>                      
              <div class="col-md-12 pull-left">
              	<div class="col-md-2 pull-left"><label>Title</label></div>
                <div class="col-md-10 pull-left">                  
                  <input class="form-control" type="text" name="title" required placeholder="Title" value="{{$mp->title}}">
                </div>
              </div>
              
              <div class="col-md-12 pull-left">
              	<div class="col-md-2 pull-left"><label>Description</label></div>
                <div class="col-md-10 pull-left">                  
                  <textarea class="form-control" name="description" required placeholder="Challenge Description" rows="7">{!! $mp->description !!}</textarea>
                </div>
              </div>
              
               <div class="col-md-12 pull-left pd10">
              	<div class="col-md-2 pull-left"><label>Image</label></div>
                   <div class="col-xs-10">
                        <label class="input-group-btn">
                          <span class="btn btn-primary attach">
                            <img src="{{asset('/asset/images/file.png')}}" alt="" /> <input type="file" style="display: none;" name="picture">
                          </span>
                        </label>
                    <input type="text" class="form-control upload-btn" disabled="" id="picturetext" placeholder="Select file to upload" style="max-width:100%; min-width:255px;">
                  </div>
                  <div class="col-xs-2 img-sec">
              	@if($mp->picture_file != "")
                     <img src="{{ asset('/storage/'.$mp->picture_file) }}" width=100/>                    
                    @endif
                    </div>
              </div>
              
              <div class="col-md-12 pull-left pd10">
              	<div class="col-md-2 pull-left"><label>Video</label></div>
              	
                <div class="col-xs-10">
                    <label class="input-group-btn">
                      <span class="btn btn-primary attach">
                        <img src="{{asset('/asset/images/file.png')}}" alt="" /> <input type="file" style="display: none;" name="video">
                      </span>
                    </label>
                    <input type="text" class="form-control upload-btn" disabled="" id="videotext" placeholder="Select file to upload" style="max-width:100%; min-width:255px;">
                    <p>Please upload only .mp4 files</p>
                 </div>
                  <div class="col-xs-2 img-sec">
              	@if($mp->video_file != "")
                    	 <video height="100" controls>
                              <source src="{{ asset('/storage/'.$mp->video_file) }}" type="video/mp4">  
                        </video>
                    @endif
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

@extends('user.layout.app')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<section class="content">
	<div class="user-page">
  <div class="row">
    @include('user.includes.links')
    <div class="col-md-9 user-rigtpart">
    	 @include('common.notify')
        <h1>My Proposals</h1>      
        <div class="right-side col-md-9">  
            <div class="content-area clearfix">
                <div class="post-list">
                		@foreach($ideas as $index => $idea)
            			<div class="content-box">
            				<h3 class="col-md-12">{{ $idea->title }} </h3>
            				<span class="publish-date col-md-12"> Published: {{  date('M d, Y', strtotime($idea->updated_at)) }} </span>
            <!-- 				<figure class="col-md-4 left-img"> -->
            <!-- 					<img src="{{ asset('/asset/images/content-img1.jpg') }}" alt="" /> -->
            <!-- 				</figure> -->
            				<div class="col-md-12">
            					<p> {!! str_limit($idea->description, $limit = 500, $end = '...')  !!} </p>
            					<a class="btn btn-default yellow-btn" href="{{route('proposaldetail',$idea->id)}}"> View Details </a>
            				</div>
            			  </div>
            			@endforeach
            			
                </div>
    			<div class="pagination">
    				{{ $ideas->links() }}
    			</div>
    		</div>
    	</div>
        
    </div>  
  </div>
</div>
</section>
<script type="text/javascript">
	$('.date').datepicker({
       format: 'mm-dd-yyyy'
     }); 
	 $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            var name = $(this).attr('name');
            $("#"+name+"text").val(fileName +  '" selected');            
        });
    }); 
</script>  
@endsection

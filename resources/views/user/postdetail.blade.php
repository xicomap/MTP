@extends('user.layout.app')
@section('content')
<section class="content">
	
	@include('user.includes.innovation_sidebar')   
	<div class="left-sec col-md-8">

				@include('common.notify')	
		
    			<div class="content-area clearfix">
            <div class="post-list">
      				<div >        				
      					<div class="col-md-12 pd0">
                  <h3>{{$idea->title}}</h3>
                  <span class="publish-date">Published: {{  date('M d, Y', strtotime($idea->updated_at)) }}</span>
						{!! $idea->description !!}



				<div class="input-row">
                  <form method="post" action="{{route('innovationapply')}}" class="clear">
        				{{ csrf_field() }}        
        					<input type="hidden" name="idea_id" value="{{$idea->id}}">
            				<div >            					
            					<button type="submit" class="btn btn-default yellow-btn">Send me to my competition</button>
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
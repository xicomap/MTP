@extends('user.layout.app')
@section('content')
<section class="content">
    		<div class="left-sec col-md-6">
    			<div class="content-area clearfix">
		            <div class="post-list">
	      				<div class="content-box">        				
	      					<div class="col-md-12 pd0">
			                  <h3>Top 10 Ideas</h3>
			                  @if (count($solutions)>0)
    			                  @foreach ($solutions as $idx=>$idea)
        			                  <ul class="ideas-listing">
        			                  	<li>
        			                  		<strong> {{$idx+1}}) </strong>
        			                  		<div class="col-md-offset-1">
        			                  		<h4> Published: {{date("M d, Y", strtotime($idea->updated_at))}} </h4>
        			                  		<p>{{$idea->comment}} </p>
        			                  		</div>
        			                  	</li>			                  	
        			                  </ul>
    							  @endforeach
							  @endif
	  					  <div class="winner-sec">
	  					  	<div class="h2 gry-heading"> Winner </div>
	  					  	<p> {{$winner->comment}}</p>
	  					  	<span class="name"> {{$winner->user->first_name}} {{$winner->user->last_name}}</span>
	  					  </div>
	      					</div>
	  					  </div>
	  					  
		            </div>
    			</div>
    		</div> 		
    		
    		
    		<div class="right-sec col-sm-6">
    				@if (count($articles)>0)
    				@foreach ($articles as $article)
        			<div class="content-box right-content">
      					<div class="col-md-12 pd0">
<!--       					<figure class="left-img"> -->
<!--       						<img src="images/content-img1.jpg" alt=""> -->
<!--       					</figure> -->
        				<h3>{{$article->title}} </h3>
      						<p> {!!$article->description!!} </p>
      					</div>
  					  </div>
  					 @endforeach
  					 @endif       			
    		</div>
    	</section>
@endsection
<div class="right-sec col-md-4">
		@if(!Auth::guard('user')->check() OR (Auth::guard('user')->check() && (Auth::guard('user')->user()->user_type == 2 || Auth::guard('user')->user()->user_type == 3) ) )
		
		
		<div class="list-grp"> 
			<h4 class="list-heading"><a href="{{ route('bestideas') }}">Sponsor or Invester on best idea?</a></h4>
			<!-- <ul class="side-menu">			
	    		<li> <a href="{{ route('bestideas') }}"><button class="btn btn-primary yellow">Sponser or invest on best idea? </button></a></li>
	    	</ul> -->
    	</div>
		@endif
		
		@if(!Auth::guard('user')->check() OR (Auth::guard('user')->check() && (Auth::guard('user')->user()->user_type == 4) ) ) 
		
		<div class="list-grp">
			<h4 class="list-heading"><a href="{{ route('userpost') }}">Metec Employee</a></h4>
			<!-- <ul class="side-menu">			
	    		<li> <a href="{{ route('userpost') }}"><button class="btn btn-primary yellow"> Metec Employee?</button></a></li>
	    	</ul> -->
    	</div>
		@endif
		
		<div class="list-grp">
			<h4 class="list-heading">Idea Competitions</h4>
			<ul class="side-menu scroll-way">
				@if (!empty($ideas))
	    			@foreach($ideas as $index => $idea)
	    				<li> <a href="{{url('/detail/'.$idea->id)}}">{{$idea->title}}</a> <i class="fa fa-angle-right"></i></li>
	    			@endforeach
				@endif
			</ul>
		</div>
		
		<div class="list-grp">
			<h4 class="list-heading">Top ten idea competition winners</h4>
			<ul class="side-menu listings scroll-way">			
				@if (!empty($top10))
	    			@foreach($top10 as $index => $idea)
	    				<li> {{$idea->first_name}} {{$idea->last_name}} <i class="fa fa-angle-right"></i></li>
	    			@endforeach
				@endif
			</ul>
		</div>
		
		<!-- 
		<h4 class="list-heading">Our Staff</h4>
		<div class="x_content">
    <ul class="list-unstyled msg_list">
      <li>
        <a>
          <span class="image">
            <img src="{{ asset('/asset/images/img1.jpg') }}" alt="img">
          </span>
          <div class="name"><span>Charles Nicholes</span></div>
          <span class="message">Ceo &amp; Managing Director</span>
        </a>
      </li>
      <li>
        <a>
          <span class="image">
            <img src="{{ asset('/asset/images/img2.jpg') }}" alt="img">
          </span>
          <div class="name"><span>Rebecca Garza</span></div>
          <span class="message">Business Developer</span>
        </a>
      </li>
      <li>
        <a>
          <span class="image">
            <img src="{{ asset('/asset/images/img3.jpg') }}" alt="img">
          </span>
          <div class="name"><span>Stepthen Adams</span></div>
          <span class="message">Finance Officer</span>
        </a>
      </li>
      <li>
        <a>
          <span class="image">
            <img src="{{ asset('/asset/images/img4.jpg') }}" alt="img">
          </span>
          <div class="name"><span>Ben Johnson</span></div>
          <span class="message">Marketing Officer</span>
        </a>
      </li>
    </ul>
  </div> -->
</div>  
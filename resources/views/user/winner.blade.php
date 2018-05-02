@extends('user.layout.app')
@section('content')
<section class="content">
	
	
	<div class="col-md-5 mbpd0">
		<div class="para-desc">
			<p><?php echo strip_tags($page_content->content );?></p>
		</div>
	</div>
	<div class="col-md-7 mbpd0">
  
		<div class="content-area clearfix">
           
            
            <h3 class="mb-1">
               Top ten public challange soloution providers winners
            </h3>		
    		<div class="winner-sec">
            @if (!$top10ch->isEmpty())
    			<ul class="winner-list">
                    @foreach($top10ch as $index => $ideach)
    				<li>
    					<figure class="win-icon"> <img src="https://cdn2.iconfinder.com/data/icons/thin-line-icons-for-seo-and-development-1/64/SEO_awards-256.png" /> </figure> 
    					<span class="count"> {{ $index + 1 }} </span>
    					<span class="winner-name"> {{$ideach->first_name}} {{$ideach->last_name}} </span>
    				</li>
                    @endforeach
    			</ul> 
             @else
                <p> Winners, Coming Soon!</p>
             @endif    			
    		</div>
		</div>
		
		
  
		<div class="content-area clearfix">
           
            
            <h3 class="mb-1">
                Top ten idea competition winners 
            </h3>	
    		<div class="winner-sec">
                 @if (!$top10->isEmpty())
    			    <ul class="winner-list">                
                        @foreach($top10 as $index => $idea)
                            <li>
                                <figure class="win-icon"> <img src="https://cdn2.iconfinder.com/data/icons/thin-line-icons-for-seo-and-development-1/64/SEO_awards-256.png" /> </figure> 
                                <span class="count"> {{ $index + 1 }} </span>
                                <span class="winner-name">{{$idea->first_name}} {{$idea->last_name}} </span>
                            </li>                       
                        @endforeach
    			    </ul> 
                 @else
                    <p> Winners, Coming Soon!</p>
                 @endif   			
    		</div>
		</div>
	</div> 		
	 
	
</section>
@endsection
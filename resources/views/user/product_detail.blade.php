@extends('user.layout.app')
@section('content')
<section class="content marketing details articles"> 

	
    @if($related_video) 
    <div class="right-sec col-md-4">

    <div class="category-sec">      
      <h3> Categories </h3>
      <div class="scroll-way">
      	<ul>
        @if($cats) 
            @foreach($cats as $cat) 
              <li> <a href="{{ url('/product/category')}}/{{$cat->id}}">{{$cat->name}} </a></li>
            @endforeach 
          @endif
          </ul>    
      </div>  
    </div>

    <div class="article-sec">       
      <h3> Latest Products </h3>
      <div class="scroll-way">
         @foreach($lates_product as $product)         
              <div class="product-cat col-sm-6">
                @if($product->picture)
			  	<div class="product-img">
			  		<div class="img" style="background: url({{asset('/storage/'.$product->picture)}}) no-repeat center center / cover;"> </div>
                  <!-- <img src="{{asset('/storage/'.$product->picture)}}" style="max-width: 100%; margin-bottom: 10px;"/> -->
                </div>
                @endif          
                <a class="titles" href="{{ url('/product/detail') }}/{{$product->id}}" target="_blank">  {{$product->title}}</a>
                <span class="post-on">  Added {{$product->created_at->diffForHumans()}}  </span>
              </div>
            @endforeach
      
      </div>      
    </div>

     <div class="article-sec">       
      <h3> Featured Products </h3>
      <div class="scroll-way">
         @foreach($related_video as $product)         
              <div class="product-cat col-sm-6">
                @if($product->picture)
			  	<div class="product-img">
			  		<div class="img" style="background: url({{asset('/storage/'.$product->picture)}}) no-repeat center center / cover;"> </div>
                  <!-- <img src="{{asset('/storage/'.$product->picture)}}" style="max-width: 100%; margin-bottom: 10px;"/> -->
                </div>
                @endif          
                <a class="titles" href="{{ url('/product/detail') }}/{{$product->id}}" target="_blank">  {{$product->title}}</a>
                <span class="post-on">  Added {{$product->created_at->diffForHumans()}}  </span>
              </div>
            @endforeach
      
      </div>      
    </div>
    
      @endif




        
  </div>
    
    
	 <div class="left-sec col-md-8">

    @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
    @endif 
    <div class="article-sec">
      <!-- <h3>  </h3> -->
        <h2 class="video-title">{{ $video_detail->title}} </h2>
        <div class="post-by">
                 <span class="total-views">Total views : <strong>{{ $video_detail->total_views}}</strong></span></div>
         @if($video_detail->picture)
         <div class="prdct-sec">
      		<img class="bigger-img" src="{{asset('/storage/'.$video_detail->picture)}}" />
      	 </div>
    @endif
        
    <?php echo $video_detail->description;?>
    
    <div class="bottom-sec brb">

   <!--  <a href="{{ url('/mail/product') }}/{{$video_detail->id}}" >Send Mail</a> -->


     <form method="post"  action="{{URL::to('mail/product')}}">
		<div class="col-sm-6 col-xs-6 email-send">
	     <div id="sendmail" class="mail-btn">Send product details on email</div>
		     <input type="email" name="send_mail" class="" id="send_email" required placeholder="add your email here.." />
		     <input type="hidden" name="product_id" id="product_id" value="{{ $video_detail->id}} ">
		     <input type="hidden" name="_token" value="{{ csrf_token() }}">
     	 </div>
      
		 <div class="captcha-sec-1 col-xs-6 pd0">
			<div class="mail-btn">Security text</div>
            <div class="col-xs-5 pd0">
                {!! html_entity_decode(Captcha::img('flat')) !!}
            </div>
            <div class="col-xs-7">
                <input id="captcha" placeholder="Enter above text" type="text" class="form-control" name="captcha" required>
            </div>
         </div>
         <div class="col-md-12 submit-sec">
	     	 <input type="submit" name="Send" value="Send Mail" class="btn yellow send-btn" />
	     </div>
                        
                        
     </form>

         <div class="col-md-12 submit-sec">
		    @if($video_detail->pdf_link)
		      <a href="{{asset('/storage/'.$video_detail->pdf_link)}}" class="download">Download Product Manual</a>
		    @endif
	     </div>
     </div>
   
   
    </div>  


        @if($setting->type == 2)
          <div class="comments-section">
            <h3 class="short-title">Post your comment</h3>
              <form action="{{route('productcomment',$video_detail->id)}}" method="post" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal full-form">
                  {{ csrf_field() }} 
                  <div class="col-sm-2 col-xs-2 pd0">
                    @if(Auth::guard('user')->check()) 
                     <img src="{{asset('/storage/'.Auth::guard('user')->user()->picture)}}" alt="" class="fig-avatar" />
                    @else
                     <img src="https://demo.phpmelody.com/uploads/avatars/default.gif" alt="" />
                    @endif
                  </div>
                  <div class="col-sm-10 col-xs-9 pd0">
                    <textarea class="text-area" name="comment" placeholder="Your Comment" required="required"></textarea>
                    <input type="submit" class="submit-btn yellow btn" value="Submit" />
                  </div>
              </form>
          </div>
        @elseif($setting->type == 1)

          @if(Auth::guard('user')->check()) 
            <div class="comments-section">
              <h3 class="short-title">Post your comment</h3>
              <form action="{{route('productcomment',$video_detail->id)}}" method="post" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal full-form">
                  {{ csrf_field() }} 
                  <div class="col-sm-2 pd0">
                    <img src="{{asset('/storage/'.Auth::guard('user')->user()->picture)}}" alt="" />
                  </div>
                  <div class="col-sm-10 pd0">
                    <textarea class="text-area" name="comment" placeholder="Your Comment" required="required"></textarea>
                    <input type="submit" class="submit-btn yellow btn" value="Submit" />
                  </div>
              </form>
            </div>          
          @else
            <p>Only Logged in user can comment</p>
          @endif

        @endif  


          @if($product_comment)
          <div class="view-comments">
            <h3 class="short-title"> Comments </h3>

            
              @foreach ($product_comment as $con)
                  <div class="comment-row">
                    

                    @if($con->user)
                      <figure class="user-img">
                       <img src="{{asset('/storage/'.$con->user->picture)}}" />
                      </figure>
                    @else
                     <figure class="user-img">
                      <img src="https://demo.phpmelody.com/uploads/avatars/default.gif" />
                      </figure>
                    @endif
                <div class="right-comment">
                				@if($con->user)	
                      				<span class="name"> {{$con->user->first_name}} </span>	
				        		@else	
				                	<span class="name"> Anonymus </span> 
				                @endif
                      <span class="cmnt-on">Added {{$con->created_at->diffForHumans()}}</span>
                      <p class="comment">{!!$con->comment!!} </p>
                  <!-- <a class="reply-btn" href="#_"> Reply </a> -->
                </div>            

                  </div>
              @endforeach
          </div>
        @endif
    
    
   

  </div>
		
			
</section>
@endsection

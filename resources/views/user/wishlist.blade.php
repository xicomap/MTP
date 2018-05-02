@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row mr0">
    @include('user.includes.links')
    <div class="col-md-9 user-rigtpart table-sec">
    	 @include('common.notify')
        @if ($type == 1) 			
        <h1>My Idea Wishlist</h1>      
         @elseif($type == 2)
         <h1>My Public Challenges Wishlist</h1>      
         @endif
         
     
  		<div class="detail-row">
                @foreach($ideas as $index => $inv) 
		  		<div class="detail-column">
		  			<div class="competition">
		  				<div class="sec-row">
		  					<label> Competator ID </label>   
		  					<span>
		  						@if($inv->applicant)
		  							{{ $inv->applicant->user_id }}
		  						@endif
		  					</span>
		  				</div>
		  				<div class="sec-row">
		  					@if ($type == 1)  
		  						<label> Idea Competition Name</label> 
		  					 @elseif($type == 2) 
		  					 	<label> Public Challenge Name</label>
		  					 @endif    
		  					<span>
		  						@if($inv->applicant)
		  							{{ $inv->applicant->idea['title'] }}
		  						@endif
		  					</span>
		  				</div>
		  				<div class="sec-row">
		  					<label>Summary</label>   
		  					<span>
		  						@if($inv->applicant)
		  							{!! $inv->applicant->comment !!}
		  						@endif
		  					</span>
		  				</div>

		  				<div class="sec-row">
		  					<label>Offer</label>   
		  					<span>
		  						{{ ($inv->offer == 0) ? '' : "$".$inv->offer }}
		  					</span>
		  				</div>


		  				<div class="sec-row">
		  					<label>Status</label>   
		  					<span>
		  						{{ ideaStatusName($inv->status) }}
		  					</span>
		  				</div>



		  				<form action="{{route('ideaswishlist')}}" method="POST" role="form" class="form-horizontal clear">
                    		{{ csrf_field() }}   
			  				<div class="sec-row">
			  					<label> Action </label>
			  					<span> <a href="{{ route('setoffer',$inv->id) }}" class="apply btn yellow-btn">Edit/View</a></span>
			  				</div>    
                    	</form>		  				
		  			</div>
		  		</div>
                @endforeach
  		</div>
  		
  		
         
    </div>  
  </div>
</div>
</section>
@endsection

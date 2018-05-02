@extends ('user.layout.app')
@section('content')
<section class="content">
	<div class="full-width faq-page">
		
		<h1>FAQs</h1>		
		
		<div class="post-grids">
		<!-- Accordion begin -->
			<div class="accordion_example2">			
				@foreach($faqs as $fq)	
					<div class="accordion_in">
						<div class="acc_head">
							<h4>{{$fq->question}}</h4>		
						</div>
						<div class="acc_content">					
							<p>{!!$fq->answer!!}</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endsection

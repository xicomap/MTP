@extends ('user.layout.app')
@section('content')
<section class="content">
	<div class="full-width">
		
		<h1><?php echo $static->heading; ?></h1>
		<p><?php echo $static->content; ?></p>
		
		<!--<div class="post-grids">
			<div class="row">
				<div class="col-md-4">
					<div class="post-img">
						<img src="{{asset('/asset/images/post-img1.jpg')}}" alt="">
					</div>
					<h4>We Are Best Team</h4>
					<h3>Make Business Strategy</h3>
					<p>Contrary to popular belief, Lorem Ipsum is not simply random
						text. It has roots in a piece of classical Latin literature from</p>
				</div>
				<div class="col-md-4">
					<div class="post-img">
						<img src="{{asset('/asset/images/post-img2.jpg')}}" alt="">
					</div>
					<h4>The Best Company</h4>
					<h3>Company of Professionals</h3>
					<p>Contrary to popular belief, Lorem Ipsum is not simply random
						text. It has roots in a piece of classical Latin literature from</p>
				</div>
				<div class="col-md-4">
					<div class="post-img">
						<img src="{{asset('/asset/images/post-img3.jpg')}}" alt="">
					</div>
					<h4>Always Forvard</h4>
					<h3>We Love Our Clients</h3>
					<p>Contrary to popular belief, Lorem Ipsum is not simply random
						text. It has roots in a piece of classical Latin literature from</p>
				</div>
			</div>
		</div>-->
	</div>
</section>
@endsection

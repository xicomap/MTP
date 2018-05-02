<div class="col-md-3 user-sidebar">
	<div class="user-image">
		<img src="{{asset('/asset/images/user-img-large.jpg')}}" alt="">
	</div>
	<ul class="side-menu">
		<li class="{{ (Request::path() == 'best/ideas' && Request::query('type') == 1) ? 'active' : '' }}"><a
			href="{{ route('bestideas')}}?type=1">Best idea competition<i
				class="fa fa-angle-right"></i></a>
		</li>
		<li class="{{ (Request::path() == 'ideas/wishlist' && Request::query('type') == 1) ? 'active' : '' }}"><a
			href="{{route('userwishlist')}}?type=1">Wishlist for idea competition <i
				class="fa fa-angle-right"></i></a>
		</li>
		<li class="{{ (Request::path() == 'best/ideas' && Request::query('type') == 2) ? 'active' : '' }}"><a
			href="{{ route('bestideas')}}?type=2">Best public challenges<i
				class="fa fa-angle-right"></i></a>
		</li>
		<li class="{{ (Request::path() == 'ideas/wishlist' && Request::query('type') == 2) ? 'active' : '' }}"><a
			href="{{route('userwishlist')}}?type=2">Wishlist for public challenges <i
				class="fa fa-angle-right"></i></a>
		</li>				
	</ul>
</div>
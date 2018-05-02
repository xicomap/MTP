
<!-- Header -->
<div class="site-header">
	<nav class="navbar navbar-light">
		<div class="navbar-left">
			<a class="navbar-brand" href="{{url('admin/dashboard')}}">
				<div class="logo">
					<img src="{{asset('/asset/logo.png')}}" alt="">
				</div>
			</a>
			<div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
				<span class="hamburger"></span>
			</div>
			<div class="toggle-button-second dark float-xs-right hidden-md-up">
				<i class="ti-arrow-left"></i>
			</div>
			<div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
				<span class="more"></span>
			</div>
		</div>
		<div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
			<div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down">
				<span class="hamburger"></span>
			</div>

			<ul class="nav navbar-nav">
				<li class="nav-item hidden-sm-down">
					<a class="nav-link toggle-fullscreen" href="#">
						<i class="ti-fullscreen"></i>
					</a>
				</li>
			</ul>
			
			<ul class="nav navbar-nav float-md-right">
				<li class="nav-item dropdown hidden-sm-down">
					<a href="#" data-toggle="dropdown" aria-expanded="false">
						
							<img src="{{asset('/main/avatar.jpg')}}" alt="" style="display:inline-block;width:40px;">
							<p style="width: auto; display: inline-block;">{{Auth::guard('admin')->user()->first_name.' '.Auth::guard('admin')->user()->last_name}}</p>
						
					</a>
					<div class="dropdown-menu dropdown-menu-right animated fadeInUp">
						<a class="dropdown-item" href="{{route('admin.profile')}}">
							<i class="ti-user mr-0-5"></i> @lang('admin.include.profile')
						</a>
						<a class="dropdown-item" href="{{route('admin.password')}}">
							<i class="ti-settings mr-0-5"></i> @lang('admin.account.change_password')
						</a>
						<div class="dropdown-divider"></div>						
						<a class="dropdown-item" href="{{ url('/admin/logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"><i class="ti-power-off mr-0-5"></i> @lang('admin.include.sign_out')</a>
					</div>
				</li>
			</ul>

		</div>
	</nav>
</div>
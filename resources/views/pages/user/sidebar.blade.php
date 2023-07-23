<ul class="navbar-nav bg-gt-primary sidebar sidebar-dark accordion mt-3" id="accordionSidebar">
	<li class="nav-item @if(Request::is('user/dashboard')) active @endif">
	  	<a class="nav-link collapsed" href="{{ route('user.dashboard') }}">
	    	<i class="fas fa-tachometer-alt"></i>
	    	<span>Dashboard</span>
	  	</a>
	</li>

	<li class="nav-item @if(Request::is('user/profile')) active @endif">
	  	<a class="nav-link" href="{{ route('user.profile') }}">
	    	<i class="fa fa-user"></i>
	    	<span>Profile</span>
	    </a>
	</li>

	<li class="nav-item @if(Request::is('user/job-listing')) active @endif">
	  	<a class="nav-link" href="{{ route('user.jobs') }}">
	    	<i class="fa fa-briefcase"></i>
	    	<span>Jobs</span>
	    </a>
	</li>

	<li class="nav-item @if(Request::is('user/password-change')) active @endif">
	  	<a class="nav-link" href="{{ route('user.password') }}">
	    	<i class="fa fa-user"></i>
	    	<span>Reset Password</span>
	    </a>
	</li>

	<li class="nav-item">
		<a class="nav-link" href="{{ route('logout') }}"
		   onclick="event.preventDefault();
		                 document.getElementById('logout-form').submit();">
		    <i class="fas fa-sign-out-alt"></i>
		   	<span>Logout</span>
		</a>	  	
	</li>
</ul>
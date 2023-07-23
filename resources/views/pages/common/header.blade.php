<div class="container-fluid main-bg">
    <div class="container-lg">
        <div class="row align-items-center">
            <div class="col-md-2 order-lg-1 nav-logo-css">
                <a href="{{ url('/') }}">
                    {!! get_site_title_logo() !!}
                </a>
            </div>
            {{-- <div class="col-md- order-lg-3 nav-main-btn">
                <button type="button" class="btn-hover req-for-call" data-toggle="modal" data-target="#myModal">
                    Request For Call Back
                </button>
                <a href="#">JOB BOARD</a>                
            </div> --}}
            <div class="col-md-10 order-lg-2 normal-nav text-right">
                <ul class="menu">
                    {{-- <li>
                        <a href="{{ url('/') }}" class="nav-hide me-sm-4">Home</a>
                    </li> --}}
                    {!! get_header_menu('primary-menu') !!}
                    <li>
                        <a href="{{ route('frontend.blogs') }}" class="nav-hide me-sm-4">Blogs</a>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                @if(Auth::user()->role_id == 2)
                                    <a class="dropdown-item" href="{{ route('employer.dashboard') }}">Dashboard</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a>
                                @endif
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>            
        </div>
    </div>
</div>

<div class="modal fade pop-up-model" id="myModal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content model-bg">            
            <div class="modal-body popup-model-body">
                <div class="popup-outer-layout">
                    <div class="row">
                        <div class="col-md cross-btn d-flex justify-content-end">
                            <button type="button" class="btn-close btn-pos" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md main-head-pop">
                            <h3 class="mb-3">Start employing anywhere</h3>
                            <p class="mb-5">We’ll contact you to schedule a call, answer any questions you may have, and start onboarding your employees.</p>
                        </div>
                    </div>
                    <form method="post" action="{{ route('frontend.contact.form') }}" id="create-form">
                        <div class="row">
                            <div class="col-md mb-4">
                                <input type="text" placeholder="What's your name?" name="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md mb-4">
                                <input type="email" placeholder="What's your email?" name="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md mb-4">
                                <input type="text" placeholder="Company Name" name="company_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md mb-4">
                                <input type="text" placeholder="Your Phone Number" name="phone_number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md mb-4">
                                <textarea rows="4" cols="30" placeholder="Your Message" name="message"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md mb-3 popup-btn">
                                <p class="text-start">By signing and clicking Submit, you affirm you have read and agree to the <span style="color:orange;">Terms of Use</span></p>
                                <button class="btn-submit mb-5 add-podcast-btn" type="submit">CONTACT US</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
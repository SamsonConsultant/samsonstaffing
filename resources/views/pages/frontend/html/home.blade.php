<style>
    header .item {
    height: 80vh;
    position: relative;
  }
  header .item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  header .item .cover {
    padding: 75px 0;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
  }
  header .item .cover .header-content {
    position: relative;
    padding: 56px;
    overflow: hidden;
  }
  header .item .cover .header-content .line {
    content: "";
    display: inline-block;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    position: absolute;
    border: 9px solid #fff;
    -webkit-clip-path: polygon(0 0, 60% 0, 36% 100%, 0 100%);
    clip-path: polygon(0 0, 60% 0, 36% 100%, 0 100%);
  }
  header .item .cover .header-content h2 {
    font-weight: 300;
    font-size: 35px;
    color: #fff;
  }
  header .item .cover .header-content h1 {
    font-size: 56px;
    font-weight: 600;
    margin: 5px 0 20px;
    word-spacing: 3px;
    color: #fff;
  }
  header .item .cover .header-content h4 {
    font-size: 24px;
    font-weight: 300;
    line-height: 36px;
    color: #fff;
  }
  header .owl-item.active h1 {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    animation-name: fadeInDown;
    animation-delay: 0.3s;
  }
  header .owl-item.active h2 {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    animation-name: fadeInDown;
    animation-delay: 0.3s;
  }
  header .owl-item.active h4 {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    animation-name: fadeInUp;
    animation-delay: 0.3s;
  }
  header .owl-item.active .line {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    animation-name: fadeInLeft;
    animation-delay: 0.3s;
  }
  header .owl-nav .owl-prev {
    position: absolute;
    left: 15px;
    top: 43%;
    opacity: 0;
    -webkit-transition: all 0.4s ease-out;
    transition: all 0.4s ease-out;
    background: rgba(0, 0, 0, 0.5) !important;
    width: 40px;
    cursor: pointer;
    height: 40px;
    position: absolute;
    display: block;
    z-index: 1000;
    border-radius: 0;
  }
  header .owl-nav .owl-prev span {
    font-size: 1.6875rem;
    color: #fff;
  }
  header .owl-nav .owl-prev:focus {
    outline: 0;
  }
  header .owl-nav .owl-prev:hover {
    background: #000 !important;
  }
  header .owl-nav .owl-next {
    position: absolute;
    right: 15px;
    top: 43%;
    opacity: 0;
    -webkit-transition: all 0.4s ease-out;
    transition: all 0.4s ease-out;
    background: rgba(0, 0, 0, 0.5) !important;
    width: 40px;
    cursor: pointer;
    height: 40px;
    position: absolute;
    display: block;
    z-index: 1000;
    border-radius: 0;
  }
  header .owl-nav .owl-next span {
    font-size: 1.6875rem;
    color: #fff;
  }
  header .owl-nav .owl-next:focus {
    outline: 0;
  }
  header .owl-nav .owl-next:hover {
    background: #000 !important;
  }
  header:hover .owl-prev {
    left: 0px;
    opacity: 1;
  }
  header:hover .owl-next {
    right: 0px;
    opacity: 1;
  }
</style>
<header>
            <div class="hero-owl-carousel owl-carousel owl-theme">
                <div class="item">
                    <img src="{{ asset('public/images/Frame-7.png') }}" alt="hero">
                    <div class="cover">
                        <div class="container">
                            <div class="header-content">
                                <div class="line"></div>
                                <h2>Reimagine Digital Experience with</h2>
                                <h1>Start-ups and solutions</h1>
                                <h4>We help entrepreneurs, start-ups and enterprises shape their ideas into products</h4>
                            </div>
                        </div>
                     </div>
                </div>                    
                <div class="item">
                    <img src="{{ asset('public/images/Frame-8.png') }}" alt="hero">
                    <div class="cover">
                        <div class="container">
                            <div class="header-content">
                                <div class="line animated bounceInLeft"></div>
                                <h2>Reimagine Digital Experience with</h2>
                                <h1>Intelligent solutions</h1>
                                <h4>We help entrepreneurs, start-ups and enterprises shape their ideas into products</h4>
                            </div>
                        </div>
                     </div>
                </div>                
                <div class="item">
                    <img src="{{ asset('public/images/Frame-9.png') }}" alt="hero">
                    <div class="cover">
                        <div class="container">
                            <div class="header-content">
                                <div class="line animated bounceInLeft"></div>
                                <h2>Peimagine Digital Experience with</h2>
                                <h1>Intelligent Solutions</h1>
                                <h4>We help entrepreneurs, start-ups and enterprises shape their ideas into products</h4>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </header>


<div class="container-fluid bg-of-nav pb-5">
    <div class="container">
        <div class="row main-section">
            <div class="col-md pb-md-5">
                {!! get_option_extra('top_content') !!}
                {{-- <a href="{{ route('frontend.show.page', base64_encode(get_option_extra('top_link'))) }}" class="btn-hover">RECRUIT WITH US</a> --}}
                <button type="button" class="btn-hover req-for-call" data-toggle="modal" data-target="#myModal">
                    Request For Call Back
                </button>
                <a href="{{ route('frontend.jobs') }}">JOB BOARD</a>
            </div>
            <div class="col-md-5 mt-md-5 pt-md-5">
                <div class="me-4">
                    @if(!empty(get_option_extra('top_banner')))
                        <img src="{{ asset('public') }}/{{ get_option_extra('top_banner')}}">
                    @endif
                </div>
            </div>
        </div>
    </div>        
</div>


<div class="container-fluid j-first-section">
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h1>Smarter takes you</h1>
            </div>
        </div>
        <form method="get" action="{{ route('frontend.jobs') }}">
            <div class="row">
                <div class="col-md-9">
                    <label for="keyword">Keyword</label>
                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Enter the value">
                </div>            
                <div class="col-md-3">
                    <span class="advance-search-text d-inline-block"></span>
                    <button type="submit" class="search-btn btn">Search Job</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container mt-md-5">
    <div class="row">
        <div class="col-md second-sec-col-1">
            <h2 class="mt-5 pt-md-5 mb-md-4 pb-3 text-center">{{ get_option_extra('f_main_title') }}</h2>
            <h4 class="text-center pb-md-5 mb-5">{{ get_option_extra('f_sub_title') }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md spec-row-col col-1-color">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="36" viewBox="0 0 34 36">
                <path
                    d="M6.52344 26.0156H16.5078V28.8281H6.52344V26.0156ZM6.52344 23.2734H16.5078V20.4609H6.52344V23.2734ZM6.52344 17.7188H23.75V14.9062H6.52344V17.7188ZM33.1016 36H30.2891C30.2891 33.1696 27.9866 30.8672 25.1562 30.8672C22.3259 30.8672 20.0234 33.1696 20.0234 36H17.2109C17.2109 33.0408 18.8372 30.4547 21.2429 29.0874C20.4409 28.1717 19.9531 26.9742 19.9531 25.6641C19.9531 22.795 22.2872 20.4609 25.1562 20.4609C28.0253 20.4609 30.3594 22.795 30.3594 25.6641C30.3594 26.9742 29.8716 28.1717 29.0696 29.0874C31.4753 30.4547 33.1016 33.0408 33.1016 36ZM25.1562 28.0547C26.4743 28.0547 27.5469 26.9821 27.5469 25.6641C27.5469 24.346 26.4743 23.2734 25.1562 23.2734C23.8382 23.2734 22.7656 24.346 22.7656 25.6641C22.7656 26.9821 23.8382 28.0547 25.1562 28.0547ZM5.04688 33.1875H14.7722C14.5289 34.0845 14.3984 35.0272 14.3984 36H5.04688C2.72052 36 0.828125 34.1076 0.828125 31.7812V4.21875C0.828125 1.8924 2.72052 0 5.04688 0H19.3736L29.3673 10.0445V18.8484C28.5205 18.3227 27.5776 17.9508 26.5625 17.7709V12.0311H21.5626C19.2363 12.0311 17.3439 10.1387 17.3439 7.81238V2.8125H5.04688C4.27151 2.8125 3.64062 3.44339 3.64062 4.21875V31.7812C3.64062 32.5566 4.27151 33.1875 5.04688 33.1875ZM21.5626 9.21863H24.5841L20.1564 4.77246V7.81238C20.1564 8.58801 20.787 9.21863 21.5626 9.21863Z">
                </path>
            </svg>
            {!! get_option_extra('project_hire') !!}
            <a href="{{ route('frontend.show.page', base64_encode(get_option_extra('project_link'))) }}">Read More <i aria-hidden="true" class="fas fa-long-arrow-alt-right"></i></a>
        </div>
        <div class="col-md spec-row-col col-2-color">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                <path d="M7.76999 33.9262L9.75772 35.9139L14.0095 31.6621L12.0217 29.6744L7.76999 33.9262Z"></path>
                <path d="M4.32588 21.9783L0.0741417 26.23L2.06187 28.2178L6.31361 23.966L4.32588 21.9783Z"></path>
                <path d="M6.78512 27.2139L0.0736825 33.9254L2.06141 35.9131L8.77285 29.2017L6.78512 27.2139Z">
                </path>
                <path
                    d="M17.6535 19.6693C18.4297 19.6693 19.059 19.04 19.059 18.2637C19.059 17.4874 18.4297 16.8582 17.6535 16.8582C16.8772 16.8582 16.2479 17.4874 16.2479 18.2637C16.2479 19.04 16.8772 19.6693 17.6535 19.6693Z">
                </path>
                <path
                    d="M34.4619 0.0630001C34.3535 0.0674298 31.7678 0.183586 28.3402 1.13738C23.7757 2.40743 19.8581 4.58375 17.0108 7.43092C15.1714 9.2703 13.4187 11.5333 11.9487 13.6391L10.6028 12.2932C9.56635 11.2567 8.18843 10.6816 6.72269 10.6737C6.7125 10.6737 6.70237 10.6737 6.69218 10.6737C5.2398 10.6737 3.86934 11.2318 2.82962 12.2473L0.0136719 14.9604V17.6312H1.61434C3.10687 17.6312 4.50988 18.2127 5.56464 19.2682L16.7302 30.4487C17.786 31.5036 18.3674 32.9067 18.3674 34.3993V36H21.0382L23.7514 33.1839C24.774 32.137 25.3328 30.7546 25.3249 29.2909C25.317 27.8252 24.7419 26.4473 23.7055 25.4109L22.3506 24.056C24.4524 22.5784 26.7145 20.8183 28.5564 18.9764C31.4036 16.1291 33.5799 12.2115 34.8499 7.64706C35.8036 4.21939 35.9198 1.63371 35.9243 1.52529L35.9874 0L34.4619 0.0630001ZM8.8017 18.5317L7.55337 17.2817C6.51865 16.246 5.26125 15.5139 3.88902 15.1302L4.78382 14.2681L4.7917 14.2605C5.85131 13.2233 7.56652 13.2326 8.61488 14.281L10.3541 16.0202C9.73468 16.983 9.20832 17.8459 8.8017 18.5317ZM21.7382 31.222L20.8684 32.1247C20.4848 30.7526 19.753 29.4954 18.718 28.4614L17.4767 27.2184C18.1582 26.81 19.0174 26.2808 19.9769 25.6582L21.7176 27.3988C22.7661 28.4472 22.7754 30.1622 21.7382 31.222ZM26.5685 16.9887C23.0122 20.5451 17.5684 23.9029 15.4251 25.164L10.8564 20.5891C12.1056 18.4403 15.4385 12.9788 18.9985 9.41873C20.9845 7.43275 23.3269 6.05926 25.4981 5.11553L30.8716 10.489C29.928 12.6602 28.5545 15.0027 26.5685 16.9887ZM32.1218 6.96475C32.0656 7.16472 32.0049 7.37116 31.9404 7.58237L28.4049 4.04691C28.6161 3.98237 28.8226 3.92176 29.0226 3.86558C30.5767 3.42887 31.9519 3.18108 32.9452 3.04215C32.8062 4.03559 32.5584 5.41056 32.1218 6.96475Z">
                </path>
                <path
                    d="M21.5182 15.8742C22.2944 15.8742 22.9237 15.2449 22.9237 14.4686C22.9237 13.6924 22.2944 13.0631 21.5182 13.0631C20.7419 13.0631 20.1126 13.6924 20.1126 14.4686C20.1126 15.2449 20.7419 15.8742 21.5182 15.8742Z">
                </path>
                <path
                    d="M25.454 12.009C26.2303 12.009 26.8596 11.3798 26.8596 10.6035C26.8596 9.82723 26.2303 9.19795 25.454 9.19795C24.6777 9.19795 24.0485 9.82723 24.0485 10.6035C24.0485 11.3798 24.6777 12.009 25.454 12.009Z">
                </path>
            </svg>
            {!! get_option_extra('rpo_service') !!}
            <a href="{{ route('frontend.show.page', base64_encode(get_option_extra('rpo_link'))) }}">Read More <i aria-hidden="true" class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md spec-row-col col-3-color">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="36" viewBox="0 0 30 36">
                <path
                    d="M25.0467 2.17969H14.262C13.5418 0.881104 12.1573 0 10.5703 0C8.98334 0 7.59879 0.881104 6.87863 2.17969H4.94531C2.61896 2.17969 0.726562 4.07208 0.726562 6.39844V31.7812C0.726562 34.1076 2.61896 36 4.94531 36H25.047C27.3731 36 29.2657 34.1076 29.2657 31.7812V6.39844C29.2655 4.07208 27.3731 2.17969 25.0467 2.17969ZM26.453 31.7812C26.453 32.5566 25.8221 33.1875 25.0467 33.1875H4.94531C4.16995 33.1875 3.53906 32.5566 3.53906 31.7812V6.39844C3.53906 5.62308 4.16995 4.99219 4.94531 4.99219H11.9766V15.0469C11.9766 15.8222 11.3457 16.4531 10.5703 16.4531C9.79495 16.4531 9.16406 15.8222 9.16406 15.0469V8.29688H6.35156V15.0469C6.35156 17.3732 8.24396 19.2656 10.5703 19.2656C12.8967 19.2656 14.7891 17.3732 14.7891 15.0469V4.99219H25.047C25.8224 4.99219 26.4532 5.62308 26.4532 6.39844V31.7812H26.453ZM6.35156 27.5625H17.9531V30.375H6.35156V27.5625ZM6.35156 22.0078H23.5781V24.8203H6.35156V22.0078ZM17.5312 16.5234H23.5781V19.3359H17.5312V16.5234ZM17.5312 10.9688H23.5781V13.7812H17.5312V10.9688Z">
                </path>
            </svg>
            {!! get_option_extra('cv_format') !!}
            <a href="{{ route('frontend.show.page', base64_encode(get_option_extra('cv_link'))) }}">Read More <i aria-hidden="true" class="fas fa-long-arrow-alt-right"></i></a>
        </div>
        <div class="col-md spec-row-col col-4-color">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                <path
                    d="M36 16.5938H33.1227C32.8011 13.068 31.2737 9.79514 28.7391 7.26086C26.2049 4.72632 22.932 3.19894 19.4062 2.87732V0H16.5938V2.87732C13.068 3.19894 9.79514 4.72632 7.26086 7.26086C4.72632 9.79514 3.19894 13.068 2.87732 16.5938H0V19.4062H2.87732C3.19894 22.932 4.72632 26.2049 7.26086 28.7391C9.79514 31.2737 13.068 32.8011 16.5938 33.1227V36H19.4062V33.1227C22.932 32.8011 26.2046 31.2737 28.7391 28.7391C31.2734 26.2049 32.8011 22.932 33.1227 19.4062H36V16.5938ZM19.4062 30.2945V27.6328H16.5938V30.2945C10.8916 29.6466 6.35339 25.1084 5.70547 19.4062H8.4375V16.5938H5.70547C6.35339 10.8916 10.8916 6.35339 16.5938 5.70547V8.4375H19.4062V5.70547C25.1084 6.35339 29.6466 10.8916 30.2945 16.5938H27.5625V19.4062H30.2945C29.6466 25.1084 25.1084 29.6466 19.4062 30.2945ZM21.4324 18.5499C21.9268 17.8588 22.2188 17.014 22.2188 16.1016C22.2188 13.7752 20.3264 11.8828 18 11.8828C15.6736 11.8828 13.7812 13.7752 13.7812 16.1016C13.7812 17.014 14.0732 17.8588 14.5676 18.5499C12.9076 19.6606 11.8125 21.5524 11.8125 23.6953H14.625C14.625 21.8342 16.1389 20.3203 18 20.3203C19.8611 20.3203 21.375 21.8342 21.375 23.6953H24.1875C24.1875 21.5524 23.0924 19.6606 21.4324 18.5499ZM16.5938 16.1016C16.5938 15.3262 17.2246 14.6953 18 14.6953C18.7754 14.6953 19.4062 15.3262 19.4062 16.1016C19.4062 16.8769 18.7754 17.5078 18 17.5078C17.2246 17.5078 16.5938 16.8769 16.5938 16.1016Z">
                </path>
            </svg>
            {!! get_option_extra('ex_search') !!}
            <a href="{{ route('frontend.show.page', base64_encode(get_option_extra('es_link'))) }}">Read More <i aria-hidden="true" class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
</div>

<div class="container-fluid mt-5 pd-md-5">
    <div class="container">
        <div class="row third-section-col">
            <div class="col-md third-section-col-1">
                {!! get_option_extra('s_short_content') !!}
                <a href="{{ route('frontend.show.page', base64_encode(get_option_extra('second_link'))) }}" class="btn-hover">MORE ABOUT US</a>
            </div>
            <div class="col-md">
                @if(!empty(get_option_extra('s_banner')))
                    <img src="{{ asset('public') }}/{{ get_option_extra('s_banner')}}">
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container-fluid fourth-sec">
    <div class="container">
        <div class="row">
            <div class="col-md fourth-sec-col-1">
                {!! get_option_extra('t_left_content') !!}
            </div>
            <div class="col-md offset-1 fourth-sec-col-2">
                {!! get_option_extra('t_right_content') !!}
            </div>
        </div>
    </div>
</div>

<div class="container-fluid fifth-sec-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md offset-md-6">
                {!! get_option_extra('f_sec_content') !!}
                <a href="{{ route('frontend.show.page', base64_encode(get_option_extra('fourth_link'))) }}" class="btn-hover">RECRUIT WITH US</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row sixth-sec-row-1">
        <div class="col-md">
            <h2>Services we provide</h2>
        </div>
        <div class="col-md">
            {!! get_option_extra('service_content') !!}
        </div>
    </div>
</div>

<div class="container">
    <div class="row seventh-sec-row">
        @forelse($projects as $pr)
            <div class="col-md mb-3">
                <h5 class="">{{ $pr->title }}</h5>
                @forelse($pr->job as $job)                
                    <i aria-hidden="true" class="fas fa-circle mt-2 me-3 mb-3" style="color: #BAE9F2;font-size: 12px;"></i><span>{{ $job['title'] }}</span> <br>
                @empty
                @endforelse
            </div>
        @empty
        @endforelse
    </div>
    <div class="row mb-md-5 pb-md-5">
        <div class="col-md seventh-sec-row-1 mb-5">
            <a href="{{ route('frontend.jobs') }}">SEE MORE JOBS</a>
        </div>
    </div>
</div>


<div class="container-fluid eight-sec">
    <div class="row mb-5">
        <div class="col-md text-center">
            {!! get_option_extra('review_content') !!}
        </div>
    </div>
    <div class="row eight-sec-row">
        @forelse($reviews as $k => $post)            
            <div class="col-md eight-sec-col-{{ $k+1 }}">
                @for($i=0; $i<$post['rating']; $i++)
                    <i class="fa-solid fa-star mb-5"></i>
                @endfor
                {!! $post['full_content'] !!}
                <div class="row mt-5">
                    <div class="d-flex flex-row author-d align-items-center ">
                        <div>
                            @if(!empty($post['src_url']))
                                <img src="{{ asset('public') }}/{{ $post['src_url'] }}" class="">
                            @else
                                <img src="{{ asset('public/images/sorry-no-image.png') }}" class="" width="60">
                            @endif
                        </div>
                        <div class="ms-2">
                            <h4>{!! $post['post_title'] !!}</h4>
                            <p>{!! $post['short_content'] !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>


<div class="container-fluid ninth-sec">
    <div class="container">
        <div class="row ninth-sec-row align-items-center">
            <div class="col-md ninth-sec-col-1">
                {!! get_option_extra('bottom_content') !!}
                <a href="{{ route('frontend.show.page', base64_encode(get_option_extra('bottom_link'))) }}" class="btn-hover">GET STARTED</a>
            </div>
            <div class="col-md ninth-sec-col-2">                
                @if(!empty(get_option_extra('b_b_banner')))
                    <img src="{{ asset('public') }}/{{ get_option_extra('b_b_banner')}}">
                @endif
            </div>
        </div>
    </div>
</div>
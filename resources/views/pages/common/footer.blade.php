<div class="container-fluid" style="background-color: #f8f8f8;padding: 70px 0;">
    <div class="container">
        <div class="row mb-md-3 pb-md-0">
            <div class="col-md pos-tenth-col">
                <h4 class="mb-3">Subscribe to our newsletter</h4>
                <p class="mb-5">Enter your email address always to be updated. We promise not to spam!</p>
                <div class="pos-tenth-col-1">
                    <input type="email" placeholder="test@gmail.com" class="ninth-sec-ip">
                    <div class="email-box-svg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21.1875 3.1875H2.8125C1.26169 3.1875 0 4.44919 0 6V18C0 19.5508 1.26169 20.8125 2.8125 20.8125H21.1875C22.7383 20.8125 24 19.5508 24 18V6C24 4.44919 22.7383 3.1875 21.1875 3.1875ZM22.125 18C22.125 18.5169 21.7044 18.9375 21.1875 18.9375H2.8125C2.29556 18.9375 1.875 18.5169 1.875 18V6C1.875 5.48306 2.29556 5.0625 2.8125 5.0625H21.1875C21.7044 5.0625 22.125 5.48306 22.125 6V18Z"
                                fill="#FF7A57"></path>
                            <path
                                d="M21.9658 4.35645L11.9999 11.7691L2.03413 4.35645L0.915039 5.8609L11.9999 14.1059L23.0849 5.8609L21.9658 4.35645Z"
                                fill="#FF7A57"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-2" style="font-size: 14px;">By signing and clicking Submit, you affirm you have read and
                    agree to the <span class="term_cond"><a href="#">Terms of Use</a></span></p>
            </div>
            <div class="col-md-4 offset-md-2 me-4 tenth-sec-col-2">
                <div class="footer-logo">{!! get_site_title_logo() !!}</div>
                <p class="mt-5 mb-5">{!! get_option_extra('footer_content') !!}</p>
                <p>{!! get_option_extra('address') !!}</p>
            </div>
        </div>
        <div class="row tenth-sec-row-2 ms-4">
            <div class="col-md">
                <h5 class="">Company</h5>
                {!! get_footer_menu('footer-menu-1') !!}
            </div>
            <div class="col-md">
                <h5 class="">Social</h5>
                <a href="{!! get_option_extra('linkedin') !!}">Linkedin</a>
                <a href="{!! get_option_extra('twitter') !!}">Twitter</a>
                <a href="{!! get_option_extra('facebook') !!}">Facebook</a>
            </div>
            <div class="col-md">
                <h5 class="">Legal</h5>
                {!! get_footer_menu('footer-menu-2') !!}
            </div>
            <div class="col-md-4 offset-md-2 me-4 tenth-sec-row-2-col-4">
                <a href="tel:{!! get_option_extra('phone_number') !!}" class="ancher-num" style="font-size: 24px;font-weight: bold;fill: #000000;color: #000000;">
                    {!! get_option_extra('phone_number') !!}
                </a>
                <a href="mailto:{!! get_option_extra('email') !!}">{!! get_option_extra('email') !!}</a>
            </div>
        </div>
    </div>
</div>
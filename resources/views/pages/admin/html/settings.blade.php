<div class="card">
    <div class="card-header">
        <h4>Settings</h4>        
    </div>

    <div class="card-body">
        <form method="post" id="create-form" action="{{ route('admin.store.setting') }}" enctype="multipart/form-data">
            <div class="overview-card-body pricing-1">
                <div class="row aos-init aos-animate " data-aos="fade-left">
                    <div class="col-md-12">
                        <b>General Options</b>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="color-black">Site Title</h6>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="site_title" value="{{ get_option_extra('site_title') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="color-black">Site Logo</h6>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" name="site_logo">
                                    @if(!empty(get_option_extra('logo_path')))
                                        <img src="{{ asset('public') }}/{{ get_option_extra('logo_path')}}" class="img-thumbnail" width="80">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="color-black">Phone Number</h6>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="phone_number" value="{{ get_option_extra('phone_number') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="color-black">Email Address</h6>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="email" value="{{ get_option_extra('email') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="color-black">Address</h6>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="address" class="form-control">{{ get_option_extra('address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <b>Social Links</b>
                        <hr>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="color-black">Linkedin</h6>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="linkedin" value="{{ get_option_extra('linkedin') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="color-black">Twitter</h6>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="twitter" value="{{ get_option_extra('twitter') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="color-black">Facebook</h6>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="facebook" value="{{ get_option_extra('facebook') }}">
                                </div>
                            </div>
                        </div>

                        <b>Footer Area</b>
                        <hr>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="color-black">Footer Content</h6>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="footer_content" class="form-control">{{ get_option_extra('footer_content') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-2 p-0">
                            <div class="mt-3 text-left">
                                <button class="btn btn add-podcast-btn save-data" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
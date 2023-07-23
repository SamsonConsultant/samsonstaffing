<div class="card">
    <div class="card-header">
        <h4>Home Settings</h4>        
    </div>
</div>

<form method="post" id="create-form" action="{{ route('admin.store.setting') }}" enctype="multipart/form-data">
    <div class="overview-card-body pricing-1">
        <div class="aos-init aos-animate " data-aos="fade-left">
            <div class="row card mt-3">
                <div class="col-md-12 card-body">
                    <b>Top Section</b>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">Top Content</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control ckeditor" name="top_content" rows="3">{!! get_option_extra('top_content') !!}</textarea>
                            </div>
                            <div class="col-md-12 mt-4">
                                <select name="top_link" class="form-control">
                                    <option value="">-- Read More Link</option>
                                    @forelse($pages as $page)
                                        <option value="{{ $page['id'] }}" @if(get_option_extra('top_link') == $page['id']) selected @endif>{{ $page['post_title'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="color-black">Top Banner Image</h6>
                            </div>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="top_banner">
                                @if(!empty(get_option_extra('top_banner')))
                                    <img src="{{ asset('public') }}/{{ get_option_extra('top_banner')}}" class="img-thumbnail" width="100">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row card mt-3">
                <div class="col-md-12 card-body">
                    <b>First Section</b>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="color-black">Main Title</h6>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="f_main_title" value="{{ get_option_extra('f_main_title') }}">
                            </div>
                        </div>
                    </div>                        

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="color-black">Sub Title</h6>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="f_sub_title" value="{{ get_option_extra('f_sub_title') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">Project-Based Hiring</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea name="project_hire" class="form-control ckeditor" rows="3">{!! get_option_extra('project_hire') !!}</textarea>
                            </div>
                            <div class="col-md-12 mt-4">
                                <select name="project_link" class="form-control">
                                    <option value="">-- Read More Link</option>
                                    @forelse($pages as $page)
                                        <option value="{{ $page['id'] }}" @if(get_option_extra('project_link') == $page['id']) selected @endif>{{ $page['post_title'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">RPO Services</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea name="rpo_service" class="form-control ckeditor" rows="3">{!! get_option_extra('rpo_service') !!}</textarea>
                            </div>
                            <div class="col-md-12 mt-4">
                                <select name="rpo_link" class="form-control">
                                    <option value="">-- Read More Link</option>
                                    @forelse($pages as $page)
                                        <option value="{{ $page['id'] }}" @if(get_option_extra('rpo_link') == $page['id']) selected @endif>{{ $page['post_title'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">CV Formatting</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea name="cv_format" class="form-control ckeditor" rows="3">{!! get_option_extra('cv_format') !!}</textarea>
                            </div>
                            <div class="col-md-12 mt-4">
                                <select name="cv_link" class="form-control">
                                    <option value="">-- Read More Link</option>
                                    @forelse($pages as $page)
                                        <option value="{{ $page['id'] }}" @if(get_option_extra('cv_link') == $page['id']) selected @endif>{{ $page['post_title'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">Executive Search</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea name="ex_search" class="form-control ckeditor" rows="3">{!! get_option_extra('ex_search') !!}</textarea>
                            </div>
                            <div class="col-md-12 mt-4">
                                <select name="es_link" class="form-control">
                                    <option value="">-- Read More Link</option>
                                    @forelse($pages as $page)
                                        <option value="{{ $page['id'] }}" @if(get_option_extra('es_link') == $page['id']) selected @endif>{{ $page['post_title'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row card mt-3">
                <div class="col-md-12 card-body">
                    <b>Second Section</b>
                    <hr>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">Content</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea name="s_short_content" class="form-control ckeditor" rows="3">{!! get_option_extra('s_short_content') !!}</textarea>
                            </div>
                            <div class="col-md-12 mt-4">
                                <select name="second_link" class="form-control">
                                    <option value="">-- Read More Link</option>
                                    @forelse($pages as $page)
                                        <option value="{{ $page['id'] }}" @if(get_option_extra('second_link') == $page['id']) selected @endif>{{ $page['post_title'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="color-black">Image</h6>
                            </div>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="s_banner">
                                @if(!empty(get_option_extra('s_banner')))
                                    <img src="{{ asset('public') }}/{{ get_option_extra('s_banner')}}" class="img-thumbnail" width="80">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row card mt-3">
                <div class="col-md-12 card-body">
                    <b>Third Section</b>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">Left Content</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea name="t_left_content" class="form-control ckeditor" rows="3">{!! get_option_extra('t_left_content') !!}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">Right Content</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea name="t_right_content" class="form-control ckeditor" rows="3">{!! get_option_extra('t_right_content') !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row card mt-3">
                <div class="col-md-12 card-body">
                    <b>Fourth Section</b>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">Content</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea name="f_sec_content" class="form-control ckeditor" rows="3">{!! get_option_extra('f_sec_content') !!}</textarea>
                            </div>

                            <div class="col-md-12 mt-4">
                                <select name="fourth_link" class="form-control">
                                    <option value="">-- Read More Link</option>
                                    @forelse($pages as $page)
                                        <option value="{{ $page['id'] }}" @if(get_option_extra('fourth_link') == $page['id']) selected @endif>{{ $page['post_title'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="color-black">Bottom Banner Image</h6>
                            </div>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="f_b_banner">
                                @if(!empty(get_option_extra('f_b_banner')))
                                    <img src="{{ asset('public') }}/{{ get_option_extra('f_b_banner')}}" class="img-thumbnail" width="100">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row card mt-3">
                <div class="col-md-12 card-body">
                    <b>Bottom Section</b>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">Service Content</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea name="service_content" class="form-control ckeditor" rows="3">{!! get_option_extra('service_content') !!}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">Review Content</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea name="review_content" class="form-control ckeditor" rows="3">{!! get_option_extra('review_content') !!}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="color-black">Bottom Content</h6>
                            </div>
                            <div class="col-md-12">
                                <textarea name="bottom_content" class="form-control ckeditor" rows="3">{!! get_option_extra('bottom_content') !!}</textarea>
                            </div>
                            <div class="col-md-12 mt-4">
                                <select name="bottom_link" class="form-control">
                                    <option value="">-- Read More Link</option>
                                    @forelse($pages as $page)
                                        <option value="{{ $page['id'] }}" @if(get_option_extra('bottom_link') == $page['id']) selected @endif>{{ $page['post_title'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="color-black">Bottom Banner Image</h6>
                            </div>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="b_b_banner">
                                @if(!empty(get_option_extra('b_b_banner')))
                                    <img src="{{ asset('public') }}/{{ get_option_extra('b_b_banner')}}" class="img-thumbnail" width="100">
                                @endif
                            </div>
                        </div>
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
</form>
<div class="card">
    <div class="card-header">
        <h4>Menu Setting</h4>        
    </div>
</div>

<div class="overview-card-body pricing-1">
    <div class="aos-init aos-animate " data-aos="fade-left">
        <div class="row mt-3">
            <div class="col-md-12 card">
                <b>Menu List</b>
                <hr>
                @forelse($menus as $mn)
                    <div class="form-group card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="color-black">{{ $mn->menu_title }}</h6>                                
                            </div>
                            <div class="col-md-5">
                                @forelse($mn->navbars as $nav)
                                    <h6 class="color-black">{{ $nav->post->post_title ?? '' }}</h6>
                                @empty
                                @endforelse
                            </div>
                            <div class="col-md-1">
                                <a href="{{ route('admin.menu.edit', $mn->id) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('admin.menu.delete', $mn->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this.?')"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>

<form method="post" id="create-form" action="{{ route('admin.store.menu') }}" enctype="multipart/form-data">
    <div class="overview-card-body pricing-1">
        <div class="aos-init aos-animate " data-aos="fade-left">
            <div class="row card mt-3">
                <div class="col-md-12 card-body">
                    <b>Menu Creation</b>
                    <hr>
                    <div class="form-group">                        
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="color-black">Menu Type</h6>
                                <select class="form-control" name="menu_name">
                                    <option value="">-- Select Menu --</option>
                                    @forelse($menus as $mn)
                                        <option value="{{ $mn->id }}" {{ (!empty($menu) && $menu->id ? $menu->id : old('menu_name')) == $mn->id ? 'selected' : '' }}> {{ $mn->menu_title }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-8">
                                <h6 class="color-black">Select Page</h6>                                
                                <ul id="sortable">
                                    @forelse($pages as $page)
                                        @php
                                            $chk = '';
                                            if(!empty($menu) && in_array($page['id'], $menu->nav)){
                                                $chk = 'checked';
                                            }
                                        @endphp
                                        <li class="ui-state-default">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $page['id'] }}" value="{{ $page['id'] }}" name="page_id[]" {{ $chk }}>
                                                <label class="form-check-label" for="inlineCheckbox{{ $page['id'] }}">{{ $page['post_title'] }}</label>
                                            </div>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
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

<form method="post" id="create-form" action="{{ route('admin.store.sub.menu') }}" enctype="multipart/form-data">
    <div class="overview-card-body pricing-1">
        <div class="aos-init aos-animate " data-aos="fade-left">
            <div class="row card mt-3">
                <div class="col-md-12 card-body">
                    <b>Sub Menu Creation</b>
                    <hr>
                    <div class="form-group">                        
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="color-black">Sub Menu Type</h6>
                                <select class="form-control" name="sub_menu_name">
                                    <option value="">-- Select Menu --</option>
                                    @forelse($navbar as $page)
                                        <option value="{{ $page->route_id }}"> {{ $page->post->post_title }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-8">
                                <h6 class="color-black">Select Page</h6>                                
                                <ul id="sub-sortable">
                                    @forelse($pages as $page)
                                        @php
                                            $chk = '';
                                            if(!empty($menu) && in_array($page['id'], $menu->nav)){
                                                $chk = 'checked';
                                            }
                                        @endphp
                                        <li class="ui-state-default">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $page['id'] }}" value="{{ $page['id'] }}" name="page_id[]" {{ $chk }}>
                                                <label class="form-check-label" for="inlineCheckbox{{ $page['id'] }}">{{ $page['post_title'] }}</label>
                                            </div>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
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

@push('js')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#sortable" ).sortable();
        $( "#sub-sortable" ).sortable();
    });
</script>
@endpush
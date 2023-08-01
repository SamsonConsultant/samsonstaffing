<ul class="nav navbar-nav bg-gradient-primary sidebar sidebar-dark accordion mt-4" id="accordionSidebar" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item @if(Request::is('admin/dashboard')) active @endif">
        <a class="nav-link collapsed" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    {{-- <li class="nav-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
        <a href="{{ route('admin.permissions.index') }}" class="nav-link">
            <i class="fa-fw fas fa-unlock-alt nav-icon"></i>
            Permission
        </a>
    </li> --}}

    <li class="nav-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
        <a href="{{ route("admin.roles.index") }}" class="nav-link">
            <i class="fa-fw fas fa-briefcase nav-icon"></i>
            Roles
        </a>
    </li>
    
    <li class="nav-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
        <a href="{{ route("admin.users.index") }}" class="nav-link">
            <i class="fa-fw fas fa-user nav-icon"></i>
            Users
        </a>
    </li>

    {{-- <li class="nav-item {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
        <a href="{{ route("admin.categories.index") }}" class="nav-link">
            <i class="fa-fw fas fa-tags nav-icon"></i>
            Categories
        </a>
    </li> --}}

    <li class="nav-item {{ request()->is('admin/companies') || request()->is('admin/companies/*') ? 'active' : '' }}">
        <a href="{{ route("admin.companies.index") }}" class="nav-link">
            <i class="fa-fw fas fa-building nav-icon"></i>
            Account
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/contacts') || request()->is('admin/contacts/*') ? 'active' : '' }}">
        <a href="{{ route("admin.contacts.index") }}" class="nav-link">
            <i class="fa-fw fas fa-phone nav-icon"></i>
            Contacts
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/projects') || request()->is('admin/projects/*') ? 'active' : '' }}">
        <a href="{{ route("admin.projects.index") }}" class="nav-link">
            <i class="fa-fw fas fa-book nav-icon"></i>
            Projects
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/jobs') || request()->is('admin/jobs/*') ? 'active' : '' }}">
        <a href="{{ route("admin.jobs.index") }}" class="nav-link">
            <i class="fa-fw fas fa-briefcase nav-icon"></i>
            Jobs
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/search/cv') ? 'active' : '' }}">
        <a href="{{ route("admin.search.cv") }}" class="nav-link">
            <i class="fa-fw fas fa-search nav-icon"></i>
            Search CV
        </a>
    </li>

    <?php
        $jsh = $jcl = '';
        if(Request::is('admin/job/stage/one') || Request::is('admin/job/stage/two') || Request::is('admin/job/stage/three') || Request::is('admin/job/stage/four') || Request::is('admin/job/stage/five') || Request::is('admin/job/stage/six') || Request::is('admin/job/stage/seven') || Request::is('admin/job/stage/eight')){
            $jsh = 'show';
        }else{
            $jcl = 'collapsed';
        }    
    ?>

    <li class="nav-item">
        <a class="nav-link {{ $jcl }} text-truncate" href="#submenu1" data-toggle="collapse" data-target="#submenu">
            <i class="fa-fw fas fa-bars nav-icon"></i> <span class="d-none d-sm-inline">Job Management</span>
        </a>
        <div class="collapse {{ $jsh }}" id="submenu" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item {{ request()->is('admin/job/stage/one') ? 'active' : '' }}">
                    <a href="{{ route("admin.job.stage.one") }}" class="nav-link">
                        <i class="fa-fw fas fa-briefcase nav-icon"></i>
                        <span>Incoming CV</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/job/stage/two') ? 'active' : '' }}">
                    <a href="{{ route("admin.job.stage.two") }}" class="nav-link">
                        <i class="fa-fw fas fa-briefcase nav-icon"></i>
                        <span>Qualified CV</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/job/stage/three') ? 'active' : '' }}">
                    <a href="{{ route("admin.job.stage.three") }}" class="nav-link">
                        <i class="fa-fw fas fa-briefcase nav-icon"></i>
                        <span>Forwarded to Client</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/job/stage/four') ? 'active' : '' }}">
                    <a href="{{ route("admin.job.stage.four") }}" class="nav-link">
                        <i class="fa-fw fas fa-briefcase nav-icon"></i>
                        <span>Selected for Interview</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/job/stage/five') ? 'active' : '' }}">
                    <a href="{{ route("admin.job.stage.five") }}" class="nav-link">
                        <i class="fa-fw fas fa-briefcase nav-icon"></i>
                        <span>Disqualified CV</span>
                    </a>
                </li>
                <!-- <li class="nav-item {{ request()->is('admin/job/stage/six') ? 'active' : '' }}">
                    <a href="{{ route("admin.job.stage.six") }}" class="nav-link">
                        <i class="fa-fw fas fa-briefcase nav-icon"></i>
                        <span>Stage 6</span>
                    </a>
                </li> -->
                <li class="nav-item {{ request()->is('admin/job/stage/seven') ? 'active' : '' }}">
                    <a href="{{ route("admin.job.stage.seven") }}" class="nav-link">
                        <i class="fa-fw fas fa-briefcase nav-icon"></i>
                        <span>All CVs</span>
                    </a>
                </li>
                <!-- <li class="nav-item {{ request()->is('admin/job/stage/eight') ? 'active' : '' }}">
                    <a href="{{ route("admin.job.stage.eight") }}" class="nav-link">
                        <i class="fa-fw fas fa-briefcase nav-icon"></i>
                        <span>Stage 8</span>
                    </a>
                </li> -->
            </ul>
        </div>
    </li>

    {{-- <li class="nav-item {{ request()->is('admin/job-management') || request()->is('admin/job-management/*') ? 'active' : '' }}">
        <a href="{{ route("admin.job.manage") }}" class="nav-link">
            <i class="fa-fw fas fa-briefcase nav-icon"></i>
            Job Management
        </a>
    </li> --}}

    {{-- <li class="nav-item {{ request()->is('admin/manage-locations') || request()->is('admin/manage-locations/*') ? 'active' : '' }}">
        <a href="{{ route("admin.manage.locations") }}" class="nav-link">
            <i class="fa-fw fas fa-map-marker-alt nav-icon"></i>
            Locations
        </a>
    </li> --}}

    <li class="nav-item {{ request()->is('admin/page-lists') || request()->is('admin/page-create') ? 'active' : '' }}">
        <a href="{{ route("admin.pages") }}" class="nav-link">
            <i class="fa-fw fas fa-book nav-icon"></i>
            Pages
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/blogs') || request()->is('admin/blogs/*') ? 'active' : '' }}">
        <a href="{{ route("admin.blogs.index") }}" class="nav-link">
            <i class="fa-fw fas fa-solid fa-blog nav-icon"></i>
            Blogs
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/manage-review') || request()->is('admin/manage-review/*') ? 'active' : '' }}">
        <a href="{{ route("admin.manage.review") }}" class="nav-link">
            <i class="fa-fw fas fa-solid fa-comments nav-icon"></i>
            Reviews
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/contact-form') || request()->is('admin/contact-form/*') ? 'active' : '' }}">
        <a href="{{ route("admin.manage.contact.form") }}" class="nav-link">
            <i class="fa-fw fas fa-solid fa-address-book nav-icon" aria-hidden="true"></i> Contact Form
        </a>
    </li>

    <?php
        $sh = $cl = '';
        if(Request::is('admin/manage-experience') || Request::is('admin/manage-experience/*') || Request::is('admin/manage-roles') || Request::is('admin/manage-roles/*') || Request::is('admin/manage-candidate') || Request::is('admin/manage-candidate/*') || Request::is('admin/manage-education') || Request::is('admin/manage-education/*') || Request::is('admin/manage-industry') || Request::is('admin/manage-industry/*') || Request::is('admin/manage-area') || Request::is('admin/manage-area/*') || Request::is('admin/manage-employment') || Request::is('admin/manage-employment/*') || Request::is('admin/manage-category') || Request::is('admin/manage-category/*') || Request::is('admin/manage-skills') || Request::is('admin/manage-skills/*') || Request::is('admin/manage-account-type/*') || Request::is('admin/manage-account-type')){
            $sh = 'show';
        }else{
            $cl = 'collapsed';
        }    
    ?>
    <li class="nav-item">
        <a class="nav-link {{ $cl }} text-truncate" href="#submenu1" data-toggle="collapse" data-target="#submenu1">
            <i class="fa fa-database"></i> <span class="d-none d-sm-inline">Master Data</span>
        </a>
        <div class="collapse {{ $sh }}" id="submenu1" aria-expanded="false">
            <ul class="flex-column nav">
                {{-- <li class="nav-item @if(Request::is('admin/manage-experience') || Request::is('admin/manage-experience/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.manage.experience') }}">
                        <i class="fa fa-circle"></i>
                        <span>Experience</span>
                    </a>
                </li> --}}
                {{-- <li class="nav-item @if(Request::is('admin/manage-roles') || Request::is('admin/manage-roles/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.manage.roles') }}">
                        <i class="fa fa-circle"></i>
                        <span>Roles and Responsibilities</span>
                    </a>
                </li> --}}
                <li class="nav-item @if(Request::is('admin/manage-candidate') || Request::is('admin/manage-candidate/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.manage.candidate') }}">
                        <i class="fa fa-circle"></i>
                        <span>Desired Candidate</span>
                    </a>
                </li>
                <li class="nav-item @if(Request::is('admin/manage-education') || Request::is('admin/manage-education/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.manage.education') }}">
                        <i class="fa fa-circle"></i>
                        <span>Education Type</span>
                    </a>
                </li>
                <li class="nav-item @if(Request::is('admin/manage-industry') || Request::is('admin/manage-industry/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.manage.industry') }}">
                        <i class="fa fa-circle"></i>
                        <span>Industry Type</span>
                    </a>
                </li>
                <li class="nav-item @if(Request::is('admin/manage-area') || Request::is('admin/manage-area/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.manage.area') }}">
                        <i class="fa fa-circle"></i>
                        <span>Functional Area</span>
                    </a>
                </li>
                <li class="nav-item @if(Request::is('admin/manage-employment') || Request::is('admin/manage-employment/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.manage.employment') }}">
                        <i class="fa fa-circle"></i>
                        <span>Employment Type</span>
                    </a>
                </li>
                {{-- <li class="nav-item @if(Request::is('admin/manage-category') || Request::is('admin/manage-category/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.manage.category') }}">
                        <i class="fa fa-circle"></i>
                        <span>Role Category</span>
                    </a>
                </li> --}}
                <li class="nav-item @if(Request::is('admin/manage-skills') || Request::is('admin/manage-skills/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.manage.skills') }}">
                        <i class="fa fa-circle"></i>
                        <span>Key Skills</span>
                    </a>
                </li>

                <li class="nav-item @if(Request::is('admin/manage-account-type') || Request::is('admin/manage-account-type/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.manage.account.type') }}">
                        <i class="fa fa-circle"></i>
                        <span>Account Type</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link @if(Request::is('admin/home-setting') || Request::is('admin/settings'))  @else collapsed @endif text-truncate" href="#submenu2" data-toggle="collapse" data-target="#submenu2">
            <i class="fa fa-cog"></i> <span class="d-none d-sm-inline">Settings</span>
        </a>
        <div class="collapse @if(Request::is('admin/home-setting') || Request::is('admin/settings')) show @endif" id="submenu2" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item @if(Request::is('admin/home-setting')) active @endif">
                    <a class="nav-link" href="{{ route('admin.home.setting') }}">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                        <span>Home Page</span>
                    </a>
                </li>

                <li class="nav-item @if(Request::is('admin/settings')) active @endif">
                    <a class="nav-link" href="{{ route('admin.setting') }}">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        <span>General</span>
                    </a>
                </li>

                <li class="nav-item @if(Request::is('admin/menus')) active @endif">
                    <a class="nav-link" href="{{ route('admin.menus') }}">
                        <i class="fa fa-table" aria-hidden="true"></i>
                        <span>Menu</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>


<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"></ul>    
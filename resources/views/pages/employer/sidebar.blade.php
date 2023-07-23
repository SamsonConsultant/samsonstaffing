<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <h1 class="logo">
        <a href="{{ route('employer.dashboard') }}" class="brand-link text-center">
            <span class="brand-text">{{ employeeCompanyName(Auth::user()->email) }}</span>
        </a>
    </h1>    
    <!-- Sidebar -->
    <div class="sidebar">    
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">        
                <li class="nav-item">
                    <a href="{{ route('employer.dashboard') }}" class="nav-link @if(Request::is('employer/dashboard')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route("employer.companies.index") }}" class="nav-link {{ request()->is('employer/companies/index') || request()->is('employer/companies/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-building nav-icon"></i>
                        Account
                    </a>
                </li> --}}

                {{-- <li class="nav-item ">
                    <a href="{{ route("employer.contacts.index") }}" class="nav-link {{ request()->is('employer/contacts') || request()->is('employer/contacts/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-phone nav-icon"></i>
                        Contacts
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route("employer.projects.index") }}" class="nav-link {{ request()->is('employer/projects') || request()->is('employer/projects/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-book nav-icon"></i>
                        Projects
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("employer.jobs.index") }}" class="nav-link {{ request()->is('employer/jobs') || request()->is('employer/jobs/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase nav-icon"></i>
                        Jobs
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route("employer.job.manage") }}" class="nav-link {{ request()->is('employer/job-management') || request()->is('employer/job-management/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase nav-icon"></i>
                        Job Management
                    </a>
                </li> --}}

                <?php
                    $jsh = $jcl = '';
                    if(Request::is('employer/job/stage/two') || Request::is('employer/job/stage/three') || Request::is('employer/job/stage/four') || Request::is('employer/job/stage/seven')){
                        $jsh = 'show';
                    }else{
                        $jcl = 'collapsed';
                    }    
                ?>

                <li class="nav-item @if(!empty($jsh)) menu-open @endif">
                    <a class="nav-link {{ $jcl }} text-truncate" href="#submenu1" data-toggle="collapse" data-target="#submenu">
                        <i class="fa-fw fas fa-bars nav-icon"></i> <span class="d-none d-sm-inline">Job Management</span>
                    </a>
                    <div class="collapse {{ $jsh }}" id="submenu" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li class="nav-item">
                                <a href="{{ route("employer.job.stage.two") }}" class="nav-link {{ request()->is('employer/job/stage/two') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon"></i>
                                    <span>Qualified CV</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("employer.job.stage.three") }}" class="nav-link {{ request()->is('employer/job/stage/three') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon"></i>
                                    <span>Forwarded to Client</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route("employer.job.stage.four") }}" class="nav-link {{ request()->is('employer/job/stage/four') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon"></i>
                                    <span>Selected for Interview</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route("employer.job.stage.seven") }}" class="nav-link {{ request()->is('employer/job/stage/seven') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon"></i>
                                    <span>All CVs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
     </div>
  <!-- /.sidebar -->
</aside>
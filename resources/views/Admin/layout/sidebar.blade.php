<style>
    .active {
        color: #fff;
        background-color: #106770ad;
    }
</style>
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('storage/' . webConfig('logo')) }}" alt="Logo" alt="navbar brand" class="navbar-brand" height="60" width="90" />
            </a>

            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                @can('dashboard.view')
                  <li class="nav-item ">
                      <a href="{{ route('admin.index') }}" class="collapsed">
                          <i class="fas fa-home"></i>
                          <p>Dashboard</p>
                      </a>
                  </li>
                  @endcan
                   <li class="nav-section">
                  <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                  </span>
                    <h4 class="text-section">Management</h4>
                </li>
                @can('properties.view')
                  <li class="nav-item">
                    <a data-bs-toggle="collapse"
                      href="#property"
                      aria-expanded="{{ Request::routeIs('admin.properties.*')
                            || Request::routeIs('admin.property-types.*') ? 'true' : 'false' }}">

                        <i class="fas fa-building"></i>
                        <p>Property</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse {{ Request::routeIs('admin.properties.*')
                        || Request::routeIs('admin.property-types.*') ? 'show' : '' }}"
                        id="property">

                        <ul class="nav nav-collapse">
                            @can('property-types.view')
                            <li>
                                <a href="{{ route('admin.property-types.index') }}"
                                  class="{{ Request::routeIs('admin.property-types.*') ? 'active' : '' }}">
                                    <span class="sub-item">Property-Types</span>
                                </a>
                            </li>
                            @endcan
                            @can('properties.view')
                            <li>
                                <a href="{{ route('admin.properties.index') }}"
                                  class="{{ Request::routeIs('admin.properties.*') ? 'active' : '' }}">
                                    <span class="sub-item">Properties</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
             @endcan

             @can('leads.view')
             <li class="nav-item {{ Request::routeIs('admin.leads.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.leads.index') }}">
                        <i class="fas fa-user-tag"></i>
                        <p>Leads</p>
                    </a>
                </li>
             @endcan

             @can('property-visits.view')
             <li class="nav-item {{ Request::routeIs('admin.property-visits.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.property-visits.index') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Property Visits</p>
                    </a>
                </li>
             @endcan

             @can('bookings.view')
             <li class="nav-item {{ Request::routeIs('admin.bookings.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.bookings.index') }}">
                        <i class="fas fa-calendar-check"></i>
                        <p>bookings</p>
                    </a>
                </li>
             @endcan
             @can('owners.view')
             <li class="nav-item {{ Request::routeIs('admin.owner.list') ? 'active' : '' }}">
                    <a href="{{ route('admin.owner.list') }}">
                        <i class="fas fa-user-tie"></i>
                        <p>Owners</p>
                    </a>
                </li>
             @endcan
             @can('tenants.view')
             <li class="nav-item {{ Request::routeIs('admin.tenant.list') ? 'active' : '' }}">
                    <a href="{{ route('admin.tenant.list') }}">
                        <i class="fas fa-user-tie"></i>
                        <p>Tenants</p>
                    </a>
                </li>
             @endcan

              @can('agents.view')
                <li class="nav-item {{ Request::routeIs('admin.agent.list') ? 'active' : '' }}">
                    <a href="{{ route('admin.agent.list') }}">
                        <i class="fas fa-user-tie"></i>
                        <p>Agents</p>
                    </a>
                </li>
                @endcan
                @can('users.view')
                <li class="nav-item {{ Request::routeIs('admin.user.list') ? 'active' : '' }} {{ Request::routeIs('admin.user.create') ? 'active' : '' }}
                {{ Request::routeIs('admin.editUser') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.list') }}">
                        <i class="fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                @endcan

                @can('roles.view')
                    <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                        <h4 class="text-section">Roles & Permissions</h4>
                    </li>

                    <li class="nav-item {{ Request::routeIs('admin.roles.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fas fa-user-shield"></i>
                            <p>
                                Roles
                            </p>
                        </a>
                    </li>
                @endcan



                @can('configurations.view')
                 <li class="nav-section">
                  <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                  </span>
                    <h4 class="text-section">Configuration</h4>
                </li>
                 <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base" aria-expanded="{{ Request::routeIs('admin.webconfig.edit')
                         
                         || Request::routeIs('admin.web_config.about_section') ? 'true' : 'false' }}">
                        <i class="fas fa-cog"></i>
                        <p>Configuration</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('admin.webconfig.edit')
                      
                       || Request::routeIs('admin.web_config.about_section') ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.webconfig.edit') }}" class="{{ Request::routeIs('admin.webconfig.edit') ? 'active' : '' }}">
                                    <span class="sub-item">Web Configuration</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                @endcan


            </ul>
        </div>
    </div>
</div>

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
                  <li class="nav-item ">
                      <a href="{{ route('admin.index') }}" class="collapsed">
                          <i class="fas fa-home"></i>
                          <p>Dashboard</p>
                      </a>
                  </li>
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
                            <li>
                                <a href="{{ route('admin.property-types.index') }}"
                                  class="{{ Request::routeIs('admin.property-types.*') ? 'active' : '' }}">
                                    <span class="sub-item">Property-Types</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.properties.index') }}"
                                  class="{{ Request::routeIs('admin.properties.*') ? 'active' : '' }}">
                                    <span class="sub-item">Properties</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-section">
                  <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                  </span>
                    <h4 class="text-section">Components</h4>
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



                <li class="nav-item {{ Request::routeIs('admin.user.list') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.list') }}">
                        <i class="fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables" aria-expanded="{{ Request::routeIs('admin.transaction.list') ? 'true' : 'false' }}">
                        <i class="fas fa-money-bill"></i>
                        <p>Transactions</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('admin.transaction.list') ? 'show' : '' }}" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.transaction.list') }}" class="{{ Request::routeIs('admin.transaction.list') ? 'active' : '' }}">
                                    <span class="sub-item">Transaction List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>



            </ul>
        </div>
    </div>
</div>
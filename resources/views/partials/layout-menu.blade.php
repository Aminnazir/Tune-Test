<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{url('/')}}" class="app-brand-link">
      <span class="app-brand-logo demo w-100">
      <img src="{{url('/')}}/assets/img/manage.jpg" class="img-fluid">
      </span>
          </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ (request()->is('/*')) ? 'active open' : '' }} ">
            <a href="{{route('home')}}" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboards</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('categories*')) ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Categories</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('categories')) ? 'active' : '' }}">
                    <a href="{{route('categories.index')}}" class="menu-link" >
                        <div>All Categories</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ (request()->is('importer*')) ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Imports</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('importer')) ? 'active' : '' }}">
                    <a href="{{route('importer.index')}}" class="menu-link" >
                        <div>All Imports</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</aside>

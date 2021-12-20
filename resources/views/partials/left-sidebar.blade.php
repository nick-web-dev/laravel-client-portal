<!--
    Sidebar Mini Mode - Display Helper classes

    Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
    Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
        If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

    Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
    Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
    Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
-->

<nav id="sidebar" aria-label="Main Navigation" style="z-index: 20; display: flex; flex-direction: column;">
    <!-- Side Navigation -->
    <div class="content-side pl-0 pr-0 pb-0" style="padding-top: 64px; flex-shrink: 1;">
        <ul class="nav-main mb-0">
            <li class="nav-main-item">
                <a class="nav-main-link {{ Route::is('orders') ? 'active' : '' }}" href="{{ route('orders') }}">
                    {{-- <i class="nav-main-link-icon far fa-fw fa-square"></i> --}}
                    <x-icons.Orders />
                    <span class="nav-main-link-name">Orders</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{ Route::is('returns') ? 'active' : '' }}" href="{{ route('returns') }}">
                    <x-icons.Returns />
                    <span class="nav-main-link-name">Returns</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{ Route::is('asn-inventory') ? 'active' : '' }}" href="{{ route('asn-inventory') }}">
                    <x-icons.Inventory />
                    <span class="nav-main-link-name">ASNs & Inventory</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{ Route::is('reports*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                    <x-icons.Reports />
                    <span class="nav-main-link-name">Reports</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END Side Navigation -->

    {{-- @permissions_any(['orders', 'returns', 'reports']) --}}
    <div class="content-side flex-grow-1 p-0" style="flex-grow: 1;">
        {{-- <ul class="nav-main mb-0">
            @permission('orders')
            <li class="nav-main-item">
                <a class="nav-main-link m-0 d-inline-block text-center" href="">
                    <i class="nav-main-link-icon si si-bag"></i>
                    <span class="nav-main-link-name">Orders</span>
                </a>
            </li>
            @endpermission
            @permission('returns')
            <li class="nav-main-item">
                <a class="nav-main-link m-0 d-inline-block text-center" href="">
                    <i class="nav-main-link-icon fa fa-file-invoice"></i>
                    <span class="nav-main-link-name">Returns</span>
                </a>
            </li>
            @endpermission
            @permission('reports')
            <li class="nav-main-item">
                <a class="nav-main-link m-0 d-inline-block text-center" href="">
                    <i class="nav-main-link-icon fa fa-file-alt"></i>
                    <span class="nav-main-link-name">Reports</span>
                </a>
            </li>
            @endpermission
        </ul> --}}
    </div>
    {{-- @endpermissions_any --}}

    <div class="content-side p-0 border-top" style="background-color: #8c8c8c;">
        <ul class="nav-main mb-0">
            <li class="nav-main-item">
                <a class="nav-main-link" href="javascript:void(0)" data-toggle="layout" data-action="sidebar_mini_toggle">
                    <x-icons.Expand />
                    <x-icons.Collapse />
                    <span class="nav-main-link-name">Toggle Sidebar</span>
                </a>
            </li>
        </ul>
    </div>

</nav>

@php
    $menus = json_decode(file_get_contents(resource_path('data/sidebar/menu.json')), true);
@endphp

<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            {{-- <img src="{{ asset('assets/images/logo-icon-2.png') }}" class="logo-icon" alt="logo icon"> --}}
            <ion-icon name="happy-outline" size="large"></ion-icon>
        </div>
        <div>
            <h4 class="logo-text">PRODIGY</h4>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">


        @foreach ($menus as $menu)
            <li class="">
                <a href="{{ Route::has($menu['slug']) ? route($menu['slug']) : 'javascript:void(0)'}}"
                    class="{{ isset($menu['submenu']) ? 'has-arrow' : ''}}" >
                    <div class="parent-icon">
                        <ion-icon name="{{ isset($menu['icon']) ?? true ? $menu['icon'] : ''}}"></ion-icon>
                    </div>
                    <div class="menu-title">{{ isset($menu['name']) ?? true ? $menu['name'] : '' }}</div>
                </a>

                @if (isset($menu['submenu']))
                    <ul>
                        @foreach ($menu['submenu'] as $child)
                            <li><a
                                    href="{{ Route::has($child['slug']) ? route($child['slug']) : 'javascript:void(0)' }}">
                                    <ion-icon name="ellipse-outline"></ion-icon>{{ $child['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach

        {{-- <li class="{{ Route::current()->getName() == 'dashboard' ? 'mm-active' : '' }}">
            <a href="{{ Route::current()->getName() == 'dashboard' ? 'javascript:void(0)' :gyrdfuuycy route('dashboard') }}">
                <div class="parent-icon">
                    <ion-icon name="home-outline"></ion-icon>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="shield-half-outline"></ion-icon>
                </div>
                <div class="menu-title">Role & Permissions</div>
            </a>
            <ul>
                <li><a href="{{ route('roles.index') }}">
                        <ion-icon name="ellipse-outline"></ion-icon>Roles
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-label">UI Elements</li> --}}
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->

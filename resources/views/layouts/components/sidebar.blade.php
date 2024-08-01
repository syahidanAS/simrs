<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('home') }}" class="brand-link">
            <span class="brand-text fw-light">SIMRS ARZ</span></a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Menu Super Admin</li>
                @php
                $menus = \App\Helpers\Main::getMenus();
                @endphp
                @foreach($menus as $parent)
                @can('Show '.$parent->name)
                <li class="nav-item">
                    <a href="{{ $parent->url }}" class="nav-link">
                        <i class="nav-icon">
                            {!! $parent->icon !!}
                        </i>
                        <p>
                            {{ $parent->name }}
                            @if(count($parent->children) > 0)
                            <i class="nav-arrow bi bi-chevron-right"></i>
                            @endif

                        </p>
                    </a>
                    @if($parent->children)
                    <ul class="nav nav-treeview">
                        @foreach($parent->children as $child)
                        @can('Show '.$child->name)
                        <li class="nav-item"> <a href="{{ $child->url }}" class="nav-link">
                                <i class="nav-icon">
                                    {!! $child->icon !!}
                                </i>
                                <p>
                                    {{ $child->name }}
                                    @if(count($child->children) > 0)
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                    @endif
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach($child->children as $children)
                                @can('Show '.$children->name)
                                <li class="nav-item"> <a href="{{ $children->url }}" class="nav-link"> <i
                                            class="nav-icon"> {!! $children->icon !!}</i>
                                        <p>{{ $children->name }}</p>
                                    </a> </li>
                                @endcan
                                @endforeach
                            </ul>
                        </li>
                        @endcan
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endcan
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
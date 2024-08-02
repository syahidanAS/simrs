<!--**********************************
            Sidebar start
        ***********************************-->
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            @php
            $menus = \App\Helpers\Main::getMenus();
            @endphp
            @foreach($menus as $parent)
            <li><a class="{{ (count($parent->children) > 0) ? 'has-arrow' : '' }}" href="{{ $parent->url }}">
                    {!!$parent->icon!!}
                    <span class="nav-text">{{ $parent->name }}</span>
                </a>
                @if($parent->children)
                <ul>
                    @foreach($parent->children as $child)
                    @if(count($child->children) > 0)
                    <li>
                        <a class="{{ (count($child->children) > 0) ? 'has-arrow' : '' }}" href="{{ $child->url }}">{{
                            $child->name }}</a>
                        <ul>
                            @foreach($child->children as $children)
                            <li><a href="{{ $children->url }}">{{ $children->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li><a href="{{ $child->url }}">{{ $child->name }}</a></li>
                    @endif
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>

    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->
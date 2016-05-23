<nav class="navbar navbar-stacked" id="sidebar-wrapper" role="navigation">
    <ul class="nav sidebar-nav">
        <li>
            <a href="{!!route('larapress.dashboard')!!}">Dashboard</a>
        </li>
        <li>
            <a v-on:click="requestMediaManager" href="#">Media Manager</a>
        </li>

        @foreach($menu as $item)

        @if(count($item['sub_menu']) == 0)

        <li>
            <a href="{!!$item['route']!!}">{!!$item['display']!!}</a>
        </li>

        @else

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{!!$item['display']!!} <span
                    class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li class="dropdown-header">Dropdown heading</li>
                @foreach($item['sub_menu'] as $subItem)
                <li><a href="{!!route($subItem['route'])!!}">{!!$subItem['display']!!}</a></li>
                @endforeach
            </ul>
        </li>

        @endif

        @endforeach

    </ul>
</nav>
<!-- /#sidebar-wrapper -->

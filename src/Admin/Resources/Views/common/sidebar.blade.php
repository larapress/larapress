<aside class="main-sidebar">
    <!-- Inner sidebar -->
    <div class="sidebar">
        <!-- user panel (Optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/larapress/images/user.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php if(\Auth::check()) echo \Auth::user()->name ?></p>
            </div>
        </div>
        <!-- /.user-panel -->


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li>
                <a href="{!!route('larapress.dashboard')!!}">Dashboard</a>
            </li>

            <li>
                <a v-on:click="requestMediaManager" href="#">Media Manager</a>
            </li>

            @foreach($menu as $item)

                @if(count($item['sub_menu']) == 0)

                    <li>
                        <a href="{!! route($item['route'], isset($item['route_data']) ? $item['route_data'] : []) !!}">{!!$item['display']!!}</a>
                    </li>

                @else

                    <li class="treeview">
                        <a href="#">
                            <span>{!!$item['display']!!}</span>
                            <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            @foreach($item['sub_menu'] as $subItem)
                                <li><a href="{!! route($subItem['route'], isset($subItem['route_data']) ? $subItem['route_data'] : []) !!}">{!!$subItem['display']!!}</a></li>
                            @endforeach
                        </ul>
                    </li>

                @endif

            @endforeach

        </ul>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside><!-- /.main-sidebar -->



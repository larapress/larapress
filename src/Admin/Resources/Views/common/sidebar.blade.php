<aside class="main-sidebar">
    <!-- Inner sidebar -->
    <div class="sidebar">
        <!-- user panel (Optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>User Name</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div><!-- /.user-panel -->


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
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

                    <li class="treeview">
                        <a href="#">
                            <span>{!!$item['display']!!}</span>
                            <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            @foreach($item['sub_menu'] as $subItem)
                                <li><a href="{!!route($subItem['route'])!!}">{!!$subItem['display']!!}</a></li>
                            @endforeach
                        </ul>
                    </li>

                @endif

            @endforeach

        </ul><!-- /.sidebar-menu -->

    </div><!-- /.sidebar -->
</aside><!-- /.main-sidebar -->



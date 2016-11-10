<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/img/huawei.jpg") }}" class="img-box" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a><i class="fa fa-circle text-success"></i>{{ Auth::user()->role }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- <li class="header">HEADER</li> -->
            <!-- Optionally, you can add icons to the links -->            
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-home"></i><span>Home</span>
                </a>
            </li>
            @if(Auth::user()->admin())
            <li>
                <a href="{{ url('user') }}">
                    <i class="fa fa-user"></i><span>User</span>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ url('remark') }}">
                    <i class="fa fa-pencil"></i><span>Remark</span>
                </a>
            </li>
            <li>
                <a href="{{ url('site') }}">
                    <i class="fa fa-globe"></i><span>Site</span>
                </a>
            </li>
            <li>
                <a href="{{ url('antena') }}">
                    <i class="fa fa-signal"></i><span>Antena</span>
                </a>
            </li>
            <li>
                <a href="{{ url('completesite') }}">
                    <i class="fa fa-calendar"></i><span>Site Data</span>
                </a>
            </li>
            {{--Tidak Kepakai
            <li class="treeview">
                <a href="#"><span>Import File</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Remark</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>--}}
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

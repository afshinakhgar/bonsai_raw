<header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>dmin</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Bonsai</b>Panel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope"></i>
                        {{--<span class="label label-success">4</span>--}}
                    </a>

                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{--<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">--}}
                        <span class="hidden-xs">
                            {{\Kernel\Facades\Auth::user()->first_name}} {{\Kernel\Facades\Auth::user()->last_name}}
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @include('admin.includes.widgets.profile_photo',['type'=>'user_photo','user'=>\Kernel\Facades\Auth::user(),'class'=>'img-circle','size'=>'thumb'])

                            <p>
                                {{\Kernel\Facades\Auth::user()->first_name}} {{\Kernel\Facades\Auth::user()->last_name}}

                                <small> </small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-left">
                                <a href="{{route('auth.logout')}}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
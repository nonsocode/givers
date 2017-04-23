<div class="page-header-top">
    <div class="container">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.html">
                <h3>IndexBase Hub</h3>
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler"></a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <li class="dropdown dropdown-extended dropdown-notification " id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i>
                        <span class="badge badge-default">7</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3>You have
                            <strong>12 pending</strong> tasks</h3>
                            <a href="app_todo.html">view all</a>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">just now</span>
                                        <span class="details">
                                            <span class="label label-sm label-icon label-success">
                                                <i class="fa fa-plus"></i>
                                            </span> New user registered. </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <li class="dropdown dropdown-separator">
                        <span class="separator"></span>
                    </li>
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown-user ">
                        <a href="{{ route(config('routes.prefix').'profile.index') }}" style="overflow: hidden;padding: 12px 7px 7px;" class="dropdown-toggle" >
                            <img alt="" class="img-circle" src="{{ asset('img/avatar.png') }}">
                            <span class="username username-hide-mobile">{{\Auth::user()->first_name." ".\Auth::user()->last_name[0]."."}}</span>
                        </a>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <li>
                            <a href="#" id="logout-button">
                                <i class="icon-logout"></i> <span>Logout</span>
                            </a>
                        <form class="hidden" id="logout-form" method="post" action="{{ route('logout') }}">{{csrf_field()}}
                        </form>
                    </li>
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $('#logout-button').click(function (e) {
                e.preventDefault();
                $('#logout-form').submit();
            })
        </script>
    @endpush
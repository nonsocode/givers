<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Main Navigation</li>
            <li class="active">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="">
                <a href="referrals">
                    <i class="fa fa-files-o"></i>
                    <span>Referals</span>
                </a>
            </li>
            <li>
                <a href="bonuses">
                    <i class="fa fa-th"></i>
                    <span>Bonuses</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Charts</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Transactions</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
          </li>
            <li>
                <a href="{{ route('profile') }}">
                    <i class="fa fa-edit"></i>
                    <span>Profile</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('tickets') }}">
                    <i class="fa fa-table"></i> 
                    <span>Support Tickets</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
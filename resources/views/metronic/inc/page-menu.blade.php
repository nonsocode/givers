<div class="page-header-menu page-header-menu-light">
    <div class="container">
        <!-- BEGIN MEGA MENU -->
        <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
        <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
        <div class="hor-menu ">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route(config('routes.prefix').'dashboard') }}"> Dashboard
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;"> Earnings
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route(config('routes.prefix').'bonuses.index') }}"> Bonuses
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route(config('routes.prefix').'referrals.index') }}"> Refferals
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route(config('routes.prefix').'tickets.index') }}"> Support Tickets
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;"> News
                        <span class="arrow"></span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END MEGA MENU -->
    </div>
</div>
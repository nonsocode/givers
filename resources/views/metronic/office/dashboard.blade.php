@extends(config('view.dashboard').'layouts.app')

@section('page-head')
	@component(config('view.dashboard').'comps.page-head')
	Dashboard
	@endcomponent
@stop

@section('content')
<div class="container">
    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="row widget-row">
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Current Balance</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green icon-bulb"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">USD</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="7,644">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Weekly Sales</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-red icon-layers"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">USD</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="1,293">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Biggest Purchase</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">USD</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="815">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Average Monthly</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">USD</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="5,071">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="mt-widget-3">
                    <div class="mt-head bg-blue-hoki pointer">
                        <div class="mt-head-icon">
                            <i class=" icon-social-twitter"></i>
                        </div>
                        <div class="mt-head-desc"><h2>Provide Help</h2> </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-widget-3">
                    <div class="mt-head bg-red">
                        <div class="mt-head-icon">
                            <i class="icon-link"></i>
                        </div>
                        <div class="mt-head-desc"><h2>Show Referral Link</h2> </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-widget-3 pointer" id="divClaimDream">
                    <div class="mt-head bg-green">
                        <div class="mt-head-icon">
                            <i class=" icon-graduation"></i>
                        </div>
                        <div class="mt-head-desc"><h2>Claim A Dream</h2></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
</div>
@stop
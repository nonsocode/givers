<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>{{config('app.name')}}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet" type="text/css" href="">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('assets/layouts/layout3/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/layouts/layout3/css/themes/default.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('assets/layouts/layout3/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{mix('css/custom.css')}}">
        @yield('css')
       <style type="text/css">
            @stack('css')
       </style>

        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
        <!-- BEGIN HEADER -->
        <div class="page-header">
            <!-- BEGIN HEADER TOP -->
            @include(config('view.dashboard').'inc.page-header-top')
            <!-- END HEADER TOP -->

            <!-- BEGIN HEADER MENU -->
            @include(config('view.dashboard').'inc.page-menu')
            <!-- END HEADER MENU -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                @yield('page-head')
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    @yield('content')
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <!-- BEGIN PRE-FOOTER -->
        <div class="page-prefooter">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                        <h2>About</h2>
                        <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam dolore. </p>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs12 footer-block">
                        <h2>Subscribe Email</h2>
                        <div class="subscribe-form">
                            <form action="javascript:;">
                                <div class="input-group">
                                    <input type="text" placeholder="mail@email.com" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn" type="submit">Submit</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                        <h2>Follow Us On</h2>
                        <ul class="social-icons">
                            <li>
                                <a href="javascript:;" data-original-title="rss" class="rss"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="facebook" class="facebook"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="twitter" class="twitter"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="googleplus" class="googleplus"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="linkedin" class="linkedin"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="youtube" class="youtube"></a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="vimeo" class="vimeo"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                        <h2>Contacts</h2>
                        <address class="margin-bottom-40"> Phone: 800 123 3456
                            <br> Email:
                            <a href="mailto:info@metronic.com">info@metronic.com</a>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PRE-FOOTER -->
        <!-- BEGIN INNER FOOTER -->
        <div class="page-footer">
            <div class="container"> 2014 &copy; Metronic by keenthemes.
                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
            </div>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
        <!-- END INNER FOOTER -->
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="{{ asset('assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/excanvas.min.js') }}"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        @stack('scripts')
        {{-- <script src="{{ asset('assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script> --}}
        @yield('page-script')
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{ asset('assets/layouts/layout3/scripts/layout.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/layouts/layout3/scripts/demo.min.js') }}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>
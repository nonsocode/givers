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
                    <h4 class="widget-thumb-heading">Amount Given</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green icon-bulb"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">NGN</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{number_format($user->phs->sum('amount'),2)}}">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Amount Collected</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-red icon-layers"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">NGN</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="1,293">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Credibility Score</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">PERCENT</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{\Auth::user()->cred_score}}">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">AVAILABLE FUNDS</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">NGN</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="5,071">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mt-widget-3 help-button" data-url="{{route('provide-help.create')}}">
                    <div class="mt-head bg-blue-hoki">
                        <div class="mt-head-icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="mt-head-desc"><h2>Provide Help</h2> </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-widget-3 help-button golden-rod" data-url="{{route('get-help.create')}}">
                    <div class="mt-head bg-green">
                        <div class="mt-head-icon">
                            <i class="fa fa-bank"></i>
                        </div>
                        <div class="mt-head-desc"><h2>Get Help</h2></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <div class="caption-subject bold">Transactions</div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        @foreach ($transactions as $trans)
                                @include(config('view.dashboard').'inc.pairing')
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <div class="caption-subject bold">Recent Activiy</div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="helps-container">
                            @foreach ($helps as $help)
                                @include(config('view.dashboard').'inc.help-card', ['help' => $help])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
</div>
@stop
@section('page-script')
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var helpDelOpt = {
            onConfirm : function(e){
                console.log(this);
            },
        };
        $('.help-button').click(function(event) {
            event.preventDefault();
            window.location.href = $(this).data('url');
        });
        $('.delete-help').confirmation(helpDelOpt);
        function updateExpiry(){
            $('.expiry').text(function(){
                return moment($(this).attr('datetime')).fromNow();
            });
        }
        var exp = setInterval(updateExpiry,1000);
    });
</script>
@stop
@push('scripts')
<script src="{{ asset('assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js')}}" ></script>
<script src="{{ asset('js/countdown.min.js') }}"></script>
@endpush
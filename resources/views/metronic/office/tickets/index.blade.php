@extends(config('view.dashboard').'layouts.app')
@section('content')
<div class="container">
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route(config('routes.prefix').'tickets.create') }}" class="btn btn-primary btn-block margin-bottom"><i  class="fa fa-plus"></i> Create New Ticket</a>
                <div class="portlet light">
                    <div >
                        <h4 class="portlet-title">
                            <div class="caption font-dark"><span class="caption-subject bold">Filter Tickets</span></div>
                        </h4>
                    </div>
                    <div class="portlet-body">
                        <ul class="nav filter nav-pills nav-stacked">
                            <li class="active">
                                <a href="#">
                                    <i class="fa fa-envelope-o"></i>All
                                    <span class="label label-default pull-right">{{$tickets->count()}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-inbox"></i>Open
                                    <span class="label label-success pull-right">{{$tickets->where('status',0)->count()}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-inbox"></i>In-Progress
                                    <span class="label label-warning pull-right">{{$tickets->where('status',1)->count()}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-inbox"></i>Closed
                                    <span class="label label-dark pull-right">{{$tickets->where('status',2)->count()}}</span>
                                </a>
                            </li>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="portlet light">
                        <div class="box-header with-border">
                            <h3 class="portlet-title">Support Tickets</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="portlet-body">
                            <table id="ticketsTable" class="table table-striped table-bordered table-hover spacious">
                                <thead>
                                    <tr align="left">
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Last Updated</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tickets as $ticket)
                                    <tr align="left" class="clickable-row" data-href="{{ route(config('routes.prefix').'ticket.view',[$ticket->id]) }}">
                                        <td><strong>{{$ticket->tid}}</strong></td>
                                        <td>{{$ticket->category->name}}</td>
                                        <td>{{$ticket->title}}</td>
                                        <td>
                                            <span class="label label-{{$ticket->status_text}}">
                                                {{$ticket->status_text}}
                                            </span>
                                        </td>
                                        <td>{{$ticket->updated_at->toFormattedDateString()}}</td>
                                        <td>{{$ticket->created_at->toFormattedDateString()}}</td>
                                    </tr>
                                    @empty
                                    {{-- empty expr --}}
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
    @stop

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    @stop

    @push('scripts')
        <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    @endpush

    @section('page-script')
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
           $('#ticketsTable').dataTable({});
        });
    </script>

    @stop
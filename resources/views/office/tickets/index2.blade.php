@extends('layouts.app') @section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <a href="compose.html" class="btn btn-primary btn-block margin-bottom"><i  class="fa fa-plus"></i> Create New Ticket</a>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter Tickets</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Support Tickets</h3>
                </div>
                <!-- /.box-header -->
                <div class="bax-body">
                	<table id="ticketsTable" class="table table-hover">
                		<thead>
                			<tr align="center">
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
                			<tr align="center" class="clickable-row" data-href="{{ route('ticket.view',[$ticket->id]) }}">
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
@stop

@section('mainScript')
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		    $(".clickable-row").click(function() {
		        window.location = $(this).data("href");
		    });
		   $('#ticketsTable').DataTable({
		      "paging": true,
		      "lengthChange": false,
		      "searching": true,
		      "ordering": true,
		      "info": true,
		      "autoWidth": false
		    });
		});
	</script>
@stop

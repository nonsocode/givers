@extends(config('view.dashboard').'layouts.app')

@section('content')
<div class="content container">
	<div class="row">
		<div class="col-xs-12">
			<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<div class="caption-subject bold">Bonuses</div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-container" style="overflow-x:scroll;width:100%">
					<table id="bonuses-table" class="table">
						<thead>
							<tr>
								<th>Type</th>
								<th>Status</th>
								<th>Amount</th>
								<th>Date Created</th>
								<th>Release Date</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
						@foreach($bonuses as $bonus)
							<tr>
								<td></td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('page-script')
<script type="text/javascript">
    jQuery(document).ready(function($) {
       $('#bonuses-table').dataTable();
    });
</script>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@stop

@push('scripts')
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
@endpush

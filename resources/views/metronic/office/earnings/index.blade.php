@extends(config('view.dashboard').'layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title"></div>
					<div class="portlet-body">
						<div class="table-container" style="overflow-x: scroll;width: 100%;">
							<table id="earnings-table" class="table table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Initial Amount</th>
										<th>Current Worth</th>
										<th>Amount Claimed</th>
										<th>Amount Available</th>
										<th>Release Date Amount</th>
										<th>Status</th>
										<th>Release Date</th>
										<th>Created</th>
										<th>Expires</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($earnings as $en)
									<tr>
										<td>{{$en->did}}</td>
										<td>{{$en->prettyInitialAmount}}</td>
										<td>{{$en->prettyCurrentAmount}}</td>
										<td>{{$en->prettyClaimedAmount}}</td>
										<td>{{$en->prettyAvailableAmount}}</td>
										<td>{{$en->prettyReleasedateAmount}}</td>
										<td>{{$en->status}}</td>
										<td>{{$en->releasable->toDateString()}}</td>
										<td>{{$en->created_at->toDateString()}}</td>
										<td>{{$en->expiry->toDateString()}}</td>
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
		$('#earnings-table').dataTable();
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

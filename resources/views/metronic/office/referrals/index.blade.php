@extends(config('view.dashboard').'layouts.app')

@section('content')
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption font-dark">
							<div class="caption-title bold">
								Referrals
							</div>
						</div>
						<div class="actions"><button class="btn btn-primary">Show referral link</button></div>
					</div>
					<div class="portlet-body">
						<table id="referrals-table" class="table table-hover">
							<thead>
								<th>ID</th>
								<th>Full Name</th>
								<th>Email</th>
								<th>Phone Number</th>
								<th>Status</th>
								<th>Joined on</th>
							</thead>
							<tbody>
							@foreach ($children as $child)
								<tr>
									<td>{{$child->did}}</td>
									<td>{{$child->name}}</td>
									<td>{{$child->email}}</td>
									<td>{{$child->primaryPhone->number}}</td>
									<td>{{$child->statusText}}</td>
									<td>{{$child->created_at->toFormattedDateString()}}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('page-script')
<script type="text/javascript">
    jQuery(document).ready(function($) {
       $('#referrals-table').dataTable({});
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

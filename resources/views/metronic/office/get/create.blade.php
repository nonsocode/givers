@extends(config('view.dashboard').'layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-tiltle"><div class="caption">
						<div class="caption-subject bold">Create Get Help Request</div>
					</div></div>
					<div class="portlet-body"></div>
				</div>
			</div>
		</div>
	</div>
@stop

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/global/plugins/nouislider/nouislider.min.js') }}"></script>
@endpush
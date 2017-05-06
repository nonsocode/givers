@extends(config('view.dashboard').'layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-tiltle"><div class="caption">
						<div class="caption-subject bold">Create Get Help Request</div>
					</div></div>
					<div class="portlet-body">
						@forelse ($cashables as $cashable)
							{{-- expr --}}
						@empty
							<div class="well well-lg">
								<p>You do not have any funds available for withdrawal yet.</p>
								<p>View your <a href="{{ route(config('view.dashboard').'earnings.index') }}">Earnings</a> page to see when your next earning will be available or <a href="{{ route('provide-help.create') }}">Provide help</a> to create Earnings</p>
							</div>
						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/global/plugins/nouislider/nouislider.min.js') }}"></script>
@endpush
@extends(config('view.dashboard').'layouts.app')

@section('page-head')
	@component(config('view.dashboard').'comps.page-head')
	Provide Help
	@slot('sub')
	Help Someone
	@endslot
	@endcomponent
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<div class="caption-subject bold">New Provide Help Request</div>
						</div>
					</div>
					<div class="portlet-body">
					<div class="row">
						<div class="col-md-6">
							<p>Enter the amount of money you wish to give. Note that the amount must be a multiple of 1000. You cannot provide help of an ammount less than your last PH. If you have'nt provided help before, the least amount you can provide is ₦ 5,000</p>
							<form action="{{ route('provide-help.store') }}" method="POST" role="form">
								@include(config('view.dashboard').'inc.errors')
								@include('partials.alert')
								{{csrf_field()}}							
								<div class="form-group">
									<label for="">Amount</label>
									<div class="input-group">
										<span class="input-group-addon">NGN</span>
										<input type="number" name='amount' value="{{old('amount')}}" step="1000" min="{{$min}}" class="form-control" id="" placeholder="Input field">
									</div>
								</div>
		                        <div class="form-group text-center">
		                            <div class="g-recaptcha" style="display:inline-block;" data-sitekey="{{env('GOOGLE_CAPTCHA_CLIENT')}}"></div>
		                            @if ($errors->has('cpatcha'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('captcha') }}</strong>
		                                </span>
		                            @endif
		                        </div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

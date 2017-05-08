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
							<form action="{{ route('get-help') }}" method="POST" class="get-help-form">
							{{csrf_field()}}
								<div class="row mb-20">
									<div class="col-md-4 text-right">Select Bank Account</div>
									<div class="col-md-8">
										<select name="bank_account" class="form-control" id="">
											@foreach ($bankAccounts as $account)
												<option value="{{$account->id}}">{{$account->number}} ({{$account->bank->name}})</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 text-right">Select Earnings</div>
									<div class="col-md-8">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>Description</th>
													<th>Amount</th>
													<th align="center" class="text-center">Select</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($cashables as $cashable)
												<tr class="pointer earning-row">
													<td>{{$cashable->description}}</td>
													<td>{{$cashable->prettyAvailableAmount}}</td>
													<td align="center"><input class="earning-check" type="checkbox" name="earnings[{{$cashable->id}}]" data-amount='{{$cashable->available_amount}}' value="{{$cashable->available_amount}}"></td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-8">
										<div class="col-md-12 text-right bold mb-10">
											Total <span id="total">NGN 0.00</span>
										</div>
										<div class="col-md-12">
											<div class="well well-lg">
												Please note that the maximum amount you can withdraw is NGN 2,000,000.
											</div>
										</div>
										<div class="col-md-12">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</div>
								</div>
							</form>
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

@push('css')
	<link rel="stylesheet" href="{{ asset('css/icheck/flat/blue.css') }}">
@endpush
@section('css')
	<style>
		span#total{
			padding: 7px 13px;
			border:1px solid #eee;
		}
		.pointer:hover{
			cursor: pointer !important;
		}
	</style>
@stop
@push('scripts')
	<script type="text/javascript" src="{{ asset('js/icheck.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/global/plugins/nouislider/nouislider.min.js') }}"></script>
@endpush

@section('page-script')
	<script type="text/javascript">
		Number.prototype.formatMoney = function(c, d, t){
			var n = this, 
			    c = isNaN(c = Math.abs(c)) ? 2 : c, 
			    d = d == undefined ? "." : d, 
			    t = t == undefined ? "," : t, 
			    s = n < 0 ? "-" : "", 
			    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
			    j = (j = i.length) > 3 ? j % 3 : 0;
			return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
		};

		$(document).ready(function(){
			$('input').iCheck({
				checkboxClass: 'icheckbox_flat-blue',
				radioClass: 'iradio_flat'
			});
			$('.earning-row').click(function(event) {
				console.log('click');
				$(this).find('.earning-check').iCheck('toggle');
			});
	        $('.earning-check').on('ifToggled', function(event) {
	            var sum = 0;
	            $.each($('input.earning-check:checkbox:checked'), function(index, val) {
	                 sum += parseInt($(val).data('amount'));
	            });
	            console.log(sum);
	            $('span#total').text("NGN "+sum.formatMoney());
	        });

		});

	</script>
@stop
@extends('layouts.app')


@section('content')
<section class="content-header">
	<h1>Dashboard</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="col-sm-6 col-xs-12 text-center">
				<div class="info-box flex-center ph-b-cont help-button-container"><button  id="ph-button" ><h2 v-html="phButton.text">Provide Help</h2></button></div>
				{{-- <div class="info-box flex-center ph-b-cont help-button-container"><button  :disabled="phButton.status" id="ph-button" @click="canProvideHelp"><h2 v-html="phButton.text">Provide Help</h2></button></div> --}}
			</div>
			<div class="col-sm-6 col-xs-12 ">
				<div class="info-box flex-center gh-b-cont help-button-container"><button  :disabled="ghButton.status" id="gh-button" @click="canGetHelp"><h2 v-html="ghButton.text">Get Help</h2></button></div>
			</div>
		</div>
	</div>
	<section class="transactions">
		<div class="row">
			<div class="col-xs-12 col-md-8">
				<div class="col-xs-12 mb-20"><button class="show-hide" @click="togglePhPairs">Show / Hide PH History</button></div>
				<div class="col-xs-12 pair-ph-container">
					<ph-pair-list :ph-pairs="phPairs" v-show='showPhPairs'></ph-pair-list>
				</div>
				<div class="col-xs-12 mb-20"><button class="show-hide" @click="toggleGhPairs">Show / Hide GH History</button></div>
				<div class="col-xs-12 pair-gh-container">
					<gh-pair-list :gh-pairs="ghPairs" v-show="showGhPairs"></gh-pair-list>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="col-xs-12 mb-20"><button @click="togglePhs" class="show-hide">Show / Hide PH Activity</button></div>
				<div v-show="showPhs" class=" col-xs-12 activity-ph-container">
					<ph-card v-for="ph in phs" :ph='ph' :key="ph.id"></ph-card>
				</div>
				<div class="col-xs-12 mb-20"><button @click="toggleGhs" class="show-hide">Show / Hide GH Activity</button></div>
				<div v-show="showGhs" class=" col-xs-12 activity-gh-container">
					<gh-card v-for="gh in ghs" :gh='gh'></gh-card>
				</div>
			</div>
		</div>
	</section>
</section>
@stop

@section('mainScript')
<script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
<script type="text/javascript">
	function swallow(form){
		swal({
			title: 'Confirm',
			type: 'info',
			html: 'Are you sure you want to provide help of &#8358;'+$(form).find('#form-amount').val()+'?',
			showCancelButton: true,
			confirmButtonText: 'Yes',
			cancelButtonText: 'No',
			showLoaderOnConfirm: true,
			preConfirm: function () {
				return new Promise(function (resolve, reject) {
					$.post('/json/phs', $(form).serialize(), function(data, textStatus, xhr) {
						console.log(data);
					},'json')
					.done(function(r){
						if(r.status == 'success'){
							resolve(r)
						}
						else if(r.status == 'failed'){
							reject(r.message)
						}
					})
					.fail(
						reject('Your Request to provide help failed. Please try again later')
					);
				})
			},
			allowOutsideClick: false
		}).then(function (d) {
			swal({
				type: 'success',
				title: 'Congrats',
				html: 'Your request to provide help has been logged. Once a suitable match is found, you will be notified to provide help',
			})
		},
		function (d) {
			swal({
				type: 'error',
				title: 'Congrats',
				html: d,
			})
		})
	}
	jQuery(document).ready(function($) {

		$(document).ajaxError(function(event, xhr, settings, thrownError) {
			console.log(xhr.responseText);
		});
		// $('#ph-form').submit(function(event) {
		// 	event.preventDefault();
		// 	swallow(this);
		// });
		$('#ph-button').click(function(event) {
			var that = $(this);
			$(this).find('h2').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
			$.getJSON('/json/phs/create',  function (r) {
				if (r.status == 'allowed') {
					$('#ph-modal').modal('show');
				}
				else if(r.error =='unauthenticated'){
					swal('Failed','Your Session has Expired','error');
				}
				else{
					swal('Failed',r.message,'error');
				}
			})
			.always(function(){
				that.find('h2').text('Provide Help');
			});

		});
	});
</script>

@stop
@push('modals')
<div class="modal fade" id="ph-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Provide Help</h4>
			</div>
			<div class="modal-body">
				{{-- <form action="" id="create-ph">
					<div class="form-group">
						<div class="range-slider">
							<div class="text-center">
								<input class="range-slider__range" type="range" id="input-amount" value="5000" min="1000" max="100000" step="1000">
								<input type="number" name="amount" id="amount" step="1000" min="1000">
								<span class="range-slider__value">0</span>
							</div>
						</div> 
					</div>
					<input type="submit" value="submit">
				</form> --}}
				<form id="ph-form" action="" @submit.prevent="swallow" method="POST" role="form">
					<div class="form-group">
						<label for="amount">Amount</label>
						<input name="amount" type="number" min="1000" step="1000" :max="phMax" class="form-control" id="form-amount" placeholder="Enter the amount you wish to give">
					</div>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endpush

@push('BaseData')
IndexBase.data.phPairs = {!!$phPairs!!};
IndexBase.data.ghPairs = {!!$ghPairs!!};
IndexBase.data.phs = {!!$phs!!};
IndexBase.data.ghs = {!!$ghs!!};
IndexBase.data.phLimit = {!!$phLimit!!};
IndexBase.data.ghLimit = {!!$ghLimit!!};
@endpush
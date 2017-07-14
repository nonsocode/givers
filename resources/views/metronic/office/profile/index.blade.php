@extends(config('view.dashboard').'layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-5">
			<div class="portlet light box-info">
				<div class="portlet-title">
					<div class="caption">
						<div class="caption-subject">User Information</div>
					</div>
				</div>
				<div class="portlet-body">
					<form action="" class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-3 control-label">First Name</label>
								<div class="col-sm-9">
									<input type="text" name="first_name" readonly class="insta-select form-control" value="{{$user->first_name}}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Last Name</label>
								<div class="col-sm-9">
									<input type="text" name="first_name" readonly class="insta-select form-control" value="{{$user->last_name}}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Credibility Score</label>
								<div class="col-sm-9">
									<input type="text" readonly="" class="insta-select form-control" value="{{$user->cred_score}}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Join Date</label>
								<div class="col-sm-9">
									<input type="text" readonly="" class="insta-select form-control" value="{{$user->created_at->toFormattedDateString()}}">
								</div>
							</div>

						</div>
					</form>
				</div>
			</div>
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption"><div class="caption-subject">Password Change</div></div>
				</div>
				<div class="portlet-body">
					<form action="{{ route(config('routes.prefix').'profile.password') }}" class="form-horizontal">
						{{csrf_field()}}
						{{method_field('PATCH')}}
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-3 control-label">Current Password</label>
								<div class="col-sm-9">
									<input type="password" name="current_password" id="current_password" class="insta-select form-control" >
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">New Password</label>
								<div class="col-sm-9">
									<input type="text" type="password" name="new_password" id="new_password" class="insta-select form-control" ">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Confirm Password</label>
								<div class="col-sm-9">
									<input type="text" type="password" name="new_password_confirmation" id="new_password_confirmation" class="insta-select form-control">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<button id="password-submit" class="profile-button pull-right btn btn-primary" tpye="submit">Save</button>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption"><div class="caption-subject">Phone Numbers</div></div>
				</div>
				<div class="portlet-body">
					<form action="">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Prefered</th>
									<th>Phone number</th>
									<th>Date Added</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							@foreach ($user->phones as $phone)
								<tr id='phone-{{$phone->id}}'>
									<td>
										<input type="radio"  class="" name="preffered_phone" value="{{$phone->id}}" checked="{{$phone->primary}}">
									</td>
									<td>{{$phone->number}}</td>
									<td>{{$phone->created_at->toFormattedDateString()}}</td>
									<td>
										<a href="" class="label label-default">Edit</a>
										<a href="" class="label label-danger">Delete</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</form>
				</div>
			</div>
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption"><div class="caption-subject">Bank Accounts</div></div>
				</div>
				<div class="portlet-body">
					<form action="">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Prefered</th>
									<th>Bank</th>
									<th>Account Name</th>
									<th>Account Number</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							@foreach ($user->bankAccounts as $account)
								<tr id='bank-account-{{$account->id}}'>
									<td>
										<input type="radio" name="preffered_account" class="" value="{{$account->id}}" checked="{{$account->primary}}">
									</td>
									<td>{{$account->bank->name}}</td>
									<td>{{$account->name}}</td>
									<td>{{$account->number}}</td>
									<td>
										<a href="" class="label label-default">Edit</a>
										<a href="" class="label label-danger">Delete</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</form>
				</div>
			</div>
			
		</div>
	</div>
</section>
@stop

@section('page-script')
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		function disable(form) {
			$(form).find('.profile-button').prop('disabled',true);
		}
		function enable(form){
			$(form).find('.profile-button').prop('disabled',false);
		}
		function clearErrors(form){
			$(form).find('.help-block').remove();
			$(form).find('.has-error').removeClass('has-error');
			$(form).find('.alert').remove();
		}
		$('input.insta-select').click(function(event) {
			this.select();
		});
		$('form').submit(function(event) {
			var that = this;
			clearErrors(that);
			disable(that);
			event.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).find('input[name=_method]').val() || 'PATCH',
				dataType: 'json',
				data: $(this).serialize(),
			})
			.done(function(r) {
				var dismiss = '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				if (r.status == 'success') {
					$(that).prepend($('<div>').addClass('alert alert-success alert-dismisable').html(r.message+dismiss));
				}
				else{
					$(that).prepend($('<div>').addClass('alert alert-danger alert-dismisable').html(r.message+dismiss));
				}
			})
			.fail(function(xhr,txt,e) {
				if (e == 'Unprocessable Entity' && xhr.status == 422) {
					$.each(xhr.responseJSON, function(index, el) {
						$('#'+index).parents('.form-group').addClass('has-error');
						$('#'+index).parent().append('<span class="help-block" style="font-size:0.8em;">'+el[0]+'</span>');
					});
				}
			})
			.always(function() {
				enable(that);
			});
			
		});
	});
	</script>
@stop
@extends('layouts.app')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-info">
				<div class="box-header with-border"><h4>User Information</h4></div>
				<form action="" class="form-horizontal">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">First Name</label>
							<div class="col-sm-9">
								<input type="text" name="first_name" class="form-control" value="{{$user->first_name}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Last Name</label>
							<div class="col-sm-9">
								<input type="text" name="first_name" class="form-control" value="{{$user->last_name}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Credibility Score</label>
							<div class="col-sm-9">
								<input type="text" readonly="" class="form-control" value="{{$user->cred_score}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Join Date</label>
							<div class="col-sm-9">
								<input type="text" readonly="" class="form-control" value="{{$user->created_at->toFormattedDateString()}}">
							</div>
						</div>

					</div>
				</form>
			</div>
			<div class="box box-default">
				<div class="box-header with-border"><h4>Password Change</h4></div>
				<form action="" class="form-horizontal">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Current Password</label>
							<div class="col-sm-9">
								<input type="password" name="old_password" class="form-control" >
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Last Name</label>
							<div class="col-sm-9">
								<input type="text" type="password" name="password" class="form-control" ">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Credibility Score</label>
							<div class="col-sm-9">
								<input type="text" type="password" name="password_confirmation" class="form-control">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-warning">
				<div class="box-header with-border"><h4>Phone Numbers</h4></div>
				<div class="box-body">
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
			<div class="box box-success">
				<div class="box-header with-border"><h4>Bank Accounts</h4></div>
				<div class="box-body">
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
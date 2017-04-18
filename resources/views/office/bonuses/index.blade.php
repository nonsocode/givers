@extends('layouts.app')

@section('content')
	<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<table class="table">
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
					@forelse ($bonuses as $bonus)
						<tr>
							<td></td>
						</tr>
					@empty
						<tr>
							<td colspan="6" align="center"><h4>You have not been awarded any bonuses yet</h4><td>
						</tr>
					@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</section>
@stop
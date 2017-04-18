@extends('layouts.app')

@section('content')
	<section class="content">

	<div class="row">
		<div class="col-md-3">
			<div class="box">
				<div class="box-header"><h4>Ticket Information</h4></div>
				<div class="box-body">
					<ul class="list-group alternate">
							<li class="list-group-item">
							<strong>Title</strong><br>
								{{$ticket->title}} - 
								<strong><small>{{$ticket->tid}}</small></strong>
								<span class="label label-{{$ticket->status_text}}">{{$ticket->status_text}}</span>
							</li>
							<li class="list-group-item">
								<strong>Category:</strong><br>
								{{$ticket->category->name}}
							</li>
							<li class="list-group-item">
								<strong>Submitted:</strong><br>
								{{$ticket->created_at->diffForHumans()}}
							</li>
							<li class="list-group-item">
								<strong>Last Update:</strong><br>
								{{
									$ticket->messages->sortByDesc('created_at')->first()?
									$ticket->messages->sortByDesc('created_at')->first()->updated_at->diffForHumans():
									$ticket->updated_at->diffForHumans()
								}}
							</li>
							<li class="list-group-item">
								<strong>Priority</strong> :  
								{{$ticket->priority}}
							</li>
							<li class="list-group-item text-center">
							<form action="{{ route('ticket.close',[$ticket->id]) }}" method="POST">
								{{csrf_field()}}
								{{method_field("PATCH")}}
								<button type="submit" class="btn btn-danger" {{$ticket->status === 2 ? "disabled":''}}>Close Ticket</button>
							</form>
							</li>
					</ul>
				</div>
			</div>
			<div class="box">
				<h4 class="text-center">Recent Tickets</h4>
				<ul class="list-group">
				@forelse ($tickets->sortByDesc('created_at')->take(3) as $tick)
					<li class="list-group-item">
						<a href="{{ route('ticket.view',[$tick->id]) }}">
						{{$tick->title}} <span class="pull-right label label-{{$tick->status_text}}">{{$tick->status_text}}</span></a>
					</li>
				@empty
					<li>You have not created any tickets yet</li>
				@endforelse
				</ul>
			</div>
		</div>
		<div class="col-md-9">
			@if ($ticket->status != 2)
				@include('comps.ticketReply', ['ticket' => $ticket])
			@endif
			<div class="box">
				<div class="box-body">
					{{-- <div class="direct-chat-messages"> --}}
						@foreach ($ticket->messages->sortByDesc('created_at') as $message)
								@component('comps.message',compact('message'))
									{!!$message->message!!}
								@endcomponent
						@endforeach
					{{-- </div> --}}
				</div>
			</div>
			@if ($ticket->status != 2)
				@include('comps.ticketReply', ['ticket' => $ticket])
			@endif

		</div>
	</div>
		

	</section>
@stop
@extends('layouts.app')

@section('content')
	<section class="content">
		@foreach ($ticket->messages->sortByDesc('created_at') as $message)
			{{$message->message}}<br>			
		@endforeach


	</section>
@stop
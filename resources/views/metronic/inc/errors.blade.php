@if ($errors->count())
	@foreach ($errors->all() as $error)
	    <div class="alert alert-danger alert-dismissable">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        {!! $error !!}
	    </div>
	@endforeach
@endif

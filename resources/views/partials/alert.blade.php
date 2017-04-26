@if (session()->has('fail'))
    <div class="alert alert-danger alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! session('fail') !!}
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! session('success') !!}
    </div>
@endif
@if (session()->has('info'))
    <div class="alert alert-info alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! session('info') !!}
    </div>
@endif

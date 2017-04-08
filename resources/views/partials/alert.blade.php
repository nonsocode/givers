@if (session()->has('fail'))
    <div class="alert alert-danger">
        {!! session('fail') !!}
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success">
        {!! session('success') !!}
    </div>
@endif
@if (session()->has('info'))
    <div class="alert alert-info">
        {!! session('info') !!}
    </div>
@endif

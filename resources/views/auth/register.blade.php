@extends('layouts/auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name*</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name*</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address*</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{!! $errors->first('email') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('phone') ? ' has-error':''}}">
                            <label for="phone" class="col-md-4 control-label">Phone Number*</label>
                            <div class="col-md-6">
                                <input type="phone" class="form-control" name="phone" id="phone" value="{{old('phone')}}" minlength="9" maxlength="11">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('phone')}}</strong>
                                    </span>
                                @endif  
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password*</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" id="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('password')}}</strong>
                                    </span>
                                @endif  
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password*</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group{{ $errors->has('bank') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Primary Bank*</label>
                            <div class="col-md-6">
                                <select  class="form-control" name="bank" id="password">
                                    <option value="0">Select a bank</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{$bank->name}}">{{$bank->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('bank'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('bank')}}</strong>
                                    </span>
                                @endif  
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bank_account.number') ? ' has-error' : '' }}">
                            <label for="bank_account_number" class="col-md-4 control-label">Bank Account Number</label>
                            <div class="col-md-6">
                                <input id="bank_account_number" name="bank_account[number]" type="text" minlength="10" maxlength="10" class="form-control"  value="{{ old('bank_account.number')}}" >

                                @if ($errors->has('bank_account.number'))
                                    <span class="help-block">
                                        <strong>{!! $errors->first('bank_account.number') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bank_account.name') ? ' has-error' : '' }}">
                            <label for="bank_account_name" class="col-md-4 control-label">Bank Account Name</label>
                            <div class="col-md-6">
                                <input id="bank_account_name" name="bank_account[name]" type="text"  class="form-control" name="referrer" value="{{ old('bank_account.name')}}" >

                                @if ($errors->has('bank_account.name'))
                                    <span class="help-block">
                                        <strong>{!! $errors->first('bank_account.name') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('referrer') ? ' has-error' : '' }}">
                            <label for="referrer" class="col-md-4 control-label">Referrer's Email Address</label>
                            <div class="col-md-6">
                                <input id="referrer" type="email" class="form-control" name="referrer" value="{{ old('referrer') ?: $request->referrer}}" >

                                @if ($errors->has('referrer'))
                                    <span class="help-block">
                                        <strong>{!! $errors->first('referrer') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


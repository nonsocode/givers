@extends('layouts.app')

@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box">
					<div class="box-header with-border"><h4 class="text-left">Create New Ticket</h4></div>
					<div class="box-body">
						<p>In order to streamline support requests and better serve you, we utilize a support ticket system. Every support request is assigned a unique ticket number which you can use to track the progress and responses online. For your reference we provide complete archives and history of all your support requests.</p>
						<hr>
						<form action="{{ route('tickets.store') }}" method="POST" role="form">
							{{csrf_field()}}
							<div class="col-md-4">
								<div class="form-group">
									<label for="" class="">Subject</label>
									<input type="text" name="title" placeholder="Brief summary of the problem" class="form-control">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="" class="">Category</label>
									<select class="form-control" name="cat_id">
											<option>Select a category</option>
										@foreach ($categories as $category)
											<option value="{{$category->id}}">{{$category->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="" class="">Priority</label>
									<select class="form-control" name="priority">
										<option value="low">Low</option>
										<option value="medium">Medium</option>
										<option value="high">High</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Message</label>
									<textarea name="message" rows="10" class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group text-center">
	                            <div class="g-recaptcha" style="display:inline-block;" data-sitekey="{{env('GOOGLE_CAPTCHA_CLIENT')}}"></div>
	                            @if ($errors->has('cpatcha'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('captcha') }}</strong>
	                                </span>
	                            @endif
	                        </div>
						
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>
@stop

@section('mainScript')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@stop
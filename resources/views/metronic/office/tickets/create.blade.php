@extends(config('view.dashboard').'layouts.app')

@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="portlet light">
					<div class="box-header with-border"><h4 class="text-left">Create New Ticket</h4></div>
					<div class="box-body">
						<p>In order to streamline support requests and better serve you, we utilize a support ticket system. Every support request is assigned a unique ticket number which you can use to track the progress and responses online. For your reference we provide complete archives and history of all your support requests.</p>
						<hr>
						<form action="{{ route(config('routes.prefix').'tickets.store') }}" enctype="multipart/form-data" method="POST" role="form">
							{{csrf_field()}}
							<div class="col-md-4">
								<div class="form-group">
									<label for="" class="">Subject</label>
									<input maxlength="190" minlength="15" type="text" name="title" placeholder="Brief summary of the problem" class="form-control">
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
	                        <div class="row">
		                        <div class="col-md-12">
			                        <div id="file-container" class="col-md-6">
			                        <div class="col-md-6">
			                        	<button id="addFile" class="btn btn-primary"><i class="fa fa-plus"></i> Add File</button> <span class="help-block">Only pictures (png,jpg) are allowed. Max size 500KB</span>
			                        </div>
		                        </div>
	                        </div>
	                        <div class="col-md-12">
								<button type="submit" class="btn btn-primary">Submit</button>
	                        </div>
	                        <div class="clearfix"></div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>
@stop

@section('page-script')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript">
    	$('#addFile').click(function(event) {
    		event.preventDefault();
    		if ($("input[name='pics[]']").length < 5) {
	    		var $input = $('<input type="file" name="pics[]">').addClass('form-control');
	    		$('#file-container').append($('<div>').addClass('form-group').append($input));
    		}
    	});
    </script>
@stop
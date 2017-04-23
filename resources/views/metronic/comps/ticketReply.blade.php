		<div class="portlet light">
                <div >
                    <button type="button" class="wide-button" data-target="#reply-port" data-toggle="collapse">
                        <div class="caption pull-left"><i class="fa fa-pencil"></i> Reply</div>
                        <div class="box-tools pull-right">
                            <i class=" fa fa-reply"></i>
                        </div>
                    </button>
                </div>
                <div id="reply-port" class="portlet-body {{$errors->count() ? '': 'collapse'}}">
					<form action="{{ route('newTicketMessage',[$ticket->id]) }}" enctype="multipart/form-data" method="POST" role="form">
						{{csrf_field()}}
						<legend>New Reply</legend>
					
						<div class="form-group">
							<label for="">Message</label>
							<textarea type="text" class="form-control" name='message'></textarea>
						</div>
                        <div class="row">
                                <div class="col-md-6">
                                    <button id="addFile" style="display: inline-block;" class="btn btn-primary"><i class="fa fa-plus"></i> Add File</button> <span class="help-block" style="display: inline-block;">Only pictures (png,jpg) are allowed. Max size 500KB</span>
                                </div>
                                <div id="file-container" class="col-md-6"></div>
                        </div>

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
                </div>
                <!-- /.box-body -->
        </div>

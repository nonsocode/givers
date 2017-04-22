		<div class="portlet light">
                <div class>
                    <button type="button" class="wide-button" data-target="#reply-port" data-toggle="collapse">
                    <div class="box-title caption"><i class="fa fa-pencil"></i> Reply</div>
                    <div class="box-tools pull-right">
                        <i class=" fa fa-reply"></i>
                        
                    </div>
                    </button>
                </div>
                <div id="reply-port" class="portlet-body {{$errors->count() ? '': 'collapse'}}">
					<form action="{{ route('newTicketMessage',[$ticket->id]) }}" method="POST" role="form">
						{{csrf_field()}}
						<legend>New Reply</legend>
					
						<div class="form-group">
							<label for="">Message</label>
							<textarea type="text" class="form-control" name='message'></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
                </div>
                <!-- /.box-body -->
        </div>

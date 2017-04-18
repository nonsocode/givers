		<div class="box box-solid collapsed-box">
                <div class="box-header with-border">
                    <button type="button" class="wide-button" data-widget="collapse">
                    <h3 class="box-title"><i class="fa fa-pencil"></i> Reply</h3>
                    <div class="box-tools pull-right">
                        <i class=" fa fa-reply"></i>
                        
                    </div>
                    </button>
                </div>
                <div class="box-body" style="display: none;">
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

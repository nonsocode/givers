                            <div class="help-box {{$help->type}}">
                                <h5 class="help-title">Request to provide help {{$help->did}}</h5>
                                <div class="help-details">
                                    Participant : {{$user->name}}<br>
                                    Amount : {{$help->prettyAmount}}<br>
                                    Date Created : {{$help->created_at->toFormattedDateString()}}<br>
                                    Status : {{$help->status_text}}<br>
                                </div>
                                <div class="help-actions text-right">
                                    @can('delete', $help)
                                    <button title="Delete" class="btn btn btn-danger delete-help"><i class="fa fa-trash"></i></button>
                                    @endcan
                                    <button title="Detsils" data-toggle="tooltip" class="btn btn btn-info"><i class="fa fa-bars"></i></button>
                                    
                                </div>
                            </div>

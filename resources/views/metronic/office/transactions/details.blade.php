<div class="portlet light portlet-fit ">
    <div class="portlet-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="note note-danger">
                    <p> <span class="font-red-sunglo bold">ATTENTION!</span>&nbsp;<span class="font-red-sunglo">Make money transfer only to the bank details, which are specified in the order. IndexBaseHub will not be held responsible if transactions are done outside of the banking details shown here, ALL communication between participants should be done in the message box provided for record keeping purposes. BEWARE of scammers that might ask you to make payment to other bank account that is not on our system. CONFIRM order ONLY when you have received the money and it reflects in your bank account</span> </p>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="portlet blue box">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i>Transaction Details
                        </div>
                        <div class="tools">
                            <a title="" data-original-title="" href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row static-info">
                            <div class="col-sm-5 name"> Transaction No.</div>
                            <div class="col-sm-7 value">
                                {{$transaction->did}}
                            </div>
                        </div>
                        <div class="row static-info">
                            <div class="col-sm-5 name"> Created At</div>
                            <div class="col-sm-7 value">{{$transaction->created_at->toDateTimeString()}}</div>
                        </div>
                        <div class="row static-info">
                            <div class="col-sm-5 name"> Order Status </div>
                            <div class="col-sm-7 value">
                                <span class="label label-info">{{$transaction->status_text}}</span>
                            </div>
                        </div>
                        <div class="row static-info">
                            <div class="col-sm-5 name"> Amount To be Paid </div>
                            <div class="col-sm-7 value">
                                {{$transaction->prettyAmount}}
                            </div>
                        </div>
                        <div class="row static-info">
                            <div class="col-sm-5 name">Transaction Expiry</div>
                            <div class="col-sm-7 value">{{$transaction->expiry->toDateTimeString()}}</div>
                        </div>
                        @if ($transaction->pher_confirm)
                            <div class="row static-info">
                                <div class="col-sm-5 name">Proof of patment</div>
                                <div class="col-sm-7 value"><a target="_blank" href="{{$transation->pher_confirm}}" class="font-blue"><i class="fa fa-image"></i> Picture</a></div>
                            </div>
                        @endif
                        @if ($receiver->id == Auth::user()->id && !$transaction->gher_confirm)
                            <div class="row static-info">
                                <div class="col-xs-12">
                                    <div class="alert alert-info">
                                        if you have received the complete payment of the amount stipulated, Please Click <a href="">Here</a> to confirm the transaction.
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="portlet blue box">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>Receiver's Bank Details
                        </div>
                        <div class="tools">
                            <a title="" data-original-title="" href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row static-info">
                            <div class="col-sm-5 name">Bank Account Name </div>
                            <div class="col-sm-7 value">{{$ba->name}}</div>
                        </div>
                        <div class="row static-info">
                            <div class="col-sm-5 name">Bank Account Number </div>
                            <div class="col-sm-7 value">{{$ba->number}}</div>
                        </div>
                        <div class="row static-info">
                            <div class="col-sm-5 name">Bank Name </div>
                            <div class="col-sm-7 value"> {{$ba->bank->name}} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="portlet purple box">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Sender Information
                    </div>
                    <div class="tools">
                        <a title="" data-original-title="" href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row static-info">
                        <div class="col-sm-4 name"> Name </div>
                        <div class="col-sm-8 value"> {{$giver->name}} </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-sm-4 name"> Phone </div>
                        <div class="col-sm-8 value"> {{$giver->phone->number or 'No phone number provided'}}</div>
                    </div>
                    <div class="row static-info">
                        <div class="col-sm-4 name"> Referrer </div>
                        <div class="col-sm-8 value"> {{$giver->parent->name or 'None'}} </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-sm-4 name"> Referrer's Phone </div>
                        <div class="col-sm-8 value"> {{$giver->parent->phone->number or 'No phone number provided'}} </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="portlet yellow box">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Recipient Information
                    </div>
                    <div class="tools">
                        <a title="" data-original-title="" href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row static-info">
                        <div class="col-sm-4 name"> Name </div>
                        <div class="col-sm-8 value"> {{$receiver->name}} </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-sm-4 name">Phone </div>
                        <div class="col-sm-8 value"> {{$receiver->phone->number or 'No phone number provided'}} </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-sm-4 name"> Referrer </div>
                        <div class="col-sm-8 value"> {{$receiver->parent->name or 'None'}} </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-sm-4 name"> Referrer's Phone </div>
                        <div class="col-sm-8 value"> {{$receiver->parent->phone->number or 'No phone number provided'}} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($giver->id == Auth::user()->id)
    <form class="form" id="proof" action="{{ route('transaction.pher_confirm',[$transaction->id]) }}" enctype="multipart/form-data" method="post">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="col-sm-8">
            <div class="form-group">
                <label for="">{{!$transaction->pher_confirm?'Upload':'Update'}} 
                Proof of payment</label>
                <input type="file" name="prof_of_payment" class="form-control" id="" placeholder="Input field">
            </div>
        </div>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    @endif
</div>
</div>
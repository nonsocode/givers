<div class="portlet light portlet-fit ">
    <div class="portlet-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="note note-danger">
                    <p> <span class="font-red-sunglo bold">Warning</span>&nbsp;<span class="font-red-sunglo">Be sure to contact the receiver before making any transfer to avoid any issues that may arise</span> </p>
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
                        @if ($transaction->confirmation)
                        <div class="row static-info">
                            <div class="col-sm-5 name">Proof of payment</div>
                            <div class="col-sm-7 value"><a target="_blank" href="{{storage_asset($transaction->confirmation->url)}}" class="font-blue"><i class="fa fa-image"></i> Picture</a></div>
                        </div>
                        @endif
                        @if ($receiver->id == Auth::user()->id)
                            @if ($transaction->confirmation && $transaction->confirmation)
                                @if (!$transaction->happiness)
                                    
                                @endif
                            @endif
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
        @if ($giver->id == Auth::user()->id)
        <form class="form" id="proof" action="{{ route('transaction.pop.save',[$transaction->id]) }}" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="col-sm-6">
                <div class="form-group">
                    <span class="btn btn-success fileinput-button">
                        <i class="fa fa-plus"></i>
                        <label for="">{{!$transaction->pher_confirm?'Upload':'Update'}} Proof of payment</label>
                        <input type="file" class="pop-input" name="proof_of_payment" class="" id="" placeholder="Input field">
                    </span>
                </div>
                 <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        @elseif($receiver->id == Auth::user()->id)

        @endif
    </div>
</div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.pop-input').fileupload({
            url: $("#proof").attr('action'),
            // method : 'put',
            dataType: 'json',
            done: function (e,data) {
                var res = data.result;
                swal('Success','You have uploaded your proof of payment.', 'success');
            },
            fail: function () {
                console.log('failing woegully');
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        })
    });
</script>

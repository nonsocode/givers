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
                        <div class="pop-area">
                            @if ($transaction->confirmation)
                            <div class="row static-info ">
                                <div class="col-sm-5 name">Proof of payment</div>
                                <div class="col-sm-7 value"><a target="_blank" href="{{storage_asset($transaction->confirmation->url)}}" class="font-blue"><i class="fa fa-image"></i> Picture</a></div>
                            </div>
                            @endif
                        </div>
                        @if ($receiver->isLoggedIn())
                            @if (!$transaction->happiness)
                                <div class="row static-info">
                                    <div class="well info">
                                        If You have received the complete payment, Write a Letter of happiness to complete this transaction. Note that your letter of happiness must contain  at leat one valid paragraph stating your reason for happiness
                                    </div>
                                    <div class="col-sm-5 name">Letter of happiness</div>
                                    <div class="col-sm-7">
                                        <form id="loh-form" class="form" action="{{ route('transaction.happiness',$transaction->id) }}" method="post">
                                            {{csrf_field()}}
                                            <textarea name="letter_of_happiness" class="form-control mb-10" id="letter_of_happiness"></textarea>
                                            <div class="text-right"><button class="btn btn-primary">Submit</button></div>
                                        </form>
                                    </div>
                                </div>
                            @endif
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
        @if ($giver->isLoggedIn() && $transaction->doesntHavePOP())
        <form class="form" id="proof" action="{{ route('transaction.pop',[$transaction->id]) }}" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="col-sm-6">
                <div class="form-group">
                    <span class="btn btn-success fileinput-button">
                        <i class="fa fa-plus"></i>
                        <label for="">{{!$transaction->hasPOP()?'Upload':'Update'}} Proof of payment</label>
                        <input type="file" class="pop-input" name="proof_of_payment" class="" id="" placeholder="Input field">
                    </span>
                </div>
                 <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
            </div>
        </form>
        @elseif($receiver->isLoggedIn())

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
                $('form#proof').remove();
                var popArea = 
            `<div class="row static-info ">
                <div class="col-sm-5 name">Proof of payment</div>
                <div class="col-sm-7 value"><a target="_blank" href="${res.url}" class="font-blue"><i class="fa fa-image"></i> Picture</a></div>
            </div>`;        
                $('.pop-area').html(popArea);
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
        $('#loh-form').submit(function(event) {
            event.preventDefault();
            $(this).find('button').prop('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
            })
            .done(function(r) {
                if (r.status == 'success') {
                    $('#transaction-modal').modal('hide');
                    swal('Congrats', r.message, r.status);
                    $('#trn'+r.trnid).remove();
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                $('#loh-form').find('button').prop('disabled', false);
            });
            
        });
    });
</script>

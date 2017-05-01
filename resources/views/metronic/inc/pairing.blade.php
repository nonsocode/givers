<div class="transaction {{Auth::user()->id == $trans->gh->owner->id ? 'receiving':'paying'}}">
    <div class="row">
        <div class="col-md-12">
            <span class="trn-id">{{ $trans->did }}</span>
            <span class="long-status">You are to {{Auth::user()->id == $trans->gh->owner->id ? 'receive':'make'}} a payment for the GH request with Reference No. </span>
            <span class="gh-id">{{$trans->gh->did}}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10">
            <div class="col-sm-4 text-center"><h4><small>From</small><br>{{$trans->ph->owner->short_name}}</h4></div>
            <div class="col-sm-4  text-center">
                <h4><small>Amount</small><br>
                {{$trans->prettyAmount}}
                </h4>
            </div>
            <div class="col-sm-4  text-center"><h4><small>To</small><br>{{$trans->gh->owner->short_name}}</h4>
                <span class="bank">{{$trans->gh->owner->bankAccount->bank->name}}</span>
            </div>
        </div>
        <div class="col-sm-2 text-center">
            <h4><small>Created</small><br><time title="{{$trans->created_at}}" data-toggle='tooltip'>{{$trans->created_at->diffForHumans()}}</time></h4>
        </div>
    </div>
    <div class="row actions mt-10">
        <div class="col-md-6">
            @if ($trans->pher_confirm && $trans->gher_confirm)
                <div class="alert alert-success">This transaction has been completed</div>
            @elseif($trans->expiry->lt(Carbon\Carbon::now()))
                <div class="alert alert-danger">This transaction was not completed</div>
            @else
                <span>Expires :</span>
                <time datetime="{{$trans->expiry}}" data-toggle="tooltip" title="{{$trans->expiry}}" class="expiry">{{$trans->expiry->diffForHumans()}}</time>
            @endif
        </div>
        <div class="col-md-6 actions text-right">
            @if ($trans->pher_confirm)
                <button data-href="{{$trans->pher_confirm}}" class="btn btn-xs btn-info">View Confirmation</button>
            @endif
            <button class="btn btn-xs btn-primary view-transaction"  data-url='{{ route('transaction',[$trans->id]) }}'>Details</button>
        </div>
    </div>
</div>
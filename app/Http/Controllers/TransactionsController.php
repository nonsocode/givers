<?php

namespace App\Http\Controllers;

use App\Pairing;
use App\Services\TransactionHandler as Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function show (Pairing $trn)
    {
    	$trn->load(
    		'gh.owner.phone',
    		'gh.owner.parent',
    		'gh.bankAccount.bank',
    		'ph.owner.phone',
    		'ph.owner.parent'
		);
    	return view(config('view.dashboard').'office.transactions.details')->with([
    		'transaction' => $trn,
    		'ba' => $trn->gh->bankAccount,
    		'giver' => $trn->ph->owner,
    		'receiver' => $trn->gh->owner
		]);
    }

    public function gherConfirm(Pairing $trn)
    {
    	$trn = new Transaction($trn);
    	$trn->gherConfirm();
    	$trn->updateHelpRequests();
    }

    public function pherConfirm (Pairing $trn, Request $req)
    {
        $confirm = (new Transaction($trn))->savePOP($req);
        return response()->json([
            'url' => storage_asset($confirm->url),
            'status' => true,
        ],200);
    }

    public function saveLoh(Pairing $trn,Request $req)
    {
        $handler  = new Transaction($trn);
        if($handler->saveLetterOfHappiness($req)){
            return response()->json([
                'message' => 'This transaction is now complete',
                'status' => 'success',
                'trnid' => $trn->id,
            ],200);
        }
    }
}

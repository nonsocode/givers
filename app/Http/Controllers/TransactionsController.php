<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pairing;
use App\Services\TransactionHandler as Transaction;

class TransactionsController extends Controller
{
    public function show (Pairing $trn)
    {
    	$trn->load(
    		'gh.owner.phone',
    		'gh.owner.parent',
    		'gh.owner.bankAccount.bank',
    		'ph.owner.phone',
    		'ph.owner.parent'
		);
    	return view(config('view.dashboard').'office.transactions.details')->with([
    		'transaction' => $trn,
    		'ba' => $trn->gh->owner->bankAccount,
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
}

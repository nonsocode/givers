<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$tickets = \Auth::user()->tickets;
    	return view('office.tickets.index')->with('headerText','Support Tickets');
    }

    public function create(){
    	return view('office.tickets.create');
    }
    public function store(TicketRequest $request){
        
    }
}

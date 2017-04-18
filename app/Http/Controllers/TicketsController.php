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
        $data['headerText']= 'Support Tickets';
        $data['tickets'] = \Auth::user()->load(['tickets.category'])->tickets;
        return view('office.tickets.index2',$data);
    }

    public function create(){
    	return view('office.tickets.create');
    }

    public function show(Ticket $ticket)
    {
        $data['headerText'] = "Ticket ".$ticket->tid;
        $data['ticket']=$ticket->load('messages.documents');
        return view('office.tickets.show', $data);
    }
    public function store(TicketRequest $request){
        
    }
}

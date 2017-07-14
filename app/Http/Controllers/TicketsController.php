<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\SupportCategory;
use App\Ticket;
use App\TicketMessage;
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
        return view(config('view.dashboard').'office.tickets.index',$data);
        // return view('office.tickets.index2',$data);
    }

    public function create(){
        $categories = SupportCategory::all();
    	return view(config('view.dashboard').'office.tickets.create',compact('categories'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['documents']);
        $data['tickets'] = $ticket->owner->tickets;
        $data['headerText'] = "Ticket ".$ticket->tid;
        $data['ticket']=$ticket->load('messages.documents','messages.owner');
        return view(config('view.dashboard').'office.tickets.show', $data);
    }

    public function newTicketMessage(Ticket $ticket, Request $request)
    {
        // dd($request->hasFile('pics'));
        $tm = new TicketMessage(['message'=> $request->message]);
        $tm->user_id = \Auth::user()->id;
        $ticket->messages()->save($tm);
        $ticket->status == 0 ? $ticket->update(['status'=>1]):null;#$ticket->touch();
        if ($request->hasFile('pics')) {
            foreach ($request->pics as $pic) {
                $urls[]['url'] = $pic->store('ticket-documents', 'public');
            }
            $tm->documents()->createMany($urls);
        }
        return redirect()->back();
    }

    public function closeTicket(Ticket $ticket)
    {
        // dd ($ticket);
        $ticket->status = 2;
        $ticket->save();
        return redirect()->back();
    }

    public function store(Request $req){
        $ticket = new Ticket($req->only(['title','priority']));
        $ticket->support_category_id = $req->cat_id;
        \Auth::user()->tickets()->save($ticket);

        $tm = new TicketMessage($req->only(['message']));
        $tm->ticket_id = $ticket->id;
        \Auth::user()->ticketMessages()->save($tm);
        if ($req->hasFile('pics')) {
            foreach ($req->pics as $pic) {
                $urls[]['url'] = $pic->store('ticket-documents', 'public');
            }
            $tm->documents()->createMany($urls);
        }
        
        return redirect()->route(config('routes.prefix').'ticket.view',[$ticket->id]);

    }
}

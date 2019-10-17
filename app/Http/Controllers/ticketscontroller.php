<?php

namespace App\Http\Controllers;

use App\Category;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mailers\AppMailer;

class TicketsController extends Controller
{
       
		public function __construct()
		{
			$this->middleware('auth')->except(['createAnon','storeAnon']);
		}


		
		/**
		 * Display a listing of the resource.
     		 *
     		 * @return \Illuminate\Http\Response
     		*/
    		public function index()
    		{
			// Limit the display to 10 tickets a page
			$tickets = Ticket::paginate(10);
			$categories = Category::all();

			return view('tickets.index', compact('tickets', 'categories'));
    		}



    		/**
    		 * Show the form for creating a new resource.
    		 *
    		 * @return \Illuminate\Http\Response
     		*/
    		public function create()
    		{
				$categories = Category::all();

				return view('tickets.create', compact('categories'));
    		}
			
			
			/**
			 * Show the form for creating an anonymous ticket
			 *
			 * @return \Illuminate\Http\Response
			*/
			public function createAnon()
			{
				$categories = Category::all();
				
				return view('tickets.create_anon', compact('categories'));
			}

	
	
			/**
    	 	 * Store a newly created resource in storage.
    	 	 *
    	 	 * @param  \Illuminate\Http\Request  $request
    	 	 * @return \Illuminate\Http\Response
    		*/
    		public function store(Request $request, AppMailer $mailer)
			{
				$this->validate($request, [
					'title'     => 'required',
					'message'   => 'required'
				]);

				$ticket = new Ticket([
					'title'     => $request->input('title'),
					'user_id'   => Auth::user()->id,
					'ticket_id' => strtoupper(str_random(10)),
					'category_id'  => 0,
					'priority'  => "New Ticket",
					'message'   => $request->input('message'),
					'status'    => "Open"
				]);

				$ticket->save();

				$mailer->sendTicketInformation(Auth::user(), $ticket);

				return redirect()->back()->with("status", "A complaint with ID: #$ticket->ticket_id has been opened.");
			}


		public function storeAnon(Request $request)
		{
			$this->validate($request, [
				'title'		=> 'required',
				'message'	=> 'required'
			]);

			$ticket = new Ticket([
				'title'		=> $request->input('title'),
				'user_id'	=> 0,
				'ticket_id'	=> strtoupper(str_random(10)),
				'category_id'	=> 0,
				'priority'	=> "New Ticket",
				'message'	=> $request->input('message'),
				'status'	=> "Open"
			]);

			$ticket->save();

			return redirect()->back()->with("status", "Your anonymous complaint has been registered.");
		}

	
	
		public function userTickets()
		{
			$tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);

			return view('tickets.user_tickets', compact('tickets'));
		}

		
		
		/**
     		 * Display the specified resource.
     		 *
     		 * @param  int  $id
     		 * @return \Illuminate\Http\Response
     		*/
		public function show($ticket_id)
		{
			$ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

			return view('tickets.show', compact('ticket'));
		}

			
		public function close($ticket_id, AppMailer $mailer)
		{
			$ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

			$ticket->status = "Closed";

			$ticket->save();

			$ticketOwner = $ticket->user;

			$mailer->sendTicketStatusNotification($ticketOwner, $ticket);

			return redirect()->back()->with("status", "The complaint has been closed.");
		}
		
		public function updatePriority($ticket_id, $priority)
		{
			$ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
			
			$ticket->priority = $priority;
			
			$ticket->save();
			
		}
		
		public function updateCategory($ticket_id, $category_id)
		{
				$ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
				
				$ticket->category_id = $category_id;
				
				$ticket-> save();
		}
		
		
		public function updateStatus($ticket_id, $status, AppMailer $mailer)
		{
			$ticket = Ticket::where('ticket_id',$ticket_id)->firstOrFail();
			
			IF ($status == "Closed")
			{
				$ticket->status = $status;
				$ticket->save();
				$ticketOwner = $ticket->user;

				$mailer->sendTicketStatusNotification($ticketOwner, $ticket);

				return redirect()->back()->with("status", "The complaint has been closed.");
			}
			ELSE
			{
				$ticket->status = $status;
				$ticket->save();
			}
			
		}

}

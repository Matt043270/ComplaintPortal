<?php

namespace App\Http\Controllers;

use App\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class notesController extends Controller
{
    public function postNote(Request $request)
	{
		$this->validate($request, [
			'comment' => 'required'
		]);

		$note = Notes::create([
			'ticket_id' => $request->input('ticket_id'),
			'user_id' => Auth::user()->id,
			'comment' => $request->input('comment')
		]);

		return redirect()->back()->with("status", "Your notes has been added.");
	}
}

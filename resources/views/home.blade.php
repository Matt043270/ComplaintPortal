@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
 
                <div class="panel-body">
 
                    <p>You are logged in!</p>
 
                    @if(Auth::user()->role === 'Admin')
 
                        <p>
                            See all <a href="{{ url('admin/tickets') }}">complaints</a>
                        </p>
                    @elseif(Auth::user()->role === 'Agent')
						
						<p>
							See all <a href="{{ url('agent/tickets') }}"> department complaints</a>
						</p>
					@else
						<p>
							See all your <a href="{{ url('my_tickets') }}">complaints</a> or <a href="{{ url('new-ticket') }}">register a new complaint.</a>
						</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

<div class="notes">
    @foreach($ticket->notes as $note)
        <div class="panel panel-@if($ticket->user->id === $note->user_id){{"default"}}@else{{"success"}}@endif">
            <div class="panel panel-heading">
                {{ $note->user->name }}
 
                <span class="pull-right">{{ $note->created_at->format('d-m-Y') }}</span>
            </div>
 
            <div class="panel panel-body">
                {{ $note->comment }}
            </div>
        </div>
    @endforeach
</div>
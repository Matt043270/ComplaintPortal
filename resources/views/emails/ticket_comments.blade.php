<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support Ticket</title>
</head>
<body>
<p>
    {{ $comment->comment }}
</p>
 
---
<p>Replied by: {{ $user->name }}</p>
 
<p>Title: {{ $ticket->title }}</p>
<p>Complaint ID: {{ $ticket->ticket_id }}</p>
<p>Status: {{ $ticket->status }}</p>
 
<p>
    You can view the complaint at any time by following the link: {{ url('tickets/'. $ticket->ticket_id) }}
</p>
 
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title> Murdoch University Support</title>
</head>
<body>
<p>
Thank you {{ ucfirst($user->name) }} for contacting Murdoch University. A complaint has been registered for you. You will be notified, by email, when a response is made. The details of your complaint are shown below:
</p>
 
<p>Title: {{ $ticket->title }}</p>
<p>Priority: {{ $ticket->priority }}</p>
<p>Status: {{ $ticket->status }}</p>
 
<p>
You can view this complaint at any time by following the link: {{ url('tickets/'. $ticket->ticket_id) }}
</p>
 
</body>
</html>
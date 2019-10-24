@extends('layouts.app')
 
@section('title', 'All Tickets')
 
 @section('head')
	<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
 
@section('content')
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-ticket"> Department Complaints</i>
                </div>
 
                <div class="panel-body">
                    @if ($tickets->isEmpty())
                        <p>This department currently has no complaints.</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>Title</th>
								<th>Status</th>
								<th>Priority</th>
								<th> Created On </th>
								<th>Last Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
				<tr>
					
				<!-- Category -->
				<td>

                            <div class="col-md-15">
                                <select id="category" type="category" class="form-control" name="category" onchange="changeCategory('{{ $ticket->ticket_id }}', this.value)">
                                    <option value="">{{$ticket->category->name}}</option>
									@foreach ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->name }}</option>
									@endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                     </div>
                </td>  
				<script type="application/javascript">
						function changeCategory(ticket_id, category_id) {
						const response = fetch('/admin/updateCategory/' + ticket_id + '/' + category_id, {
						
						
						//	headers: {
						//		"Content-Type": "application/json",
						//		"Accept": "application/json",
						//		"X-Requested-With": "XMLHttpRequest",
						//		"X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]')
						//	},
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
						
							method: "post",
						});
						console.log(JSON.stringify(response));
					}
					</script>

					

			
					<!-- Ticket Title -->
					<td>
						<a href="{{ url('tickets/'. $ticket->ticket_id) }}">
							#{{ $ticket->ticket_id }} - {{ $ticket->title }}
						</a>
				    </td>
					
					<!-- Submitted By -->
				
						
			
					<!-- Ticket Status -->
					
					<td>
						<div class="form-group{{$errors->has('status') ? 'has-errors' : '' }}">
							<div class="col-md-10">
								<select id="status" type="" class="form-control" name="status" onchange="changeStatus('{{$ticket->ticket_id}}',this.value)">
									<option value="">{{$ticket->status}}</option>
									<option value="Assigned">Assigned</option>
									<option value="Reviewing">Reviewing</option>
									<option value="Pending Resolution">Pending Resolution</option>
									<option value="Closed">Closed</option>
								</select>
							</div>
						</div>
					</td>
					
					<script type="application/javascript">
						function changeStatus(ticket_id, status) {
						const response = fetch('/admin/updateStatus/' + ticket_id + '/' + status, {
						
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
						
							method: "post",
						});
						console.log(JSON.stringify(response));
					}
					</script>

					
				    <td>
					
						<div class="form-group{{$errors->has('priority') ? 'has-error': '' }}">
							<div class="col-md-15">
								<select id="priority" type="" class="form-control" name="priority" onchange="changePriority('{{ $ticket->ticket_id }}', this.value)">
									<option value="">{{ $ticket->priority}}</option>
									<option value="Low">Low</option>
									<option value="Moderate">Moderate</option>
									<option value="High">High</option>
								</select>
							</div>
						</div>
					</td>

					<script type="application/javascript">
						function changePriority(ticket_id, priority) {
						const response = fetch('/admin/updatePriority/' + ticket_id + '/' + priority, {
						
						
						//	headers: {
						//		"Content-Type": "application/json",
						//		"Accept": "application/json",
						//		"X-Requested-With": "XMLHttpRequest",
						//		"X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]')
						//	},
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
						
							method: "post",
						});
						console.log(JSON.stringify(response));
					}
					</script>
					
					

				    </td>
					
					<!-- Ticket Created At -->
					<td>{{$ticket->created_at}}</td>
					
					<!-- Ticket Last Updated -->
				    <td>{{ $ticket->updated_at }}</td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
 
                        {{ $tickets->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
	
@endsection

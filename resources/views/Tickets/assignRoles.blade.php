@extends('layouts.app')
 
@section('title', 'All Users')
 
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
                    <i class="fa fa-ticket">Users</i>
                </div>
 
                <div class="panel-body">
                    @if ($users->isEmpty())
                        <p>There are currently no users.</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
								<th>Role</th>
								<th>Department</th>
								<th> Created On </th>
								<th>Last Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                @foreach ($users as $user)
				<tr>
					
				<!-- Name -->
				<td>{{$user->name}}</td>
				
				<!-- Email -->
				<td> {{$user->email}}</td>
				
				<!-- Role -->
					<td>
						<div class="form-group{{$errors->has('role') ? 'has-errors' : '' }}">
							<div class="col-md-10">
								<select id="role" type="" class="form-control" name="role" onchange="changeRole('{{$user->user_id}}',this.value)">
									<option value="">{{$user->role}}</option>
									<option value="Admin">Admin</option>
									<option value="Agent">Agent</option>
									<option value="User">User</option>
								</select>
							</div>
						</div>
					</td>
					
					<script type="application/javascript">
						function changeRole(ticket_id, role) {
						const response = fetch('/admin/updateRole/' + ticket_id + '/' + role, {
						
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
						
							method: "post",
						});
						console.log(JSON.stringify(response));
					}
					</script>
				
				
				
	

	


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
 
                        {{ $users->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
	
@endsection

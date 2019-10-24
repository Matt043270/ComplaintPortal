<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('new-ticket', 'TicketsController@create');

Route::post('new-ticket', 'TicketsController@store');



Route::get('anon-ticket', 'TicketsController@createAnon');

Route::post('anon-ticket', 'TicketsController@storeAnon');

 
 
Route::get('my_tickets', 'TicketsController@userTickets');
 
Route::get('tickets/{ticket_id}', 'TicketsController@show');
 
Route::post('comment', 'CommentsController@postComment');
Route::post('notes', 'NotesController@postNote');
 
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function (){
	 
	Route::get('tickets', 'TicketsController@index');
	     
	Route::post('close_ticket/{ticket_id}', 'TicketsController@close');
		
	Route::post('updatePriority/{ticket_id}/{priority}', 'TicketsController@updatePriority');
	     
	Route::post('updateDepartment/{ticket_id}/{department_id}', 'TicketsController@updateDepartment');
		
	Route::post('updateStatus/{ticket_id}/{status}', 'TicketsController@updateStatus');
	
	Route::get('roles','TicketsController@assignRoles');
	Route::post('updateRole/{user_id}/{role}', 'TicketsController@updateRole');
	Route::post('updateUserDepartment/{user_id}/{department_id}', 'TicketsController@updateUserDepartment');
	
});


Route::group(['prefix' => 'agent', 'middleware' => 'agent'], function (){
	
	Route::get('tickets', 'TicketsController@agentTickets');
	
	Route::post('close_ticket/{ticket_id}', 'TicketsController@close');
	
	Route::post('updatePriority/{ticket_id}/{priority}','TicketsController@updatePriority');
	
	Route::post('updateStatus/{ticket_id}/{status}','TicketsController@updateStatus');
	
});
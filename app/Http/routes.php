<?php

use Illuminate\Http\Request;
use App\User;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
	return View::make('index');
});

// API routes
Route::group(['prefix' => 'api/v1'], function () {

	// User Routes
	Route::get('users/{id}', 'UserController@index');
	Route::get('users', 'UserController@feed');
	Route::get('users/{id}/feed', function($id) {
		echo User::find($id)->dogs()->orderBy('name')->get();
	});

	// Dog Routes
	Route::get('dogs/{id}', 'DogController@index');
	Route::get('dogs', 'DogController@feed');

});
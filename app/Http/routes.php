<?php

// use Illuminate\Http\Request;

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
	return view('home');
});


/* OAUTH ROUTES */
Route::post('oauth/access_token', function() {
	return Response::json(Authorizer::issueAccessToken());
});

Route::post('api/v1/users', 'UserController@store');


// API routes
Route::group(['prefix' => 'api/v1', 'middleware' => 'oauth'], function () {

	Route::get('/', function() {
		return Response::json([
			'user_url' => '/api/v1/users/{id}',
			'dogs_url' => '/api/v1/dogs/{id}',
			'feed_url' => '/api/v1/feed/{code}'
		], 200);
	});

	// Users Routes
	Route::resource('users', 'UserController', ['except' => [
    	'store'
	]]);

	// Account Routes
	Route::resource('account', 'AccountController');

	// Dog Routes
	Route::resource('dogs', 'DogController');
	
	// Feed Routes
	Route::get('feed/{code}', 'FeedController@index');

});


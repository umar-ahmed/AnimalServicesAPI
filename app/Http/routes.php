<?php

// use Illuminate\Http\Request;
use App\Dog;

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


/* OAUTH ROUTES */
Route::get('/register', function(){
	$user = new App\User();
	$user->name='test user';
	$user->email='test@test.com';
	$user->password = \Illuminate\Support\Facades\Hash::make('password');
	$user->save();
});


Route::post('oauth/access_token', function() {
	return Response::json(Authorizer::issueAccessToken());
});


/*  OTHER ROUTES  */
Route::get('/', function() {
	return view('home');
});

// API routes
Route::group(['prefix' => 'api/v1', 'middleware' => 'oauth'], function () {

	Route::get('/', function() {
		return Response::json([
			'user_url' => '/api/v1/users/{id}',
			'dogs_url' => '/api/v1/dogs/{id}',
			'feed_url' => '/api/v1/feed/{code}'
		], 200);
	});

	// User Routes
	Route::resource('users', 'UserController');

	// Dog Routes
	Route::resource('dogs', 'DogController');
	
	// Feed Routes
	Route::get('feed/{code}', 'FeedController@index');

});


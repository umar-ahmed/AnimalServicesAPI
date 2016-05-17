<?php

use Illuminate\Http\Request;
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

Route::auth();

Route::get('/', 'HomeController@index');

// API routes
Route::group(['prefix' => 'api/v1'], function () {

	Route::get('/', function() {
		return Response::json([
			'user_url' => '/api/v1/users/{id}',
			'dogs_url' => '/api/v1/dogs/{id}',
			'feed_url' => '/api/v1/feed/{code}'
		], 200);
	});

	// User Routes
	Route::get('users/{id}', [
		'middleware' => 'auth',
		'uses' => 'UserController@index'
	]);

	// Feed Routes
	Route::get('feed/{code}', [
		'middleware' => 'auth',
		'uses' => 'FeedController@index'
	]);

	// Dog Routes
	Route::get('dogs/{id}', 'DogController@index');
	Route::get('dogs', 'DogController@feed');

});


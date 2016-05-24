<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Dog;
use App\Http\Controllers\MyPDO;

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

/* OAUTH TOKEN ROUTES */
App::singleton('oauth2', function() {
    
    $storage = new MyPDO(App::make('db')->getPdo());
    $server = new OAuth2\Server($storage);
    
    $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
    $server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));
    
    return $server;
});


Route::post('oauth/token', 'OAuthController@getOAuthToken');


/*  OTHER ROUTES  */

Route::auth();

Route::get('/', 'HomeController@index');

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
	Route::resource('users/{id}', 'UserController@show');

	// Dog Routes
	Route::resource('dogs', 'DogController');
	
	// Feed Routes
	Route::get('feed/{code}', [
		'middleware' => 'auth',
		'uses' => 'FeedController@index'
	]);

});


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UserController extends Controller
{
    
	public function index($id) {
		
		try {
			$statusCode = 200;
			$response = [];

			// Selection
			$users = User::where('id', $id)->get();

			if ( sizeof($users) == 0) {
				array_push($response, [
					'message' => "Not Found", 
					'documentation_url' => "https://github.com/umar-ahmed/AnimalServicesAPI"
				]);
				$statusCode = 404;
			} else {

				foreach($users as $user) {

	                array_push($response, [
	                    'id' => $user->id,
	                    'name' => $user->name,
	                    'email' => $user->email,
	                    'username' => $user->username,
	                    'code' => $user->code,
	                ]);
	            }
        	}
		} catch (Exception $e) {
			$statusCode = 400;
		} finally {
			return Response::json($response[0], $statusCode);
		}
	}

}

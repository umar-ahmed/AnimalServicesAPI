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
			$response = [
				'users' => []
			];

			// Selection
			$users = User::where('id', $id)->get();

			foreach($users as $user){

                $response['users'][] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'code' => $user->code,
                ];
            }
		} catch (Exception $e) {
			$statusCode = 400;
		} finally {
			return Response::json($response['users'], $statusCode);
		}
	}

	public function feed() {
		try {
			$statusCode = 200;
			$response = [
				'users' => []
			];

			// Selection
			$users = User::take(5)->get();

			foreach($users as $user){

                $response['users'][] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'code' => $user->code,
                ];
            }
		} catch (Exception $e) {
			$statusCode = 400;
		} finally {
			return Response::json($response['users'], $statusCode);
		}
   }

}

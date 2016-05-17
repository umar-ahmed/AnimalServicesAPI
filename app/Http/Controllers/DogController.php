<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dog;
use Auth;

class DogController extends Controller
{
    public function index($id) {
		
		try {
			$statusCode = 200;
			$response = [];

			// Selection
			$dogs = Dog::where('id', $id)->get();

			if ( sizeof($dogs) == 0) {
				array_push($response, [
					'message' => "Not Found", 
					'documentation_url' => "https://github.com/umar-ahmed/AnimalServicesAPI"
				]);
				$statusCode = 404;
			} else {
				$response = $dogs;
			}

		} catch (Exception $e) {
			$statusCode = 400;
		} finally {
			return Response::json($response[0], $statusCode);
		}
	}

	public function feed() {
		
		try {
			$statusCode = 200;
			$response = [];

			// Selection
			$dogs = Dog::orderBy('created_at', 'desc')
				->take(5)
				->get();

			foreach($dogs as $dog){
				array_push($response, [
                    'id' => $dog->id,
                    'name' => $dog->name,
                    'reference_num' => $dog->reference_num,
                ]);
            }
		} catch (Exception $e) {
			$statusCode = 400;
		} finally {
			return Response::json($response, $statusCode);
		}
	}
}

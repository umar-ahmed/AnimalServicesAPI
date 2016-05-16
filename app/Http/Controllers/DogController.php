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
			$response = [
				'dogs' => []
			];

			// Selection
			$dogs = Dog::where('id', $id)->get();

			foreach($dogs as $dog){

                $response['dogs'][] = [
                    'reference_num' => $dog->reference_num,
                    'name' => $dog->name,
                ];
            }
		} catch (Exception $e) {
			$statusCode = 400;
		} finally {
			return Response::json($response, $statusCode);
		}
	}

	public function feed() {
		
		try {
			$statusCode = 200;
			$response = [
				'dogs' => []
			];

			// Selection
			$dogs = Dog::take(5)->get();

			foreach($dogs as $dog){

                $response['dogs'][] = [
                    'reference_num' => $dog->reference_num,
                    'name' => $dog->name,
                ];
            }
		} catch (Exception $e) {
			$statusCode = 400;
		} finally {
			return Response::json($response, $statusCode);
		}
	}
}

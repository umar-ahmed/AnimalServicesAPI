<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dog;
use Response;
use App\Http\Requests;

class FeedController extends Controller
{
    public function index($code) {
		
		try {
			$statusCode = 200;
			$response = [
				'feed' => []
			];

			// Selection
			$atr = str_split($code);
			$selection = Dog::where('noise_level',$atr[0])
					->where('activity_level',$atr[1])
					->where('friend_level',$atr[2])
					->where('train_level',$atr[3])
					->where('health_level',$atr[4])
					->get();

			foreach($selection as $dog){

                $response['feed'][] = [
                	'id' => $dog->id,
                    'name' => $dog->name,
                ];
            }
		} catch (Exception $e) {
			$statusCode = 400;
		} finally {
			return Response::json($response['feed'], $statusCode);
		}
	}
}
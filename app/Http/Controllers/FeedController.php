<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dog;
use Response;
use App\Http\Requests;
use Exception;

class FeedController extends Controller
{
    public function index($code) {

    	$statusCode = 200;
    	$response = [
				'feed' => []
			];
		
		try {
			
			// Code must have the correct length and requirements
			if (
				strlen($code) == 10 &&
				preg_match("/^(?:([A-E][0-9])(?!.*\\1))*$/", $code) &&
				preg_match("/^([A-E][0-9]){5}$/", $code) 
				) {

				$atr = str_split($code);

				// Weights from 1 to 5
				$weight = array(
					'noise' => ord($atr[0]) - 64,  // 1
					'activity' => ord($atr[2]) - 64,  // 2
					'friend' => ord($atr[4]) - 64,  // 3
					'train' => ord($atr[6]) - 64,  // 4
					'health' => ord($atr[8]) - 64  // 5
				);

				// Scores from 1 to 5
				$score = array(
					'noise' => $atr[1], // 1
					'activity' => $atr[3],  // 2
					'friend' => $atr[5],  // 3
					'train' => $atr[7], // 4
					'health' => $atr[9]  // 5
				);

				$threshold = 2;

				// Compute ranges with edge protection
				$noiseMin = max($score['noise'] - $threshold * $weight['noise'], 0);  // 0
				$noiseMax = min($score['noise'] + $threshold * $weight['noise'], 9);  // 
				$activityMin = max($score['activity'] - $threshold * $weight['activity'], 0);
				$activityMax = min($score['activity'] + $threshold * $weight['activity'], 9);
				$friendMin = max($score['friend'] - $threshold * $weight['friend'], 0);
				$friendMax = min($score['friend'] + $threshold * $weight['friend'], 9);
				$trainMin = max($score['train'] - $threshold * $weight['train'], 0);
				$trainMax = min($score['train'] + $threshold * $weight['train'], 9);
				$healthMin = max($score['health'] - $threshold * $weight['health'], 0);
				$healthMax = min($score['health'] + $threshold * $weight['health'], 9);

				// Perform query
				$selection = Dog::whereBetween('noise_level', [$noiseMin, $noiseMax])
					->whereBetween('activity_level', [$activityMin, $activityMax])
					->whereBetween('friend_level', [$friendMin, $friendMax])
					->whereBetween('train_level', [$trainMin, $trainMax])
					->whereBetween('health_level', [$healthMin, $healthMax])
					->get();


				foreach($selection as $dog){

	                $response['feed'][] = [
	                	'id' => $dog->id,
	                	'image' => $dog->image,
	                    'name' => $dog->name,
	                    'age' => $dog->age,
	                    'breed' => $dog->breed
	                ];
	            }

			} else {

				throw new Exception("Error Processing Request", 1);
				
				
			}
		} catch (Exception $e) {
			$statusCode = 400;
		} finally {
			return Response::json($response['feed'], $statusCode);
		}
	}
}

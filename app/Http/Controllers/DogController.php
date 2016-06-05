<?php

namespace App\Http\Controllers;

use App\Dog;
use App\Http\Requests;
use Illuminate\Http\Request;
use Response;
use Validator;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $rules = array(
            'reference_num' => 'required|unique:dogs',
            'name' => 'required',
            'age' => 'integer|min:0',
            'size' => 'required|in:small,medium,large',
            'gender' => 'required|in:male,female',
            'breed' => 'required',
            'color' => 'required',
            'declawed' => 'required|boolean',
            'neutered' => 'required|boolean',
            'location' => 'required|json',
            'intake_date' => 'required|date',
            'noise_level' => 'required|integer|digits:1',
            'activity_level' => 'required|integer|digits:1',
            'friend_level' => 'required|integer|digits:1',
            'train_level' => 'required|integer|digits:1',
            'health_level' => 'required|integer|digits:1',
            'description' => 'required',
            // 'excerpt' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Response::json( array(
                'error' => 'Malformed request.',
                'error_description' => $validator->errors()->all()
            ), 409);
        } else {

            // Store data
            $dog = new Dog;
            $dog->reference_num = $request->input('reference_num');
            $dog->name = $request->input('name');
            $dog->age = $request->input('age');
            $dog->size = $request->input('size');
            $dog->gender = $request->input('gender');
            $dog->color = $request->input('color');
            $dog->declawed = $request->input('declawed');
            $dog->neutered = $request->input('neutered');
            $dog->location = $request->input('location');
            $dog->intake_date = $request->input('intake_date');
            $dog->noise_level = $request->input('noise_level');
            $dog->activity_level = $request->input('activity_level');
            $dog->friend_level = $request->input('friend_level');
            $dog->train_level = $request->input('train_level');
            $dog->health_level = $request->input('health_level');
            $dog->save();

            // Return response
            return Response::json( array(
                'message' => 'Dog created successfully',
                'dog_id' => $dog->id
            ), 200);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

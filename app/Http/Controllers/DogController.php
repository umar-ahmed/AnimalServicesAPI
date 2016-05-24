<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Http\Requests;
use App\Dog;

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
        //
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use App\Http\Requests;
use App\User;
use Response;
use Validator;
use Hash;

class AccountController extends Controller
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
            $id = Authorizer::getResourceOwnerId();
            $user = User::where('id', $id)->get();

            if ( sizeof($user) == 0) {
                array_push($response, [
                    'message' => "Not Found", 
                    'documentation_url' => "https://github.com/umar-ahmed/AnimalServicesAPI"
                ]);
                $statusCode = 404;
            } else {
                array_push($response, $user);
            }
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return Response::json($response[0], $statusCode);
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
        //
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use App\User;
use Validator;
use Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:5',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Response::json( array(
                'message' => 'Malformed request.',
                'error_description' => $validator->errors()->all()
            ), 409);
        } else {

            // Store data
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->password = Hash::make($request->input('password'));
            $user->save();

            // Return response
            return Response::json( array(
                'message' => 'User created successfully',
                'client_id' => 'f3d259ddd3ed8ff3843839b',
                'client_secret' => '4c7f6f8fa93d59c45502c0ae8c4a95b'
            ), 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {

        try {
            $statusCode = 200;
            $response = [];

            // Selection
            $users = User::where('username', $username)->get();

            if ( sizeof($users) == 0) {
                array_push($response, [
                    'message' => "Not Found", 
                    'documentation_url' => "https://github.com/umar-ahmed/AnimalServicesAPI"
                ]);
                $statusCode = 404;
            } else {

                foreach($users as $user) {

                    array_push($response, [
                        'name' => $user->name,
                        'email' => $user->email,
                        'username' => $user->username,
                    ]);
                }
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

<?php

namespace App\Http\Controllers;

use Auth;


class OAuthController extends Controller
{
	public function verify($username, $password){
		$credentials = [
			'email' => $username,
			'password' => $password,
		];

		if (Auth::once($credentials)) {
			return Auth::user()->id;
		} else {
			return false;
		}
	}
}

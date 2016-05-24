<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use OAuth2\HttpFoundationBridge\Request as OAuthRequest;

class OAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if (!$request->input('access_token')) {
            return response('Token not found', 422);
        }

        $req = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

        $bridgedRequest = OAuthRequest::createFromRequest($req);

        $bridgedResponse = new \OAuth2\HttpFoundationBridge\Response();


        if (!$token = App::make('oauth2')->getAccessTokenData($bridgedRequest, $bridgedResponse)) {

            $response = App::make('oauth2')->getResponse();

            if ($response->isClientError() && $response->getParameter('error')) {

                if ($response->getParameter('error') == 'expired_token') {

                    return response('Invalid Token', 422);

                }
            }
        } else {

            $request['user_id'] = $token['user_id'];

        }

        return $next($request);

    }
}

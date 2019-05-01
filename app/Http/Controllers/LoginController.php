<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $http = new \GuzzleHttp\Client();
        $arrayFormParams = [
            'grant_type' => 'password',
            'client_id' => env("ID_CLIENT"),
            'client_secret' => env("CLIENT_SECRET"),
            'username' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        try
        {
            $response = $http->post("http://localhost/api/public/oauth/token", [
                'form_params' => $arrayFormParams
            ]);
            return $response;
        }
        catch(Exception $e)
        {
            return response()->json($e->getMessage());
        }
    }

    public function refreshTokenClient(LoginRequest $request)
    {
        $http = new \GuzzleHttp\Client();
        $arrayFormParams = [
            'grant_type' => 'refresh_token',
            'client_id' => env("ID_CLIENT"),
            'client_secret' => env("CLIENT_SECRET"),
            'refresh_token' => $request->get( 'refresh_token'),
            "scope" => "",
        ];
        try
        {
            $response = $http->post("http://localhost/api/public/oauth/token", [
                'form_params' => $arrayFormParams
            ]);
            return $response;
        }
        catch(Exception $e)
        {
            return response()->json($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try
        {
            $request->user()->token()->revoke();
            return response()->json(null, 401);
        }
        catch(Exception $e)
        {
            return response()->json($e->getMessage());
        }
    }
}

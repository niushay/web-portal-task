<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class AuthenticationController extends Controller
{
    public function showLogin(Request $request)
    {
        return view('auth.login');
    }

    public function login()
    {
        $client = new Client();
        try{
            $response = $client->request('post', 'https://api.baubuddy.de/index.php/login', [
                'headers' => [
                    'Authorization' => 'Basic QVBJX0V4cGxvcmVyOjEyMzQ1NmlzQUxhbWVQYXNz',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'username' => "365",
                    'password' => "1",
                ]
            ]);
        }catch (ClientException $e){
            return response()->json([
                'success' => false,
                'error' => $e->getResponse()
            ]);
        }

        $token = json_decode($response->getBody())->oauth->access_token;

        // Save the token to the session
        session(['auth-token' => $token]);

        return redirect()->route('index');
    }

}

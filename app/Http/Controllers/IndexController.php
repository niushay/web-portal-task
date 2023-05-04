<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class IndexController extends Controller
{
    public function index()
    {
        $data = $this->getData();
        return view('index', compact('data'));
    }

    public function getData()
    {
        $client = new Client();
        $auth_token = session('auth-token');
        $response = null;

        try{
            $response = $client->request('GET', 'https://api.baubuddy.de/dev/index.php/v1/tasks/select', [
                'headers' => [
                    'Authorization' => 'Bearer '.$auth_token,
                    'Content-Type' => 'application/json',
                ]
            ]);
        }catch (ClientException $e){
            if($e->getResponse()->getStatusCode() === 401){
                session()->forget('auth-token');
                return redirect()->route('loginPage');
            }
        }

        return json_decode($response->getBody());
    }

    public function refreshData()
    {
        $data = $this->getData();
        return view('partials.data-table', compact('data'));
    }
}

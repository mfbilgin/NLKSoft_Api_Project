<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $client;
    const API_URL = 'http://localhost:8080/api/auth';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function login($data)
    {
        $response = $this->client->post(self::API_URL . '/login', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function register($data)
    {
        Log::info($data);
        $response = $this->client->post(self::API_URL . '/register', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function logout()
    {
        $this->client->post(self::API_URL . '/logout', [
            'headers' => [
                'Authorization' => 'Bearer '. \request()->cookie('token'),
                'Accept' => 'application/json',
            ]
        ]);
    }
}

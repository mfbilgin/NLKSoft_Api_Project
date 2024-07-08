<?php

namespace App\Services;

use GuzzleHttp\Client;

class ProductService
{
    protected $client;
    const API_URL = 'http://localhost:8080/api/products';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getAllProducts(int $per_page = 10, int $page = 1)
    {
        $response = $this->client->get(self::API_URL, [
            'headers' => [
                'Authorization' => 'Bearer ' . \request()->cookie('token'),
                'Accept' => 'application/json',
            ],
            'json' => [
                'per_page' => $per_page,
                'page' => $page
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getProductById($id)
    {
        $response = $this->client->get(self::API_URL.'/'.$id, [
            'headers' => [
                'Authorization' => 'Bearer ' . \request()->cookie('token'),
                'Accept' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function create_product($data)
    {
         $this->client->post(self::API_URL, [
            'headers' => [
                'Authorization' => 'Bearer ' . \request()->cookie('token'),
                'Accept' => 'application/json',
            ],
            'json' => $data
        ]);

    }

    public function delete_product($id)
    {
        $this->client->delete(self::API_URL . '/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . \request()->cookie('token'),
                'Accept' => 'application/json'
            ]
        ]);
    }

    public function update_product($id,$data)
    {
        $this->client->put(self::API_URL . '/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . \request()->cookie('token'),
                'Accept' => 'application/json',
            ],
            'json' => $data
        ]);
    }
}

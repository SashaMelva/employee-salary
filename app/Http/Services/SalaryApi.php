<?php

namespace App\Http\Servises;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SalaryApi
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://0.0.0.0']);
    }

    /**
     * @throws GuzzleException
     */
    public function get(string $model)
    {
        $response = $this->client->get($this->uri($model));
        return $response->getBody();
    }
    /**
     * @throws GuzzleException
     */
    public function post(array $validData, string $model): void
    {
        $response = $this->client->post(
            $this->uri($model),
            [
                'headers' => [
                    'Accept' => 'application/json'
                ],

                'json' => $validData
            ]
        );

        $response->getBody();
    }

    /**
     * @throws GuzzleException
     */
    public function delete(int $id, string $model): void
    {
        $this->client->delete(
            $this->uri($model) . "/$id"
        );
    }

    /**cr
     * @throws GuzzleException
     */
    public function put(int $id, array $validData, string $model): void
    {
        $this->client->put(
            $this->uri($model) . "/$id",
            [
                'json' => $validData
            ]
        );
    }

    private function uri(string $model): string
    {
        return '/api/' . $model;
    }
}

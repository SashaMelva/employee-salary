<?php

namespace App\Http\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SalaryApi
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api_for_salary.happy.tatar']);
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function get(string $model)
    {
        $response = $this->client->get($this->uri($model));
        return $this->checkStatutoryApi($response->getBody());
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function getWithId(string $model, string $id)
    {
        $employees = $this->get($model);
        $employee = [];

        foreach ($employees as $employeeApi) {
            if ($employeeApi['id'] == $id) {
                $employee = $employeeApi;
            }
        }
        return $employee;
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function post(array $validData, string $model)
    {
        try {
            $response = $this->client->post(
                $this->uri($model),
                [
                    'headers' => [
                        'Accept' => 'application/json'
                    ],

                    'json' => $validData
                ]
            );
            return $this->checkStatutoryApi($response->getBody());

        } catch (Exception $exception) {
            if ($exception->getCode() == 422) {
                return ['message' => explode('"', $exception->getMessage())[3]];
            }
            throw new Exception($exception->getMessage());
        }
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
     * @throws Exception
     */
    public function put(int $id, array $validData, string $model): void
    {
        try {
            $this->client->put(
                $this->uri($model) . "/$id",
                [
                    'json' => $validData
                ]
            );

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    private function uri(string $model): string
    {
        return '/api/' . $model;
    }

    /**
     * @throws Exception
     */
    private function checkStatutoryApi($response)
    {
        $decodeResponse = json_decode($response, true);

        if ($decodeResponse['success']) {
            return $decodeResponse['data'];
        }

        throw new Exception("Request for Api filed");
    }
}

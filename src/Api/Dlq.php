<?php

namespace DiagVN\Dlq\Api;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Dlq
{
    private Client $client;

    public function __construct()
    {
        $this->client = $this->initClient();
    }

    public function send(array $params): array
    {
        $options[RequestOptions::JSON] = $params;
        $response = $this->client->post('api/dlq', $options);
        return json_decode($response, true);
    }

    private function initClient(): Client
    {
        return new Client([
            'connect_timeout' => config('dlq.timeout'),
            'base_uri' => config('dlq.dlq_domain'),
            'headers' => [
                'Authorization' => 'Bearer ' . config('dlq.dlq_api_key'),
            ],
            'verify' => false,
        ]);
    }
}

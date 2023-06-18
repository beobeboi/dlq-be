<?php

namespace DiagVN\Dlq\Api;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Dlq
{
    public function __construct(private readonly Client $client)
    {

    }

    public function send(array $params): array
    {
        $options[RequestOptions::JSON] = $params;
        $response = $this->client->post('/api/dlq', $options);
        return json_decode($response, true);
    }
}

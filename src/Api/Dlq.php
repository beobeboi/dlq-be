<?php

namespace DiagVN\Dlq\Api;

use GuzzleHttp\Client;

class Dlq
{
    public function __construct(private readonly Client $client)
    {

    }

    public function send(array $params): array
    {
        $options['json'] = $params;
        $response = $this->client->post('/api/dlq', $options);
        return json_decode($response, true);
    }
}

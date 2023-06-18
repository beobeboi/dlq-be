<?php

namespace DiagVN\Dlq;

use DiagVN\Dlq\Api\Dlq;

class DlqService
{
    public function __construct(private readonly Dlq $dlq)
    {

    }

    public function store(string $key, string $topic, array $body): array
    {
        return $this->dlq->send([
            'key' => $key,
            'topic' => $topic,
            'body' => $body,
        ]);
    }
}
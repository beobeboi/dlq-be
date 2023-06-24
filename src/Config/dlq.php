<?php
return [
    'dlq_domain' => env('DQL_DOMAIN', env('DIAG_API_URL', '')),
    'dlq_api_key' => env('DQL_API_KEY', ''),
    'dql_timeout' => env('DLQ_TIMEOUT', 3),
];

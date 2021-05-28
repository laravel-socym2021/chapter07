<?php

return [
    'hosts' => [
        // elasticsearchのhostを環境に合わせて指定してください
        env('ELASTICSEARCH_HOST', '127.0.0.1:9200'),
    ]
];

<?php //-->

return [
    'sql-build' => [
        'host' => '<DATABASE HOST>',
        'user' => '<DATABASE USER>',
        'pass' => '<DATABASE PASS>'
    ],
    'sql-main' => [
        'host' => '<DATABASE HOST>',
        'name' => '<DATABASE NAME>',
        'user' => '<DATABASE USER>',
        'pass' => '<DATABASE PASS>'
    ],
    'elastic-main' => [
        '<ELASTIC HOST:PORT>'
    ],
    'redis-main' => [
        'scheme' => 'tcp',
        'host' => '127.0.0.1',
        'port' => 6379
    ],
    'rabbitmq-main' => [
        'host' => '127.0.0.1',
        'port' => 5672,
        'user' => '<RABBIT USER>',
        'pass' => '<RABBIT PASS>'
    ],
    's3-main' => [
        'region' => '<AWS REGION>',
        'token' => '<AWS TOKEN>',
        'secret' => '<AWS SECRET>',
        'bucket' => '<S3 BUCKET>',
        'host' => 'https://<AWS REGION>.amazonaws.com'
    ],
    'mail-main' => [
        'host' => 'smtp.gmail.com',
        'port' => '587',
        'type' => 'tls',
        'name' => 'Project Name',
        'user' => '<EMAIL ADDRESS>',
        'pass' => '<EMAIL PASSWORD>'
    ],
    'captcha-main' => [
        'token' => '<GOOGLE CAPTCHA TOKEN>',
        'secret' => '<GOOGLE CAPTCHA SECRET>'
    ]
];

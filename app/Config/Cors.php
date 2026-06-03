<?php

namespace Config;

use CodeIgniter\Config\Cors as BaseCors;

class Cors extends BaseCors
{
    public array $default = [
        'allowedOrigins'     => ['https://web-five-sable-74.vercel.app'],
        'allowedOriginsPatterns' => [],
        'supportsCredentials' => false,
        'allowedHeaders'     => ['Content-Type', 'Authorization'],
        'exposedHeaders'     => [],
        'allowedMethods'     => ['GET', 'POST', 'OPTIONS'],
        'maxAge'             => 7200,
    ];
}

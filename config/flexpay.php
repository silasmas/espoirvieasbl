<?php

return [
    /*
    |--------------------------------------------------------------------------
    | FlexPay API
    |--------------------------------------------------------------------------
    | Documentation: Payment Service (type 1 = mobile money, type 2 = carte bancaire)
    | Header: Authorization: Bearer {token}
    | Body: merchant, type, reference, phone, amount, currency, callbackUrl
    |
    | Variables .env supportées :
    | - FLEXPAY_MERCHANT ou FLEXPAY_MARCHAND (marchand)
    | - FLEXPAY_TOKEN ou FLEXPAY_API_TOKEN
    | - FLEXPAY_GATEWAY_MOBILE (URL complète payment) ou FLEXPAY_API_URL (base)
    | - FLEXPAY_GATEWAY_CHECK (URL base check) ou déduit de api_url
    */
    'enabled' => filter_var(env('FLEXPAY_ENABLED', false), FILTER_VALIDATE_BOOLEAN),
    'api_url' => rtrim(trim(env('FLEXPAY_API_URL', 'http://localhost:8080')), '/'),
    'gateway_mobile' => rtrim(trim(env('FLEXPAY_GATEWAY_MOBILE', '')), '/'),
    'gateway_check' => rtrim(trim(env('FLEXPAY_GATEWAY_CHECK', '')), '/'),
    'gateway_card' => rtrim(trim(env('FLEXPAY_GATEWAY_CARD', '')), '/'),
    'token' => env('FLEXPAY_TOKEN', env('FLEXPAY_API_TOKEN', '')),
    'merchant' => env('FLEXPAY_MERCHANT', env('FLEXPAY_MARCHAND', '')),
];

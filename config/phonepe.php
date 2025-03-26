<?php

return [
    'merchant_id' => env('PHONEPE_MERCHANT_ID', 'your_merchant_id'),
    'salt_key' => env('PHONEPE_SALT_KEY', 'your_salt_key'),
    'salt_index' => env('PHONEPE_SALT_INDEX', 'your_salt_index'),
    'environment' => env('PHONEPE_ENV', 'UAT'), // UAT for testing, PRODUCTION for live
];

<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Konfigurasi Midtrans
    |--------------------------------------------------------------------------
    |
    | File ini digunakan untuk mengatur kredensial Midtrans yang diambil dari
    | file .env agar mudah diubah tanpa perlu mengedit kode.
    |
    */

    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => true,
    'is_3ds' => true,
];

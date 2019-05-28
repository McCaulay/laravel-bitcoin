<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Bitcoin Username
    |--------------------------------------------------------------------------
    |
    | The RPC username of the bitcoin server.
    |
     */
    'username' => env('BITCOIN_USERNAME'),

    /*
    |--------------------------------------------------------------------------
    | Bitcoin Password
    |--------------------------------------------------------------------------
    |
    | The RPC password of the bitcoin server.
    |
     */
    'password' => env('BITCOIN_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Bitcoin Host
    |--------------------------------------------------------------------------
    |
    | The host name of the bitcoin server which the RPC is running on.
    |
     */

    'host' => env('BITCOIN_HOST', 'localhost'),

    /*
    |--------------------------------------------------------------------------
    | Bitcoin Port
    |--------------------------------------------------------------------------
    |
    | The port number the RPC service is running on.
    |
     */
    'port' => env('BITCOIN_PORT', 8332),

    /*
    |--------------------------------------------------------------------------
    | Bitcoin Secure
    |--------------------------------------------------------------------------
    |
    | If the RPC connection uses SSL. (HTTPS)
    |
     */
    'secure' => env('BITCOIN_SECURE', false),

];

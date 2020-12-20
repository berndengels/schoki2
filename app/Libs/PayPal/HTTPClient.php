<?php
namespace App\Libs\PayPal;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class HTTPClient
{
    protected $client;
    protected $config = [];
    protected $base_uri = '';
    protected $headers = [
        'Accept'     => 'application/json',
    ];

    public function __construct()
    {
        $this->client = new Client();
    }
}

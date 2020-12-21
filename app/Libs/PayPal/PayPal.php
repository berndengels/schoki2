<?php
namespace App\Libs\PayPal;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Client as HttpClient;
use Srmklive\PayPal\Traits\PayPalHttpClient;

class PayPal
{
    use PayPalHttpClient;

    protected $mode = 'sandbox';
    protected $success_url;
    protected $cancel_url;
    protected $access_token;
    protected $expires_in;
    protected $headers = [
        'Content-Type'  => 'application/x-www-form-urlencoded',
        'Accept'        => 'application/json',
    ];
    protected $config = [
        'timeout'         => 30,
        'allow_redirects' => true,
    ];
    /**
     * @var Client
     */
    protected $client;
    protected $credentials;
    private $validateSSL;
    private $certificate;

    public function __construct()
    {
        $this->mode = config('paypal.mode');
        $this->validateSSL  = config('paypal.validate_ssl');
        $this->certificate  = config('paypal.certificate');
        $this->credentials  = config('paypal.'.$this->mode);
        $this->success_url  = route('payment.paypal.success');
        $this->cancel_url   = route('payment.paypal.cancel');
        $this->setHttpClientConfiguration();
    }

    protected function checkToken()
    {
        $ts     = Carbon::now()->timestamp;
        $token  = session()->get('paypal', null);
        $expired = ($token && $ts > ($token['ts'] + $token['expires_in'])) ?? false;

        if(!$token || $expired) {
            $this->setToken();
        }
    }

    public function setToken()
    {
        $response = $this->client->post('/v1/oauth2/token',[
            'headers'   => $this->headers,
            'form_params' => [
                'grant_type' => 'client_credentials',
            ]
        ])->getBody()->getContents();

        $response = json_decode($response);
        $this->access_token = $response->access_token;
        $this->expires_in   = $response->expires_in;
        $data = ['paypal' => [
            'access_token'  => $response->access_token,
            'expires_in'    => $response->expires_in,
            'ts'            => Carbon::now()->timestamp,
        ]];
        session($data);
    }

    /**
     * Function to initialize Http Client.
     *
     * @return void
     */
    protected function setClient()
    {
        $this->config += [
            'auth' => [$this->credentials['client_id'], $this->credentials['client_secret']],
            'curl' => $this->httpClientConfig,
        ];
        dd($this->config);
        $this->client = new HttpClient($this->config);
    }

    public function doRequest(string $path, array $data, array $headers = null)
    {
        $response = $this->client->post($path,[
            'headers' => $this->headers + ($headers ?? []),
            $data,
        ])->getBody()->getContents();

        return json_decode($response);
    }
}

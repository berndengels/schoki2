<?php
namespace App\Libs\PayPal;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Http\Request;
use Srmklive\PayPal\Traits\PayPalHttpClient;
use function PHPUnit\Framework\throwException;

class PayPal
{
    use PayPalHttpClient;

    protected $mode = 'sandbox';
    protected $access_token;
    protected $expires_in;
    protected $headers = [
        'Content-Type'  => 'application/json',
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
    protected $paymentAction;
    private $tapMiddleware;
    private $httpClientConfig;

    public function __construct()
    {
        $this->mode = config('paypal.mode');
        $this->validateSSL  = config('paypal.validate_ssl');
        $this->certificate  = config('paypal.certificate');
        $this->credentials  = config('paypal.'.$this->mode);
        $this->config['api_url']    = config('paypal.'.$this->mode.'.api_url');
        $this->config['base_uri']   = $this->config['api_url'];
        $this->config['notify_url'] = config('paypal.notify_url');
        $this->paymentAction = config('paypal.payment_action');
        $this->setHttpClientConfiguration();
        $this->checkToken();
    }

    protected function checkToken()
    {
        $ts         = Carbon::now()->timestamp;
        $token      = session()->get('paypal', null);
        $expired    = ($token && $ts > ($token['ts'] + $token['expires_in'])) ?? false;

        if(!$token || $expired) {
            $this->setToken();
        }
    }

    public function setToken()
    {
        $this->setClient(['Content-Type'  => 'application/x-www-form-urlencoded']);
        $response = $this->client->post('/v1/oauth2/token',[
            'headers'   => ['Content-Type'  => 'application/x-www-form-urlencoded'],
            'form_params' => ['grant_type' => 'client_credentials']
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
    protected function setClient(array $headers = null)
    {
        $handler = new CurlHandler();
        $stack = HandlerStack::create($handler);
        $this->config += [
            'handler'   => $stack,
            'auth'      => [$this->credentials['client_id'], $this->credentials['client_secret']],
            'curl'      => $this->httpClientConfig + [CURLOPT_VERBOSE => 1],
            'headers'   => $headers ?? $this->headers,
//            'debug'     => true,
        ];
        $this->client = new HttpClient($this->config);
/*
        $this->tapMiddleware = Middleware::tap(function ($request) {
            echo $request->getHeaderLine('Content-Type').'<br>';
            // application/json
            echo $request->getBody().'<br>';
            // {"foo":"bar"}
        });
*/
    }

    protected function getAuthHeader()
    {
        return ['Authorization' => 'Bearer '.$this->access_token];
    }

    protected function getRepresentationHeader()
    {
        return ['Prefer' => 'return=representation'];
    }

    public function doRequest(string $path, array $data)
    {
        try {
            $response = $this->client->post($path,[
                'headers'   => $this->headers,
                'json'      => $data,
            ])->getBody()->getContents();
            return json_decode($response);
        } catch(Exception $e) {
             throw new Exception($e);
        }
    }

    public function checkout(array $data, $verbose = true) {
        $path = '/v2/checkout/orders';
        $this->headers += $this->getAuthHeader();
        if($verbose) {
            $this->headers += $this->getRepresentationHeader();
        }
        return $this->doRequest( $path, $data );
    }

    private function setDefaultValues()
    {
        // Set default payment action.
        if (empty($this->paymentAction)) {
            $this->paymentAction = 'Sale';
        }

        // Set default locale.
        if (empty($this->locale)) {
            $this->locale = 'de_DE';
        }

        // Set default value for SSL validation.
        if (empty($this->validateSSL)) {
            $this->validateSSL = false;
        }
    }
}

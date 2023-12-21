<?php

namespace Core45\LaravelBaselinker\Baselinker;

use Illuminate\Support\Facades\Http;

class LaravelBaselinker
{
    private $debug;
    private $verify;
    private string $url = 'https://api.baselinker.com/connector.php';
    private string $token;

    public function __construct()
    {
        $this->token = config('baselinker.token');
        $this->debug = config('baselinker.debug');
        $this->verify = config('baselinker.verify');
    }

    protected function makeRequest(array $parameters): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return Http::withOptions([
            'debug' => $this->debug,
            'verify' => $this->verify,
        ])->withHeaders([
            'X-BLToken' => $this->token,
        ])->asForm()->post($this->url, $parameters);
    }
}

<?php
namespace Mccaulay\Bitcoin\Api;

use GuzzleHttp\Client;

class Api
{
    /**
     * The Guzzle client.
     *
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * The bitcoin configuration.
     *
     * @var array
     */
    private $config;

    /**
     * Initialise the Api
     */
    public function __construct()
    {
        // Initalise the config
        $this->config = config('bitcoin');

        // Initalise the guzzle client
        $this->client = new Client([
            'base_uri' => $this->getBaseUri(),
        ]);
    }

    /**
     * Get the base uri of the RPC connection.
     * Example: https://rpcuser:rpcpassword@localhost:8332/
     *
     * @return string
     */
    private function getBaseUri()
    {
        $baseUri = $this->config['secure'] ? 'https://' : 'http://';
        $baseUri .= $this->config['username'] . ':' . $this->config['password'];
        $baseUri .= '@' . $this->config['host'] . ':' . $this->config['port'];
        $baseUri .= '/';
        return $baseUri;
    }

    /**
     * Perform a request to the rpc service.
     *
     * @param string $method
     * @param array $params
     * @return mixed
     */
    protected function request(string $method, array $params)
    {
        $response = $this->client->post('/', [
            'json' => [
                'method' => strtolower($method),
                'params' => $params,
            ],
        ]);
        $contents = (string) $response->getBody();
        return json_decode($contents);
    }
}

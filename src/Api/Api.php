<?php
namespace McCaulay\Bitcoin\Api;

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
     * If the response format should be in array or object form.
     *
     * @var boolean
     */
    private $responseArray;

    /**
     * The api path.
     *
     * @var string
     */
    private $path;

    /**
     * Initialise the Api
     */
    public function __construct()
    {
        $this->responseArray = true;
        $this->path = '/';

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
    private function getBaseUri(): string
    {
        $baseUri = $this->config['secure'] ? 'https://' : 'http://';
        $baseUri .= $this->config['username'] . ':' . $this->config['password'];
        $baseUri .= '@' . $this->config['host'] . ':' . $this->config['port'];
        $baseUri .= '/';
        return $baseUri;
    }

    /**
     * Set the path of the api.
     *
     * @return self
     */
    private function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Perform a request to the rpc service.
     *
     * @param string $method
     * @param array $params
     * @return mixed
     */
    protected function request(string $method, array $params = [])
    {
        $response = $this->client->post($this->path, [
            'json' => [
                'method' => strtolower($method),
                'params' => $params,
            ],
        ]);
        $contents = (string) $response->getBody();
        $contents = json_decode($contents, $this->responseArray);
        return $this->responseArray ? $contents['result'] : $contents->result;
    }
}

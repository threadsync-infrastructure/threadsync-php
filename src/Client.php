<?php
namespace ThreadSync;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;

class Client
{
    private HttpClient $http;
    public readonly Connections $connections;
    public readonly Sync $sync;

    public function __construct(string $bearerToken, string $baseUrl = 'https://api.threadsync.io/v1')
    {
        $this->http = new HttpClient([
            'base_uri' => $baseUrl,
            'headers' => [
                'Authorization' => "Bearer {$bearerToken}",
                'Content-Type' => 'application/json',
                'User-Agent' => 'threadsync-php/0.1.0',
            ],
        ]);
        $this->connections = new Connections($this);
        $this->sync = new Sync($this);
    }

    public function request(string $method, string $path, ?array $body = null): array
    {
        $options = [];
        if ($body !== null) {
            $options['json'] = $body;
        }
        $response = $this->http->request($method, $path, $options);
        return json_decode($response->getBody()->getContents(), true);
    }
}

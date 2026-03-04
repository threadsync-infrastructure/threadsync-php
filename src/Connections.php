<?php
namespace ThreadSync;

use ThreadSync\Models\Connection;

class Connections
{
    public function __construct(private Client $client) {}

    /**
     * Create a new connection for a given provider.
     */
    public function create(string $provider): Connection
    {
        $data = $this->client->request('POST', '/connections', ['provider' => $provider]);
        return Connection::fromArray($data);
    }

    /**
     * Retrieve a connection by ID.
     */
    public function get(string $id): Connection
    {
        $data = $this->client->request('GET', "/connections/{$id}");
        return Connection::fromArray($data);
    }

    /**
     * List all connections.
     *
     * @return Connection[]
     */
    public function list(): array
    {
        $data = $this->client->request('GET', '/connections');
        return array_map(fn(array $item) => Connection::fromArray($item), $data);
    }
}

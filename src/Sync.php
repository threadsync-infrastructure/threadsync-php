<?php
namespace ThreadSync;

use ThreadSync\Models\SyncConfig;
use ThreadSync\Models\SyncResult;

class Sync
{
    public function __construct(private Client $client) {}

    /**
     * Create a new sync job from the provided SyncConfig.
     */
    public function create(SyncConfig $config): SyncResult
    {
        $data = $this->client->request('POST', '/syncs', [
            'source'      => [
                'connection' => $config->source->connection,
                'object'     => $config->source->object,
                'table'      => $config->source->table,
            ],
            'destination' => [
                'connection' => $config->destination->connection,
                'object'     => $config->destination->object,
                'table'      => $config->destination->table,
            ],
            'schedule'    => $config->schedule,
        ]);
        return SyncResult::fromArray($data);
    }

    /**
     * Retrieve a sync result by ID.
     */
    public function get(string $id): SyncResult
    {
        $data = $this->client->request('GET', "/syncs/{$id}");
        return SyncResult::fromArray($data);
    }
}

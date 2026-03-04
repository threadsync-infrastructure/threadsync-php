<?php
namespace ThreadSync\Models;

class SyncResult
{
    public function __construct(
        public readonly string $id,
        public readonly string $status,
        public readonly ?int $recordsSynced = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id:            $data['id'],
            status:        $data['status'],
            recordsSynced: $data['records_synced'] ?? null,
        );
    }
}

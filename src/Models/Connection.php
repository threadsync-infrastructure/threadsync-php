<?php
namespace ThreadSync\Models;

class Connection
{
    public function __construct(
        public readonly string $id,
        public readonly string $provider,
        public readonly string $name,
        public readonly string $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id:       $data['id'],
            provider: $data['provider'],
            name:     $data['name'],
            status:   $data['status'],
        );
    }
}

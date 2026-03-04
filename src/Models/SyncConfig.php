<?php
namespace ThreadSync\Models;

class SyncConfig
{
    public function __construct(
        public readonly Endpoint $source,
        public readonly Endpoint $destination,
        public readonly string $schedule,
    ) {}
}

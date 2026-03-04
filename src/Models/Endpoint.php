<?php
namespace ThreadSync\Models;

class Endpoint
{
    public function __construct(
        public readonly string $connection,
        public readonly ?string $object = null,
        public readonly ?string $table = null,
    ) {}
}

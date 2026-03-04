# ThreadSync PHP SDK

[![Packagist Version](https://img.shields.io/packagist/v/threadsync/threadsync-php)](https://packagist.org/packages/threadsync/threadsync-php)
[![PHP Version](https://img.shields.io/packagist/php-v/threadsync/threadsync-php)](https://packagist.org/packages/threadsync/threadsync-php)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

Official PHP SDK for the [ThreadSync API](https://threadsync.io). Sync data between any two platforms — CRMs, databases, data warehouses, and more — with a few lines of code.

## Requirements

- PHP 8.1 or higher
- Composer

## Installation

```bash
composer require threadsync/threadsync-php
```

## Quick Start

```php
<?php
require 'vendor/autoload.php';

use ThreadSync\Client;
use ThreadSync\Models\SyncConfig;
use ThreadSync\Models\Endpoint;

$client = new Client('your-api-key');

// Create connections
$source = $client->connections->create('salesforce');
$destination = $client->connections->create('snowflake');

// Build a sync
$config = new SyncConfig(
    source: new Endpoint(connection: $source->id, object: 'Contact'),
    destination: new Endpoint(connection: $destination->id, table: 'contacts'),
    schedule: '0 * * * *',   // every hour
);

$sync = $client->sync->create($config);
echo "Sync created: {$sync->id} — status: {$sync->status}\n";

// List all connections
$connections = $client->connections->list();
foreach ($connections as $conn) {
    echo "{$conn->id}: {$conn->provider} ({$conn->status})\n";
}
```

## API Reference

### `Client`

```php
$client = new Client(string $bearerToken, string $baseUrl = 'https://api.threadsync.io/v1');
```

### `Connections`

| Method | Description |
|--------|-------------|
| `create(string $provider): Connection` | Create a new connection |
| `get(string $id): Connection` | Retrieve a connection by ID |
| `list(): Connection[]` | List all connections |

### `Sync`

| Method | Description |
|--------|-------------|
| `create(SyncConfig $config): SyncResult` | Create a new sync job |
| `get(string $id): SyncResult` | Retrieve a sync result by ID |

### Models

- **`Connection`** — `id`, `provider`, `name`, `status`
- **`Endpoint`** — `connection`, `object`, `table`
- **`SyncConfig`** — `source` (Endpoint), `destination` (Endpoint), `schedule`
- **`SyncResult`** — `id`, `status`, `recordsSynced`

## License

MIT — see [LICENSE](LICENSE) for details.

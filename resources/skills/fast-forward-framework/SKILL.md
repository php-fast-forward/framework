---
name: fast-forward-framework
description: Compose a Fast Forward application container, resolve HTTP, event and clock services, and diagnose missing or conflicting configuration.
license: MIT; see LICENSE
compatibility: Supports fast-forward/framework ^1.5 and PHP ^8.3. Requires Composer and declared extensions; inspect the installed version. Earlier releases are outside this contract.
metadata:
  author: Fast Forward
  api-baseline: fast-forward/framework ^1.5
---

# Bootstrap the Fast Forward framework

Use this skill for an application consuming `fast-forward/framework:^1.5`.
Read its instructions, manifest/lockfile and installed source before editing.
Run `composer show fast-forward/framework`. For versions outside this contract,
inspect matching documentation; do not silently upgrade the application.

## First working integration

Requires PHP ^8.3, Composer's application autoloader and this package's runtime
dependencies.
With authority to install the dependency:

```sh
composer require 'fast-forward/framework:^1.5'
```

Create `app.php` in the application root alongside composer.json/vendor:

```php
<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use FastForward\Config\ArrayConfig;
use FastForward\Container\ContainerInterface;
use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
use Psr\Clock\ClockInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use function FastForward\Container\container;

$config = new ArrayConfig([ContainerInterface::class => [FrameworkServiceProvider::class]]);
$container = container($config);
$response = $container->get(ResponseFactoryInterface::class)->createResponse(201);
if ($response->getStatusCode() !== 201
    || !$container->get(ClockInterface::class)->now() instanceof DateTimeImmutable
    || !$container->get(EventDispatcherInterface::class) instanceof EventDispatcherInterface) {
    throw new RuntimeException('Framework services were not composed.');
}

echo "integration ready\n";
```

Run `php app.php`. It throws on a wrong result; success prints
`integration ready`. It uses no production data and starts no server.

## Wiring and failure boundaries

The raw provider list is keyed by `FastForward\Container\ContainerInterface::class` in the ArrayConfig passed to `container($config)`. It is exposed as `config.FastForward\Container\ContainerInterface`; the PSR-11 interface is a different key. Do not pass an array to the variadic container helper. The provider composes HTTP, Event Dispatcher and Clock; it does not install an HTTP server, router, cache, logger or middleware pipeline.

For a provider-only bootstrap, call `container(FrameworkServiceProvider::class)`. Use ArrayConfig when the event integration needs listener configuration. Inject the resulting PSR-11 container into the application's own runtime; obtaining a response does not emit it. HTTP Message, HTTP Factory and HTTP Client arrive transitively through HTTP.

For application overrides put an explicit ArrayServiceProvider first in the helper's arguments, ahead of the configured/default providers. Aggregate source lookup uses the first successfully resolving source; it does not recursively merge factories across separate sources. Services created by ServiceProviderContainer are cached. A missing id raises a PSR-11 not-found exception; an existing factory can still fail at get(), so has() is not a construction guarantee.

The helper tries aggregate sources in registration order. A PSR container or
not-found exception from one source permits fallback to another source; other
throwables propagate. Source priority is therefore the first successful resolution,
not a guarantee that an earlier broken factory terminates lookup. Nested provider
list errors during helper composition are caught; if services are absent, inspect
the raw configuration and resolve the provider directly to diagnose the failure.

## Verify integration

Run the [complete example](examples/integration.php) against the application's
autoloader in a disposable process. It checks success and negative cases:

```sh
php /path/to/fast-forward-framework/examples/integration.php ./vendor/autoload.php
```

Expected final marker: `fast-forward-framework: ok`. Keep application-specific regression
tests in its existing PHPUnit suite, with each fixture class in its same-named
file. File copying, host discovery and completed agent tasks are different checks.
For optional copying/synchronization load
[installation and lifecycle](references/installation.md).

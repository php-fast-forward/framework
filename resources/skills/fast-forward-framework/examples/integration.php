<?php

declare(strict_types=1);

require $argv[1] ?? dirname(__DIR__, 4) . '/vendor/autoload.php';

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
try {
    $container->get('application.missing');
    throw new RuntimeException('Missing service unexpectedly resolved.');
} catch (\Psr\Container\NotFoundExceptionInterface) {
}

echo "fast-forward-framework: ok\n";

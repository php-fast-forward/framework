<?php

namespace FastForward\Framework\ServiceProvider;

use FastForward\Container\ServiceProvider\AggregateServiceProvider;
use FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider;
use FastForward\Http\ServiceProvider\HttpServiceProvider;
use Interop\Container\ServiceProviderInterface;

final class FrameworkServiceProvider implements ServiceProviderInterface
{
    private ServiceProviderInterface $serviceProvider;

    public function __construct()
    {
        $this->serviceProvider = new AggregateServiceProvider(
            new HttpServiceProvider(),
            new EventDispatcherServiceProvider(),
        );
    }

    public function getFactories(): array
    {
        return $this->serviceProvider->getFactories();
    }

    public function getExtensions(): array
    {
        return $this->serviceProvider->getExtensions();
    }
}

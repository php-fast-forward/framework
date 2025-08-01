<?php

declare(strict_types=1);

/**
 * This file is part of php-fast-forward/framework.
 *
 * This source file is subject to the license bundled
 * with this source code in the file LICENSE.
 *
 * @link      https://github.com/php-fast-forward/framework
 * @copyright Copyright (c) 2025 Felipe Sayão Lobato Abreu <github@mentordosnerds.com>
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace FastForward\Framework\ServiceProvider;

use FastForward\Container\ServiceProvider\AggregateServiceProvider;
use FastForward\Http\ServiceProvider\HttpServiceProvider;
use Interop\Container\ServiceProviderInterface;

/**
 * Class FrameworkServiceProvider.
 *
 * Aggregates core framework service providers into a unified service provider.
 * This class MUST be used to encapsulate all foundational service providers
 * required to initialize the application container.
 *
 * The internal aggregation MAY include HTTP, logging, caching, console,
 * event dispatching, session handling, and other service providers required
 * for application infrastructure.
 *
 * This class SHALL implement the ServiceProviderInterface and MUST delegate
 * its service discovery responsibilities to an internal AggregateServiceProvider.
 */
final class FrameworkServiceProvider implements ServiceProviderInterface
{
    /**
     * @var ServiceProviderInterface the aggregate container for framework service providers
     */
    private ServiceProviderInterface $serviceProvider;

    /**
     * Constructs the FrameworkServiceProvider.
     *
     * This constructor MUST initialize the aggregate service provider using
     * a composition of essential framework service providers.
     */
    public function __construct()
    {
        $this->serviceProvider = new AggregateServiceProvider(
            new HttpServiceProvider(),
            // ErrorHandlerServiceProvider,
            // EventDispatcherServiceProvider,
            // LoggerServiceProvider,
            // CacheServiceProvider,
            // ConsoleServiceProvider,
            // TemplateRendererServiceProvider,
            // SecurityServiceProvider,
            // SessionServiceProvider,
            // ...
        );
    }

    /**
     * Returns an array of service factory callables.
     *
     * This method MUST delegate to the internal AggregateServiceProvider and
     * return all service factories required for container instantiation.
     *
     * @return array<string, callable> an associative array of factory callables indexed by service IDs
     */
    public function getFactories(): array
    {
        return $this->serviceProvider->getFactories();
    }

    /**
     * Returns an array of service extension callables.
     *
     * This method MUST delegate to the internal AggregateServiceProvider and
     * return all service extensions used to decorate existing services.
     *
     * @return array<string, callable> an associative array of extension callables indexed by service IDs
     */
    public function getExtensions(): array
    {
        return $this->serviceProvider->getExtensions();
    }
}

<?php

declare(strict_types=1);

/**
 * Fast Forward Framework — a lightweight PHP framework for building modern web applications with a simple and elegant API.
 *
 * This file is part of fast-forward/framework project.
 *
 * @author   Felipe Sayão Lobato Abreu <github@mentordosnerds.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 *
 * @see      https://php-fast-forward.github.io/framework/
 * @see      https://github.com/php-fast-forward/framework
 * @see      https://github.com/php-fast-forward/framework/issues
 * @see      https://datatracker.ietf.org/doc/html/rfc2119
 */

namespace FastForward\Framework\ServiceProvider;

use FastForward\Clock\ServiceProvider\ClockServiceProvider;
use FastForward\Container\ServiceProvider\AggregateServiceProvider;
use FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider;
use FastForward\Http\ServiceProvider\HttpServiceProvider;

/**
 * Aggregates core framework service providers into a unified service provider.
 *
 * This class MUST be used to encapsulate all foundational service providers
 * required to initialize the application container.
 *
 * This class SHALL implement the ServiceProviderInterface and MUST delegate
 * its service discovery responsibilities to an internal AggregateServiceProvider.
 *
 * @see AggregateServiceProvider for composing multiple service providers into one
 * @see HttpServiceProvider for HTTP handling and middleware support
 * @see EventDispatcherServiceProvider for PSR-14 and Symfony-compatible event dispatching
 * @see ClockServiceProvider for time and scheduling utilities
 */
final class FrameworkServiceProvider extends AggregateServiceProvider
{
    /**
     * Creates a new FrameworkServiceProvider instance.
     *
     * This constructor MUST initialize the aggregate service provider using
     * a composition of essential framework service providers.
     */
    public function __construct()
    {
        parent::__construct(
            new HttpServiceProvider(),
            new EventDispatcherServiceProvider(),
            new ClockServiceProvider(),
        );
    }
}

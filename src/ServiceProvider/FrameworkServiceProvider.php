<?php

declare(strict_types=1);

/**
 * This file is part of php-fast-forward/framework.
 *
 * This source file is subject to the license bundled
 * with this source code in the file LICENSE.
 *
 * @copyright Copyright (c) 2025-2026 Felipe Sayão Lobato Abreu <github@mentordosnerds.com>
 * @license   https://opensource.org/licenses/MIT MIT License
 *
 * @see       https://github.com/php-fast-forward/framework
 * @see       https://github.com/php-fast-forward
 * @see       https://datatracker.ietf.org/doc/html/rfc2119
 */

namespace FastForward\Framework\ServiceProvider;

use FastForward\Container\ServiceProvider\AggregateServiceProvider;
use FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider;
use FastForward\Http\ServiceProvider\HttpServiceProvider;

/**
 * Class FrameworkServiceProvider.
 *
 * Aggregates core framework service providers into a unified service provider.
 * This class MUST be used to encapsulate all foundational service providers
 * required to initialize the application container.
 *
 * The current aggregation includes:
 * - {@see HttpServiceProvider} for the HTTP stack
 * - {@see EventDispatcherServiceProvider} for PSR-14 and Symfony-compatible event dispatching
 *
 * This class SHALL implement the ServiceProviderInterface and MUST delegate
 * its service discovery responsibilities to an internal AggregateServiceProvider.
 */
final class FrameworkServiceProvider extends AggregateServiceProvider
{
    /**
     * Constructs the FrameworkServiceProvider.
     *
     * This constructor MUST initialize the aggregate service provider using
     * a composition of essential framework service providers.
     */
    public function __construct()
    {
        parent::__construct(
            new HttpServiceProvider(),
            new EventDispatcherServiceProvider(),
        );
    }
}

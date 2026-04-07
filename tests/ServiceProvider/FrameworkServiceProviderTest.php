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

namespace FastForward\Framework\Tests\ServiceProvider;

use FastForward\Clock\ServiceProvider\ClockServiceProvider;
use FastForward\Container\Factory\ServiceFactory;
use FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider;
use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
use FastForward\Http\ServiceProvider\HttpServiceProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(FrameworkServiceProvider::class)]
final class FrameworkServiceProviderTest extends TestCase
{
    private FrameworkServiceProvider $provider;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->provider = new FrameworkServiceProvider();
    }

    /**
     * @return void
     */
    #[Test]
    public function getFactoriesWillReturnAggregatedServiceProviderFactories(): void
    {
        $eventDispatcherServiceProvider = new EventDispatcherServiceProvider();
        $httpServiceProvider = new HttpServiceProvider();
        $clockServiceProvider = new ClockServiceProvider();

        $expectedFactories = array_merge(
            $httpServiceProvider->getFactories(),
            $eventDispatcherServiceProvider->getFactories(),
            $clockServiceProvider->getFactories(),
            [
                EventDispatcherServiceProvider::class => new ServiceFactory($eventDispatcherServiceProvider),
                ClockServiceProvider::class => new ServiceFactory(new ClockServiceProvider()),
                FrameworkServiceProvider::class => new ServiceFactory($this->provider),
            ]
        );

        $actualFactories = $this->provider->getFactories();

        foreach (array_keys($expectedFactories) as $id) {
            self::assertArrayHasKey($id, $actualFactories);
            self::assertIsCallable($actualFactories[$id]);
        }

        self::assertSameSize($expectedFactories, $actualFactories);
    }

    /**
     * @return void
     */
    #[Test]
    public function getExtensionsWillReturnAggregatedServiceProviderExtensions(): void
    {
        $expectedExtensions = array_merge(
            (new HttpServiceProvider())->getExtensions(),
            (new EventDispatcherServiceProvider())->getExtensions(),
            (new ClockServiceProvider())->getExtensions(),
        );

        $actualExtensions = $this->provider->getExtensions();

        foreach (array_keys($expectedExtensions) as $id) {
            self::assertArrayHasKey($id, $actualExtensions);
            self::assertIsCallable($actualExtensions[$id]);
        }

        self::assertSameSize($expectedExtensions, $actualExtensions);
    }
}

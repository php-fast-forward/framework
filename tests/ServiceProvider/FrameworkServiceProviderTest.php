<?php

declare(strict_types=1);

namespace FastForward\Framework\Tests\ServiceProvider;

use FastForward\Container\Factory\ServiceFactory;
use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
use FastForward\Http\ServiceProvider\HttpServiceProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

#[CoversClass(FrameworkServiceProvider::class)]
final class FrameworkServiceProviderTest extends TestCase
{
    use ProphecyTrait;

    private FrameworkServiceProvider $provider;

    protected function setUp(): void
    {
        $this->provider = new FrameworkServiceProvider();
    }

    public function testGetFactoriesWillReturnHttpServiceProviderFactories(): void
    {
        $expectedFactories = array_merge(
            (new HttpServiceProvider())->getFactories(),
            [FrameworkServiceProvider::class => new ServiceFactory($this->provider)]
        );

        $actualFactories = $this->provider->getFactories();

        foreach ($expectedFactories as $id => $factory) {
            self::assertArrayHasKey($id, $actualFactories);
            self::assertIsCallable($actualFactories[$id]);
        }

        self::assertSameSize($expectedFactories, $actualFactories);
    }

    public function testGetExtensionsWillReturnHttpServiceProviderExtensions(): void
    {
        $expectedExtensions = array_merge(
            (new HttpServiceProvider())->getExtensions(),
        );

        $actualExtensions = $this->provider->getExtensions();

        foreach ($expectedExtensions as $id => $extension) {
            self::assertArrayHasKey($id, $actualExtensions);
            self::assertIsCallable($actualExtensions[$id]);
        }

        self::assertSameSize($expectedExtensions, $actualExtensions);
    }
}

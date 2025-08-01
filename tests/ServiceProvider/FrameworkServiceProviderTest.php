<?php

declare(strict_types=1);

namespace FastForward\Framework\Tests\ServiceProvider;

use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
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
        $factories = $this->provider->getFactories();

        self::assertIsArray($factories);
        self::assertNotEmpty($factories);
        foreach ($factories as $factory) {
            self::assertIsCallable($factory);
        }
    }

    public function testGetExtensionsWillReturnHttpServiceProviderExtensions(): void
    {
        $extensions = $this->provider->getExtensions();

        self::assertIsArray($extensions);
        foreach ($extensions as $extension) {
            self::assertIsCallable($extension);
        }
    }
}

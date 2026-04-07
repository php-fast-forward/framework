# Fast Forward Framework

[![PHP Version](https://img.shields.io/badge/php-^8.3-777BB4?logo=php&logoColor=white)](https://www.php.net/releases/)
[![Tests](https://img.shields.io/github/actions/workflow/status/php-fast-forward/framework/tests.yml?logo=githubactions&logoColor=white&label=tests&color=22C55E)](https://github.com/php-fast-forward/framework/actions/workflows/tests.yml)
[![Coverage](https://img.shields.io/badge/coverage-phpunit-4ADE80?logo=php&logoColor=white)](https://php-fast-forward.github.io/framework/coverage/index.html)
[![Docs](https://img.shields.io/github/deployments/php-fast-forward/framework/github-pages?logo=readthedocs&logoColor=white&label=docs&labelColor=1E293B&color=38BDF8&style=flat)](https://php-fast-forward.github.io/framework/index.html)
[![License](https://img.shields.io/github/license/php-fast-forward/framework?color=64748B)](LICENSE)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/php-fast-forward?logo=githubsponsors&logoColor=white&color=EC4899)](https://github.com/sponsors/php-fast-forward)

[![PSR-7](https://img.shields.io/badge/PSR--7-http--message-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-7/)
[![PSR-11](https://img.shields.io/badge/PSR--11-container-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-11/)
[![PSR-14](https://img.shields.io/badge/PSR--14-event--dispatcher-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-14/)
[![PSR-17](https://img.shields.io/badge/PSR--17-http--factory-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-17/)
[![PSR-18](https://img.shields.io/badge/PSR--18-http--client-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-18/)
[![PSR-20](https://img.shields.io/badge/PSR--20-clock-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-20/)

**Fast Forward Framework** is a lightweight and fast PHP framework designed for building modern web
and event-driven applications.
This package serves as an **aggregate metapackage**, bundling all core components of the Fast Forward ecosystem for easier installation and management.

---

## Features

- 🚀 **Modern PHP 8.3+ syntax**
- 📦 Simplifies installation of all core packages in one step
- 🔌 Registers the Fast Forward HTTP and event-dispatcher stacks through a single framework provider
- 🧱 Provides a solid foundation for building scalable PHP applications

## Usage

```php
<?php

declare(strict_types=1);

use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
use function FastForward\Container\container;
use Psr\Clock\ClockInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseFactoryInterface;

require_once __DIR__ . '/vendor/autoload.php';

$container = container(new FrameworkServiceProvider());

$responseFactory = $container->get(ResponseFactoryInterface::class);
$dispatcher = $container->get(EventDispatcherInterface::class);
$clock = $container->get(ClockInterface::class);
```

---

## Installation

Install via [Composer](https://getcomposer.org):

```bash
composer require fast-forward/framework
```

This command will automatically pull in all the required dependencies of the framework.

---

## Requirements

- PHP 8.3 or higher

---

## License

Fast Forward Framework is licensed under the [MIT license](LICENSE).

---

## Author

Developed with ❤️ by **Felipe Sayão Lobato Abreu**  
📧 [github@mentordosnerds.com](mailto:github@mentordosnerds.com)

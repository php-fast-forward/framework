# Fast Forward Framework

![Fast Forward mascot](docs/_static/mascot.png)

[![PHP Version](https://img.shields.io/badge/php-^8.3-777BB4?logo=php&logoColor=white)](https://www.php.net/releases/)
[![Composer Package](https://img.shields.io/badge/composer-fast--forward%2Fframework-F28D1A.svg?logo=composer&logoColor=white)](https://packagist.org/packages/fast-forward/framework)
[![Tests](https://img.shields.io/github/actions/workflow/status/php-fast-forward/framework/tests.yml?logo=githubactions&logoColor=white&label=tests&color=22C55E)](https://github.com/php-fast-forward/framework/actions/workflows/tests.yml)
[![Coverage](https://img.shields.io/badge/coverage-phpunit-4ADE80?logo=php&logoColor=white)](https://php-fast-forward.github.io/framework/coverage/index.html)
[![Metrics](https://img.shields.io/badge/metrics-phpmetrics-8B5CF6?logo=php&logoColor=white)](https://php-fast-forward.github.io/framework/metrics/index.html)
[![Docs](https://img.shields.io/github/deployments/php-fast-forward/framework/github-pages?logo=readthedocs&logoColor=white&label=docs&labelColor=1E293B&color=38BDF8&style=flat)](https://php-fast-forward.github.io/framework/index.html)
[![License](https://img.shields.io/github/license/php-fast-forward/framework?color=64748B)](LICENSE)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/php-fast-forward?logo=githubsponsors&logoColor=white&color=EC4899)](https://github.com/sponsors/php-fast-forward)

[![PSR-7](https://img.shields.io/badge/PSR--7-http--message-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-7/)
[![PSR-11](https://img.shields.io/badge/PSR--11-container-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-11/)
[![PSR-14](https://img.shields.io/badge/PSR--14-event--dispatcher-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-14/)
[![PSR-17](https://img.shields.io/badge/PSR--17-http--factory-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-17/)
[![PSR-18](https://img.shields.io/badge/PSR--18-http--client-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-18/)
[![PSR-20](https://img.shields.io/badge/PSR--20-clock-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-20/)

**Fast Forward Framework** is a lightweight aggregate metapackage that installs the core
Fast Forward stack through a single dependency and a single service-provider bootstrap.

## ✨ Features

- 🎯 One-command installation of core Fast Forward packages
- 🧩 Aggregates HTTP and event-dispatcher infrastructure with container integration
- 🚀 Compatible with modern PHP standards (PSR-7, PSR-11, PSR-14, PSR-17, PSR-18, PSR-20)
- 🧱 Built as the foundation layer for Fast Forward applications

## 📦 Installation

```bash
composer require fast-forward/framework
```

Requirements:

- PHP 8.3 or higher

## 🛠️ Usage

```php
<?php

declare(strict_types=1);

use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
use function FastForward\Container\container;
use Psr\Clock\ClockInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseFactoryInterface;

require __DIR__ . '/vendor/autoload.php';

$container = container(new FrameworkServiceProvider());

$responseFactory = $container->get(ResponseFactoryInterface::class);
$dispatcher = $container->get(EventDispatcherInterface::class);
$clock = $container->get(ClockInterface::class);
```

## 🔌 Package Surface

- `FastForward\Framework\ServiceProvider\FrameworkServiceProvider`
- Core HTTP and event-dispatcher service provider orchestration
- Shared configuration and lifecycle defaults for core packages in the ecosystem

## 📚 Documentation

- [GitHub Repository](https://github.com/php-fast-forward/framework)
- [Packagist](https://packagist.org/packages/fast-forward/framework)
- [Issue Tracker](https://github.com/php-fast-forward/framework/issues)
- [Coverage](https://php-fast-forward.github.io/framework/coverage/index.html)
- [Metrics](https://php-fast-forward.github.io/framework/metrics/index.html)
- [Docs](https://php-fast-forward.github.io/framework/index.html)

## 🧪 Quality and Observability

- Test suite: [GitHub Actions](https://github.com/php-fast-forward/framework/actions/workflows/tests.yml)
- Coverage: `coverage/index.html`
- Testdox: `coverage/testdox.html`
- Metrics: `metrics/index.html`

## 🤝 Contributing

Contributions, issues, and feature requests are welcome. Keep changes focused and aligned
with the repository's existing documentation and contribution flow.

## 🛡 License

Fast Forward Framework is licensed under the [MIT license](LICENSE).

## 👤 Author

Developed by **Felipe Sayão Lobato Abreu**
- 📧 [github@mentordosnerds.com](mailto:github@mentordosnerds.com)

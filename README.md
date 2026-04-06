# Fast Forward Framework

[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![PHP Version](https://img.shields.io/badge/php-^8.3-blue.svg)](https://www.php.net/releases/)

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
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseFactoryInterface;

require_once __DIR__ . '/vendor/autoload.php';

$container = container(new FrameworkServiceProvider());

$responseFactory = $container->get(ResponseFactoryInterface::class);
$dispatcher = $container->get(EventDispatcherInterface::class);
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

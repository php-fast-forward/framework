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

use FastForward\DevTools\Config\ComposerDependencyAnalyserConfig;
use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return ComposerDependencyAnalyserConfig::configure(
    static function (Configuration $configuration): void {
        $configuration->ignoreErrors([ErrorType::SHADOW_DEPENDENCY, ErrorType::UNUSED_DEPENDENCY]);
    }
);

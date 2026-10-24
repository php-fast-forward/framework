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

use FastForward\DevTools\Path\WorkingProjectPathResolver;
use PhpCsFixer\Config;
use PhpCsFixer\Finder;

require __DIR__ . '/vendor/autoload.php';

$header = trim((string) preg_replace(
    ['!^/\*\*\n!', '! \*/!', '! \* ?!', '!%year%!', '!' . date('Y-Y') . '!'],
    ['', '', '', date('Y'), date('Y')],
    (string) file_get_contents(__DIR__ . '/.docheader'),
));

return (new Config())
    ->setRiskyAllowed(false)
    ->setFinder(Finder::create()->in(__DIR__)->exclude(WorkingProjectPathResolver::TOOLING_EXCLUDED_DIRECTORIES))
    ->setRules([
        'header_comment' => [
            'header' => $header,
            'comment_type' => 'PHPDoc',
            'location' => 'after_declare_strict',
            'separate' => 'both',
        ],
        'phpdoc_indent' => true,
        'phpdoc_order' => ['order' => ['param', 'return', 'throws']],
        'phpdoc_separation' => true,
        'phpdoc_trim' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_scalar' => true,
        'phpdoc_types' => true,
        'phpdoc_to_comment' => false,
        'phpdoc_add_missing_param_annotation' => true,
    ]);

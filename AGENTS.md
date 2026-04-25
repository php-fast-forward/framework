# AGENTS - Fast Forward Framework

This repository is a PHP metapackage (`fast-forward/framework`) that aggregates and wires core
Fast Forward components through a single provider entry point.

## Repository surfaces

- Primary package entrypoint: [`src/`](src/)
- Container/service-provider behavior: [`src/ConfigProvider/`](src/ConfigProvider/)
- Tests: [`tests/`](tests/)
- Docs: [`docs/`](docs/)
- CI configuration: [`.github/workflows/`](.github/workflows/)
- Release history: [`CHANGELOG.md`](CHANGELOG.md)
- Project README: [`README.md`](README.md)

## Setup and local workflow

- Run `composer install` before making any code changes.
- Keep local runtime aligned to PHP 8.3 (project minimum).
- Run full local validation with:
  - `composer dev-tools`
- Apply auto-fixes and generated file synchronization with:
  - `composer dev-tools:fix`
- Validate changelog discipline on PR branches with:
  - `composer dev-tools changelog:check -- --against=refs/remotes/origin/main`

## Testing and quality gates

- Primary test command: `composer dev-tools` (includes PHPUnit and report generation).
- Focused test command used by the dev-tools pipeline: `vendor/bin/phpunit`.
- Relevant changelog and release workflow checks are in
  [`.github/workflows/changelog.yml`](.github/workflows/changelog.yml) and
  [`.github/workflows/tests.yml`](.github/workflows/tests.yml).

## Documentation conventions

- Keep docs consistent with metapackage usage snippets and avoid instantiating providers directly
  when the `::class` shorthand is the canonical documented pattern.
- Use `FrameworkServiceProvider::class` in documented bootstrap examples per current standards.

## PR and review expectations

- When making user-visible changes, add an entry under `## [Unreleased]` in [`CHANGELOG.md`](CHANGELOG.md).
- Prefer concise entry wording and include the current PR reference when known.

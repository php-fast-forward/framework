# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.5.0] - 2026-10-21

### Added

- Bundle the fast-forward-framework consumer skill with executable examples, optional installation guidance and Composer discovery metadata. ([#16](https://github.com/php-fast-forward/framework/pull/16))

### Changed

- Raise compatible Fast Forward dependency minimums to current stable releases, use stable DevTools and check Composer and Actions updates daily through Dependabot. ([#16](https://github.com/php-fast-forward/framework/pull/16))

## [1.4.1] - 2026-10-20

### Changed

- Adopt Fast Forward Changelog automation through its v0 release channel and its project skill for validated contribution notes and reviewed version pull requests titled with the package name and current/next versions. Remove the legacy automatic conflict-resolution workflow now that pending changes use independent fragments. ([#13](https://github.com/php-fast-forward/framework/pull/13))
- Replace the mascot banner with contextual Dash artwork connecting framework modules and align README and documentation references. ([#9](https://github.com/php-fast-forward/framework/pull/9))
- Publish generated Wiki pages directly without tracking the Wiki as a Git submodule. ([#13](https://github.com/php-fast-forward/framework/pull/13))

### Fixed

- Allow the isolated CI status publisher to read workflow job outcomes without granting write permissions to test jobs. ([#13](https://github.com/php-fast-forward/framework/pull/13))
- Pin Wiki publication to the merged DevTools workflow so a squash merge cannot invalidate its source revision. ([#12](https://github.com/php-fast-forward/framework/pull/12))

## [1.4.0] - 2026-04-25

### Added

- Add changelog history for releases v1.0.0-v1.3.0 during dev-tools asset synchronization. (#3)
- Sync latest Fast Forward dev-tools managed assets (workflow templates, governance metadata, agents, and skills) into this repository. (#3)
- Add repository AGENTS.md for agent task orchestration and local onboarding flow.
- Add ``fast-forward/enum`` as an installed package in the framework metapackage and document its presence in package surface guidance. (#6)

### Changed

- Prefer FrameworkServiceProvider::class in framework README/docs bootstrap snippets instead of instantiating provider objects.

## [1.3.0] - 2026-03-29

### Added

- Add test attribute metadata to FrameworkServiceProviderTest.

### Changed

- Migrate framework baseline to PHP 8.3+ and refresh documentation.
- Update wiki submodule pointer.

## [1.2.1] - 2025-08-01

### Fixed

- Fix test namespace mismatches.
- Fix self-referencing factory behavior.

## [1.2.0] - 2025-08-01

### Added

- Introduce service-provider bootstrapping and registration support.

### Changed

- Finalize first production-ready version baseline.

## [1.1.0] - 2025-04-20

### Added

- Add fast-forward/iterators support and update package configuration.

## [1.0.0] - 2025-04-20

### Added

- Initial package bootstrap, foundational framework scaffolding, and baseline release metadata.


[1.5.0]: https://github.com/php-fast-forward/framework/compare/v1.4.1...v1.5.0
[1.4.1]: https://github.com/php-fast-forward/framework/compare/v1.4.0...v1.4.1
[1.4.0]: https://github.com/php-fast-forward/framework/compare/v1.3.0...v1.4.0
[1.3.0]: https://github.com/php-fast-forward/framework/compare/v1.2.1...v1.3.0
[1.2.1]: https://github.com/php-fast-forward/framework/compare/v1.2.0...v1.2.1
[1.2.0]: https://github.com/php-fast-forward/framework/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/php-fast-forward/framework/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/php-fast-forward/framework/releases/tag/v1.0.0

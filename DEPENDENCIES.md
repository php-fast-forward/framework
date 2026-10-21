# Dependency freshness

The framework requires the latest reviewed stable Fast Forward baselines with
caret constraints. A fresh Composer resolution chooses the newest compatible
versions allowed by the entire application graph and its PHP/extensions.

This library intentionally commits no composer.lock. Applications should commit
their lockfile: composer install reproduces that application lock, while composer
update deliberately resolves new compatible versions. Installing/updating this
library does not rewrite an application's lockfile in the background.

Dependabot monitors Composer and GitHub Actions daily at 09:00 America/Sao_Paulo
(on Dependabot's weekday daily schedule). Composer uses versioning-strategy:
increase so a new release can propose an increased manifest minimum even when
it was already compatible. All dependency types are eligible; compatible
fast-forward/* minor/patch updates are grouped and major proposals stay separate.
No ignored package/version or cooldown suppresses new Fast Forward releases.
Twenty concurrent version-update PRs are permitted. These settings take effect
when the configuration is merged into the default branch. They prepare reviewable
PRs; checks and maintainer merge decisions still apply.

HTTP Client, HTTP Factory and HTTP Message are already installed transitively
through fast-forward/http. Requiring them again at framework level is unnecessary
for the framework's own provider. Clock, Config, Container, Defer, Enum, Event
Dispatcher, Fork, HTTP and Iterators form the intended runtime aggregate.
Changelog, DevTools, Composer Installers and the phpDocumentor template are
development/distribution tools rather than extra application runtime services.
Empty/prototype repositories do not establish a supported runtime library.

For a consumer that needs every newly published compatible release, schedule
reviewed dependency updates in that consumer too. Another dependency or the
consumer's PHP version can constrain resolution; this framework cannot guarantee
that the globally newest release is compatible. Review major releases and
runtime requirement changes explicitly before widening constraints.

References: [Composer constraints](https://getcomposer.org/doc/articles/versions.md)
and [Dependabot options](https://docs.github.com/en/code-security/reference/supply-chain-security/dependabot-options-reference).

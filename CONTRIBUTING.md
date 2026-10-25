# Contributing

Add one unique `.changelog/*.md` fragment for each observable change. With
PHP 8.5+ and CPX, inspect `help add`, then create and validate the note:

```sh
cpx --skip-local fast-forward/changelog add "Describe the observable change." --category=fixed --no-interaction
cpx --skip-local fast-forward/changelog check --no-interaction
```

After committing, validate the contribution with `check --since=origin/main`.
After `composer install`, read `.agents/skills/fast-forward-changelog/SKILL.md`
for the full procedure. Preserve published history and pending notes; do not add
an `Unreleased` section to `CHANGELOG.md`.

The GitHub workflow checks contributions, maintains PR feedback and prepares a
version PR. Review its exact changes before merging: that approved merge enables
automatic tag and GitHub Release publication. Installing the workflow publishes
nothing.

The development-only `llm/skills` Composer plugin restores the Changelog skill
from the reviewed GitHub source in `skills.json`; generated files are ignored by
Git. Use `composer skills:show` to inspect it and
`composer skills:update --from=github` for an explicit refresh within the
configured `^0.4.0` version range (stable `0.4.x` releases, starting at `0.4.0`).
With `auto-sync: true`, Composer also synchronizes skills after install/update;
`--no-scripts` suppresses this automatic step. Review `skills.json` before
changing that range.

## Composer dependency skills

The development-only manager restores consumer skills from installed Composer
packages matching the `fast-forward/*` trust pattern. `trusted-replace` keeps
packages outside that namespace untrusted, including other direct dependencies.
The following dependencies have minimum versions that include their bundled
payload. No separate GitHub source is used for these libraries.

| Composer donor | Minimum version | Dependency scope |
| --- | --- | --- |
| fast-forward/clock | 1.1.0 | Runtime |
| fast-forward/config | 1.7.3 | Runtime |
| fast-forward/container | 1.10.1 | Runtime |
| fast-forward/defer | 1.1.0 | Runtime |
| fast-forward/enum | 0.2.0 | Runtime |
| fast-forward/event-dispatcher | 1.1.0 | Runtime |
| fast-forward/fork | 1.1.0 | Runtime |
| fast-forward/http | 1.2.0 | Runtime |
| fast-forward/http-client | 1.2.0 | Transitive runtime |
| fast-forward/http-factory | 1.3.0 | Transitive runtime |
| fast-forward/http-message | 1.5.0 | Transitive runtime |
| fast-forward/iterators | 1.3.0 | Runtime |
| fast-forward/phpdoc-bootstrap-template | 2.2.0 | Development |

The HTTP components remain transitive dependencies; Composer conflicts exclude
older versions without adding duplicate runtime requirements. The template has
an explicit development requirement. Composer Installers is not part of the
installed graph. The framework's own skill is registered as an explicit `dir`
source in `skills.json`, using its canonical `resources/skills` directory. The
directory adapter derives the donor identity without a package override.

Inspect donors with `composer skills:show` and refresh their payloads with
`composer skills:update --from=composer`. The existing GitHub source continues
to manage the Changelog contributor skill independently, discovering its bundled
skill from the remote package's Composer metadata without a skill allowlist.
Refresh the framework's own skill with `composer skills:update --from=dir`.
Generated copies remain
ignored. Synchronization does not upgrade runtime dependencies; an installed
version without a bundled skill contributes no skill. Check installed versions
and the bundled skill's supported contract before using its instructions.

## PHPDoc and documentation checks

The repository's `.php-cs-fixer.dist.php` loads the consumer autoloader and
applies the DevTools PHPDoc and file-header rules. This avoids requiring a
nonexistent nested `vendor/autoload.php` inside the installed DevTools package.
Run `composer dev-tools` for the complete checks and generated documentation.
An install with `--no-plugins` skips preparation of the signed phpDocumentor
executable. When it is missing, run `composer reinstall phpdocumentor/shim`
with the already approved plugins enabled before building documentation.

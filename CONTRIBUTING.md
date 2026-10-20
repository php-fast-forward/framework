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
configured version range. Review `skills.json` before changing that range.

## Container consumer skill

The same development-only manager also restores `fast-forward-container` from
`php-fast-forward/container` within `^1.10.0`, alongside the other configured
skills. Inspect all sources with `composer skills:show` and refresh them with
`composer skills:update --from=github`. Generated copies stay ignored; this
configuration does not upgrade the runtime library. Check the installed
Container version before following the skill: its API contract supports `^1.10`
and requires reporting earlier versions instead of assuming compatibility.

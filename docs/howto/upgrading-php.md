# How to upgrade PHP versions

This document describes the steps taken to successfully upgrade PHP between
versions.

## Before you begin

It is probably helpful to review the [Pantheon documentation on upgading PHP](https://docs.pantheon.io/guides/php/php-versions#change-the-php-version-on-a-new-multidev)
before starting this process.

## Workflow

The process we followed to upgrade from PHP 7.4 to PHP 8.0 was the following:

1. Create a new multidev with no changes

Specifically, create a new branch, push that to Pantheon, and then create the
multidev using Terminus:

```bash
$ git checkout -b newbranch
$ git push pantheon newbranch
$ terminus multidev:create mitlib-wp-network.live newbranch
```

_(The multidev creation ended with an error due to a problem that would be
solved by upgrading PHP. We did not need a successful build, just that the
multidev existed at all.)_

2. Update the `php_version` line in `pantheon.upstream.yml`, commit, and push

After pushing this change to `pantheon.upstream.yml` to a now-existing multidev,
Pantheon flagged the change but accepted it:

3. Confirm the PHP version update

The PHP version for each multidev environment can be found in the Pantheon
dashboard under the Settings link, and the PHP version tab.

Additionally, there is a pre-install command in our `composer.json` file which
reads out the PHP version prior to doing any work. This allows us to confirm
the PHP version by viewing the build log from the Code tab on the relevant
multidev.

The final step, if you want to confirm the PHP version within WordPress, is to
consult the Site Health report (WordPress admin interface -> Tools -> Site
Health). The report's Info tab includes a Server panel which reports the PHP
version.

4. Push branch to Github for code review

From this point, follow our standing practices for pull requests and code
review.

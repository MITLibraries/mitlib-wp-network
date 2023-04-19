# Getting started

In this tutorial, you will set up a local version of our WordPress network.

## Prerequisites

Please ensure you have the following tools set up on your computer. Everything
can be installed via [Homebrew](https://brew.sh/).

### PHP

We currently use the latest release on the 8.0.x branch, using commands such as:

```bash
$ brew install php@8.0
```

### Composer

https://getcomposer.org/

```bash
$ brew install composer
```

The only global package currently needed is PHP CodeSniffer, and the WordPress
coding standards:

```bash
$ composer global require squizlabs/php_codesniffer
```

At this point you should be able to see something like the following output:

```bash
$ phpcs -i
The installed coding standards are MySource, PEAR, PSR1, PSR2, PSR12, Squiz, Zend
```

Installing the WordPress code standards should be a process like

```bash
$ git clone --branch master git@github.com:WordPress/WordPress-Coding-Standards.git ~/code/wpcs
$ phpcs --config-set installed_paths ~/code/wpcs
```

You have done everything correctly if you see the following output:

```bash
$ phpcs -i
The installed coding standards are MySource, PEAR, PSR1, PSR2, PSR12, Squiz, Zend, WordPress, WordPress-Core, WordPress-Docs and WordPress-Extra
```

### Terminus CLI

https://docs.pantheon.io/terminus

There are a few packages with this name - you're looking for this one:

```bash
$ brew install pantheon-systems/external/terminus
```

Authenticating via Terminus is documented at https://docs.pantheon.io/terminus/install#authenticate

Additionally, there are four plugins you'll need:

- [terminus-build-tools-plugin](https://github.com/pantheon-systems/terminus-build-tools-plugin)
- [terminus-composer-plugin](https://github.com/pantheon-systems/terminus-composer-plugin)
- [terminus-secrets-manager-plugin](https://github.com/pantheon-systems/terminus-secrets-manager-plugin)
- [terminus-secrets-plugin](https://github.com/pantheon-systems/terminus-secrets-plugin)

The syntax to install each is typically:

```bash
terminus self:plugin:install plugin-name
```

You have done everything correctly when:

- You see your information with `terminus auth:whoami`
- You see four plugins listed by `terminus self:plugin:list`
- You see at least three entries with `terminus env:list mitlib-wp-network`

### Lando

https://lando.dev/

```bash
$ brew install --cask lando
```

## Set up application

- git clone mitlib-wp-network
- composer install
- lando pull
- lando wp search-replace command
- lando start
- (optional) lando logs -f

Get .env from someone

Set secrets.json values inside Lando (need more words here)

Load https://mitlib-wp-network.lndo.site/ and see the homepage

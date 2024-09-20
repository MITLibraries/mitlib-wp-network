# Getting started

In this tutorial, you will set up a local version of our WordPress network.

## Prerequisites

Please ensure you have the following tools set up on your computer. Most things can be installed via [Homebrew](https://brew.sh/),
except where noted.

### PHP

We currently use the latest release on the 8.1.x branch, using commands such as:

```bash
$ brew install php@8.1
```

### Composer

https://getcomposer.org/

```bash
$ brew install composer
```

You will also need to configure Composer to connect to a few [private repositories](https://getcomposer.org/doc/articles/authentication-for-private-packages.md). You will need the following:

1. A Github classic token with repo scope

Creating the token itself is done in [your Github account settings](https://github.com/settings/tokens/new?scopes=repo&description=For+Composer), and then registered with Composer via a command like:

```bash
composer config --global github-oauth.github.com TOKEN_VALUE_HERE
```

2. Our credentials for the Advanced Custom Fields Pro plugin

These credentials can be found in our shared LastPass account, in the `Shared-Product-Pantheon` folder. They are added
to your Composer configuration via a command like:

```bash
composer config --global http-basic.connect.advancedcustomfields.com USERNAME PASSWORD
```

When you are done with these steps, you should be able to see the results in `~/.composer/auth.json`.


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

Lando should _not_ be installed via homebrew. The [install instructions](https://lando.dev/download/) should be followed instead.

## Set up application

1. git clone mitlib-wp-network
2. composer install

If you run into problems during this phase, you may need to complete the authentication steps listed in the Composer
section above.

3. lando start

While the site cannot be used yet, the containers should be running for the steps which follow.

4. lando pull

The `pull` command can take database and files from any tier on Pantheon, but in most cases you will want to select the
Live tier.

5. lando wp search-replace command

```bash
lando wp search-replace libraries.mit.edu mitlib-wp-network.lndo.site --url=libraries.mit.edu --network
```

6. Load https://mitlib-wp-network.lndo.site/ in your browser. Voila!

## Please note

These instructions do not cover how to define application secrets, which mostly involve allowing WordPress to send
emails via the WP SMTP plugin, and is rarely needed for local development. That topic is covered in the project README
if it becomes relevant for your work.

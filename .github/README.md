# MIT Libraries WordPress Network

## Pantheon template

[![Early Access](https://img.shields.io/badge/Pantheon-Early%20Access-yellow?logo=pantheon&color=FFDC28)](https://pantheon.io/docs/oss-support-levels#early-access)

This application was created using Pantheon's [Composer-enabled WordPress template](https://github.com/pantheon-systems/wordpress-composer-managed). After creation, the application is owned and developed by the staff of the MIT Libraries.

## Developing this application

### Prerequisites

To contribute to this application, please make sure your local environment includes the following:

* [Terminus](https://pantheon.io/docs/terminus) for managing Pantheon infrastructure from the command line.
* [Composer](https://getcomposer.org) for managing third-party plugins and themes within WordPress, and tooling outside of WordPress.
* [Lando](https://lando.dev/) for running a local copy of this application.

### Branch names

Pantheon imposes [restrictions on branch names](https://pantheon.io/docs/guides/multidev/create-multidev), including a length limit and some reserved words. **The easiest convention is to name your branch after its Jira ticket, which sets up the following relationships:**

| Resource      | Value                                                                         |
|-------------- |-----------------------------------------------------------------------------  |
| Ticket        | [ENGX-201](https://mitlibraries.atlassian.net/browse/ENGX-201)                |
| Git branch    | [engx-201](https://github.com/MITLibraries/mitlib-wp-network/tree/engx-201)   |
| Multidev URL  | https://**engx-201**-mitlib-wp-network.pantheonsite.io/                       |

### Git remotes

Contributing to this project involves working with two separate git servers:

* We use this Github repository for pull requests, to facilitate [code review](https://mitlibraries.github.io/guides/collaboration/code_review.html).

* We push code to Pantheon's git server in order to set up review applications (known as [Multidev](https://pantheon.io/docs/guides/multidev) environments in Pantheon's vocabulary), and push code to the dev->test->live pipeline. Feature branches get deployed to Multidev environments, while the `master` branch gets deployed to the Dev environment for subsequent promotion to the Test and Live environments.

### Common workflows

While many of the processes for contributing to this application are similar to other projects (see the [Workflows](https://mitlibraries.github.io/guides/basics/github.html#workflows) section of our developer documentation for more information), there are some app-specific steps that need to be followed.

#### Creating a new Multidev environment

Terminus is the tool used to manage Pantheon infrastructure.

* Push the branch to Pantheon's git server:

  ```bash
  git push pantheon engx-201
  ```

  _You can find the git address to use for the `pantheon` remote on the application dashboard within Pantheon._

* Create a Multidev environment that corresponds with that branch, based on the current Dev environment:

  ```bash
  terminus multidev:create mitlib-wp-network.dev engx-201
  ```

The new `engx-201` Multidev environment will be available at https://engx-201-mitlib-wp-network.pantheonsite.io/, but it
will have no contents. See the next section for copying database and file content between environments.

More information about Multidev, and tools to manage them, can be found at:
* [Multidev documentation](https://pantheon.io/docs/guides/multidev)
* [Creating via the Pantheon dashboard](https://pantheon.io/docs/guides/multidev/create-multidev)
* [More about the multidev:create command](https://pantheon.io/docs/terminus/commands/multidev-create)

#### Deleting a Multidev environment

This section TBD

#### Copying web content between environments

This workflow gets followed when initially setting up a new Multidev environment, as well as when pushing content up or
down the Dev -> Test -> Live pipeline.

* Copy a site's database and user-contributed files using the `env:clone-content` command:

  ```bash
  terminus env:clone-content mitlib-wp-network.dev engx-201
  ```

* Update database values to match the target environment using the [search-replace](https://developer.wordpress.org/cli/commands/search-replace/) command in the WP CLI:

  ```bash
  terminus remote:wp mitlib-wp-network.engx-201 -- search-replace \
    dev-mitlib-wp-network.sites.presalesexamples.com engx-201-mitlib-wp-network.sites.presalesexamples.com \
    --url=dev-mitlib-wp-network.sites.presalesexamples.com \
    --network
  ```

#### Managing third-party plugins and themes

Composer is PHP's tool for dependency management, and can be used to install and manage third-party libraries like
WordPress plugins and themes. For example, to add the [Hello Dolly](https://wordpress.org/plugins/hello-dolly/) plugin you would use a command like:

```bash
composer require wpackagist-plugin/hello-dolly
```

Checking for available updates, and then applying them, is handled similarly:

```bash
composer outdated
composer update wpackagist-plugin/hello-dolly
```

**Please note:** If the resulting diff from a Composer workflow goes beyond `composer.json` and `composer.lock`, please
double-check what is being changed. It is likely that something unexpected has happened; proceed with caution.

**Please note:** Our linting rules expect that you will manually exclude third party plugins in our `phpcs.xml` config.
For example: `<exclude-pattern>web/app/plugins/FOO</exclude-pattern>`. We don't exclude _all_ plugins as we want to
ensure that our locally developed plugins follow our standards so by default scanning everything and turning off third
party plugins manually is our practice

#### Adding or updating locally-written code

Locally-developed plugins and themes are, with rare exceptions, added directly to this repository.

* Theme are installed into `web/app/themes/`.
* Plugins are installed into `web/app/plugins/`.
* Must-use plugins are installed into `web/app/mu-plugins/`.

The exception to the above involves packages that are used on multiple WordPress applications (not just multiple sites
within this one network). These packages should be maintained in a separate Github repository, and [loaded directly from that repo](https://getcomposer.org/doc/05-repositories.md#loading-a-package-from-a-vcs-repository) via Composer.

**A word about coding standards**

We rely on [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) (PHPCS) to help us comply with the [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/) - particularly the security-focused guidelines. To run PHPCS locally:

```bash
phpcs
```

Some problems flagged may be fixable automatically by running:

```bash
phpcbf
```

As part of the pull request process, we run two checks.

Before dependencies are installed, we do a syntax-focused check of the codebase via:

```bash
composer syntax
```

Note: This syntax check is done before installing dependencies as it is a slow check and running it on code that is not
under our control during a PR is not necessary.

After dependencies are checked out, we run a security-focused check of the codebase via:

```bash
composer security
```

#### Changing sites on the network

In order for multisite networks to function correctly on Pantheon in subdirectory mode, we need to maintain symlnks in the `/web/` directory of this repository for each site. Without these symlinks, the sites themselves will be plagued with 404 errors due to missing site assets, while the site dashboards will be caught in a redirect loop.

Maintaining these symlinks involves two steps. For a hypothetical site like `libraries.mit.edu/foobar/` you need to:

1. Create a symlink in this repository from `/web/foobar/` to `/web/wp/`.
2. Exclude this symlink from being followed by PHPCS by adding `<exclude-pattern>web/foobar</exclude-pattern>` to `phpcs.xml`.

#### Running locally with Lando

* `lando start` will get your local containers running.
* `lando pull` will prompt for the environment on Pantheon from which to grab the database and files. (Our default workflow is to not prompt for copying code directly from Pantheon)
* `lando wp search-replace dev-mitlib-wp-network.sites.presalesexamples.com mitlib-wp-network.lndo.site --url=dev-mitlib-wp-network.sites.presalesexamples.com --network` will cleanup the database to work with our local site name. Note: `dev-mitlib...` would change to match whichever multidev you pulled data from in the previous step. This assumes `dev` but if you chose `engxhallo`, the prefix would change to `engxhallo-mitlib`. If the command finishes saying it made 0 replacements, it's likely you ran a command for replacing that didn't match the multidev you pulled from.
* Access the site at: `https://mitlib-wp-network.lndo.site`

You can completely start your local environment over with `lando destroy` - after which you should follow each step in the above process.

In some circumstances, you may need to specify port numbers as part of the site address. When this happens, include the port number for the SSL port in order to log into the WP admin interface. The port number should be included in the `url` parameter when using the WordPress CLI, and also included in the `search-replace` command after copying content between environments.

### Related resources

* [Bedrock](https://roots.io/bedrock/) is a modern WordPress stack that helps you get started with the best development tools and project structure.
* [Twelve-factor WordPress](https://roots.io/twelve-factor-wordpress/) is a WordPress-specific edition of the [Twelve-Factor App](http://12factor.net/) methodology, which informed the creation of Bedrock.
* [Composer](https://getcomposer.org) is used for dependency management within the repository.
* [Terminus](https://pantheon.io/docs/terminus) is used for CLI access to the Pantheon platform.
* Enhanced security (separated web root and secure passwords with [wp-password-bcrypt](https://github.com/roots/wp-password-bcrypt))


## Environment variables and secrets

This application uses a variety of ways to manage environment variables and secrets. All of these values are available within our shared LastPass account.

**Please note!** There are two almost-identical Terminus plugins, which provide distinct workflows:

- `terminus secret` (note the singular) is used for values that are used during build / deploy.
- `terminus secrets` (note the plural) is used for values that are used by the WordPress application itself (after it has been deployed).


### Build secrets

Managed with: [**Terminus Secrets Manager** plugin](https://github.com/pantheon-systems/terminus-secrets-manager-plugin)

Example: `terminus secret:list mitlib-wp-network`

This tool allows us to provide secret values for use by Composer during application deploys.

#### Required build secrets

- `ACF_PRO_KEY` - License key necessary for installing the Advanced Custom Fields Pro plugin


### Application secrets

Managed with: [**Terminus Secrets** plugin](https://github.com/pantheon-systems/terminus-secrets-plugin)

Example: `terminus secrets:list mitlib-wp-network.live`

This tool allows us to populate secret values into the Pantheon filesystem, which are read into WordPress constants within `/web/wp-config.php`.

Please see the readme for that project for [installation](https://github.com/pantheon-systems/terminus-secrets-plugin#installation) and [usage](https://github.com/pantheon-systems/terminus-secrets-plugin#usage) instructions.

#### Required application secrets

- `WPMS_SMTP_PASS` Password associated with the username in `WPMS_SMTP_USER`.
- `WPMS_SMTP_USER` Username expected by the email server to send emails from WordPress. Associated with `WPMS_SMTP_PASS`.

#### Optional application secrets

- `SENTRY_DSN` Unique identifier for this project within Sentry.


### Environment variables

The [phpdotenv](https://github.com/vlucas/phpdotenv) library will load information from the `.env`, `.env.local`, and `.env.pantheon` files. The latter of these files is in version control, while `.env` and `.env.local` are ignored.

Information in these files is loaded into [the `$_ENV` superglobal](https://www.php.net/manual/en/reserved.variables.environment.php).

Bedrock makes use of an `.env` file to store environment variables. Pantheon takes care of many of these variabled in `.env.pantheon`. You may set your own environment variables in a new `.env` or environment variables that are local-only in `.env.local` using the `.env.example` as a guide. Wrap values that may contain non-alphanumeric characters with quotes, or they may be incorrectly parsed.

- Database variables
  - `DB_NAME` - Database name
  - `DB_USER` - Database user
  - `DB_PASSWORD` - Database password
  - `DB_HOST` - Database host
  - Optionally, you can define `DATABASE_URL` for using a DSN instead of using the variables above (e.g. `mysql://user:password@127.0.0.1:3306/db_name`)
- `WP_ENV` - Set to environment (`development`, `staging`, `production`)
- `WP_HOME` - Full URL to WordPress home (https://example.com)
- `WP_SITEURL` - Full URL to WordPress including subdirectory (https://example.com/wp)
- `ACF_PRO_KEY` - License key necessary for installing the Advanced Custom Fields Pro plugin
- `AUTH_KEY`, `SECURE_AUTH_KEY`, `LOGGED_IN_KEY`, `NONCE_KEY`, `AUTH_SALT`, `SECURE_AUTH_SALT`, `LOGGED_IN_SALT`, `NONCE_SALT`
  - Generate with [wp-cli-dotenv-command](https://github.com/aaemnnosttv/wp-cli-dotenv-command)
  - Regenerate with [Bedrock's WordPress salts generator](https://roots.io/salts.html)


### Github secrets

Managed with: Github web UI

In addition to secret values stored using Terminus, we also define certain values used by our CI workflow using Github secrets.

- `ACF_PRO_KEY` License key necessary for installing the Advanced Custom Fields Pro plugin.
- `DEPLOY_SSH_KNOWN_HOSTS` The known_hosts file to allow GitHubs' CI to trust the Pantheon git server.
- `DEPLOY_SSH_PRIVATE_KEY` The private key (with blank passphrase) used to connect to Pantheon's git server. The public key is added to your personal settings within Pantheon.
- `PANTHEON_REPOSITORY` The SSH-format address of the git repository in Pantheon.



---
**The sections below were included in the original Readme, and I'm not sure whether they are still useful in this context.**

### WordPress Config

The `wp-config.php` file is located in the `web` directory. As with other WordPress sites on Pantheon, much of this is taken care of for you in `wp-config-pantheon.php`. Application-level configuration takes place in `config/application.php`. This can be referenced as a guide to understand how the constants are set up and how the `.env` files work, but modifying this file may result in merge conflicts and is not recommended. Any configuration changes should be made to your `wp-config.php` file directly.

You can learn more about WordPress configuration with Bedrock in the [Bedrock Configuration docs](https://docs.roots.io/bedrock/master/configuration/).

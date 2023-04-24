# Advanced setup for Composer

In this tutorial, you will go beyond the basic Composer setup to include the
full set of WordPress coding standards.

## Prerequisites

You should already have completed the [Getting Started](getting-started.md) tutorial.

## PHP CodeSniffer

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

## WordPress coding standards

Installing the WordPress code standards should be a process like:

```bash
$ git clone --branch master git@github.com:WordPress/WordPress-Coding-Standards.git ~/code/wpcs
$ phpcs --config-set installed_paths ~/code/wpcs
```

You have done everything correctly if you see the following output:

```bash
$ phpcs -i
The installed coding standards are MySource, PEAR, PSR1, PSR2, PSR12, Squiz, Zend, WordPress, WordPress-Core, WordPress-Docs and WordPress-Extra
```

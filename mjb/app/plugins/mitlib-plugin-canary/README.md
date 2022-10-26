# MITlib Plugin Canary

[![Build Status](https://travis-ci.org/MITLibraries/mitlib-plugin-canary.svg?branch=master)](https://travis-ci.org/MITLibraries/mitlib-plugin-canary)

![Screenshot of Plugin Canary widget](https://github.com/MITLibraries/mitlib-plugin-canary/raw/master/screenshot.png)

This is a Wordpress plugin that helps site builders detect when plugins that they are using have been removed from the Wordpress plugin directory. The widget lists every detected plugin on the site, and color codes the list according to three options:

1. Plugin still exists in the directory, and no update is available
2. Plugin still listed, but a newer version is available
3. Plugin is not listed in the directory.

This plugin was written after a few too many experiences of finding out that a plugin that we were using in production had been delisted with no public announcement.

# How to inspect the cache status for content

This document describes two methods to inspect the cache status for a piece of WordPress content.

## Using a web browser

Pantheon's documentation includes an illustrated example of using your web browser's inspection tools to [Review response caching](https://docs.pantheon.io/guides/frontend-performance/caching#review-response-caching).

## Using a terminal

It is also possible to use `curl` in a terminal session to inspect the cache status:

```bash
$ curl -L -Is -H "accept-encoding: gzip, deflate, br" "https://libraries.mit.edu/hours/" | egrep '(HTTP|cache-control|age:)'
HTTP/2 200 
cache-control: public, max-age=3600
age: 3418
```

The flags used in this command are described in more detail in the article [Test Global CDN Caching](https://docs.pantheon.io/guides/global-cdn/test-global-cdn-caching).

# How to conduct a smoke test for theme templates

This document describes a technique for identifying which PHP templates might
be unused within a theme.

## Requirements

In order to conduct this type of smoke test, you will need access to the PHP
logs for the server you are targeting.

## Process

### Add the smoke test message to templates

Add a line to the top of every PHP template (or the subset of templates you wish
to investigate):

```php
error_log( home_url( add_query_arg( array(), $wp->request ) ) . ' loaded ' . __FILE__ );
```

Note: the line above should be added directly to the templates, because the
`__FILE__` [magic constant](https://www.php.net/manual/en/language.constants.magic.php) will return the host filename (so if you put this in
a function in `functions.php`, you will just see _that_ filename in the logs).

Extending this approach to be abstracted into a function is left as an exercise
for the future.

### Crawl the site

Crawl the site using a command like wget, as in the following example:

```bash
wget -P . -mck --no-parent --no-check-certificate --user-agent="" \
  -e robots=off --wait 1 -E --exclude-directories=/news/wp-json \
  https://lm143-mitlib-wp-network.pantheonsite.io/news/
```

Alternatively, you could use a tool like [Integrity](https://peacockmedia.software/mac/integrity/free.html), but beware that the crawler
does not escape the targeted directory and exceed the scope of the smoke test.

### Inspect the results

When the crawler has finished, download the PHP log and isolate the time period
during which the crawler ran. You will see batches of lines like the following:

```log
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/header-opengraph.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/sub-headerSingle.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/social.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/title.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/entry.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/footer.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/image.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/title.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/subtitle.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/entry.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/footer.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/image.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/title.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/subtitle.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/entry.php
[30-Mar-2023 00:42:38 UTC] https://lm143-mitlib-wp-network.pantheonsite.io/news/2023/01/04/access-downloads-43 loaded /code/web/app/themes/mitlib-news/inc/footer.php
```

This section of the log details a single page load, and all the templates whose
smoke messages were triggered. From this you can generate load counts for each
partial, or identify which templates in the theme were not loaded.

# How we manage caching

Our WordPress network relies on two different types of content caching:

1. Our platform provider, Pantheon, maintains a global CDN that is specific to WordPress.
2. The MIT Libraries maintains its own CDN for common assets used across applications.

## Pantheon

The Pantheon cache functions largely without our intervention. More information about this system can be found at the
reference links below. However, there are a small number of places where we can influence the operation of Pantheon's cache:

1. Manually clearing the cache

The entire cache for our network can be cleared via a few different ways. For most staff, the easiest method is to look
in the WordPress admin area, for the "Pantheon Page Cache" page under the Settings item. This page provides a "Clear
Cache" button that will completely empty all cached content.

A second method for emptying the cache is to log into the Pantheon dashboard, navigate to the relevant tier (usually
this will be the Live tier), and click the "Clear Caches" button.

A third method is to use the Terminus CLI tool, and run the command

```bash
terminus env:clear-cache mitlib-wp-network.live
```

After the cache has been emptied, it will slowly be re-populated as users request various content around the network.

2. Defining cache lifetimes

By default, all WordPress content will be cached for one week (604,800 seconds). This allows most content to be quickly
returned to the user upon request because it does not need to be re-rendered from scratch for each request. This works
well because many of our pages do not change with any great frequency.

Some content on our website _does_ change with greater frequency, however. A good example of this is our library
hours page, which has highlighting that updates every day. In order to avoid showing outdated highlighting, we have set
this page to only be cached for one hour (3,600 seconds).

Other frequently-changing content includes the News site's events page, and the front page of the Exhibits site.

We maintain the list of frequently-changing pages, and their desired cache lengths, as part of the Parent theme in the
[override_cache_default_max_age](https://github.com/MITLibraries/mitlib-wp-network/blob/master/web/app/themes/mitlib-parent/functions.php#L113-L137) function.

3. Clearing specific page caches during editing

While much of our page content does not change frequently, any time a page is edited it becomes necessary to purge that
page from the cache in order for the changes to be seen. This functionality is provided by the [Pantheon Advanced Page Cache plugin](https://wordpress.org/plugins/pantheon-advanced-page-cache/). It is possible to leverage this plugin to define additional cache-clearing logic for some specific scenarios, but we have not yet done so.

4. Known pain points to the Pantheon cache

The biggest current difficultly with this caching setup can be seen when content is loaded in non-standard arrangements
that are not common within WordPress sites. This largely affects custom post types like the Location records or the
Interviewee content type that's part of the Music Oral History site. These post types are never shown on their own, but
are only seen as part of different content records (Location posts are linked to a specific Page record, while
Interviewee content is only seen as part of an Interview record).

Until we can extend the Advanced Page Cache logic to account for these linkages automatically, it is necessary to
manually empty the network cache every time one of these records is updated.

## Libraries CDN

Some branding assets which we load within WordPress are not present in this repository, but are managed as part of the
[Libraries' CDN](https://github.com/MITLibraries/web-images-static). More information about this resource can be found
within the [Static Sites / CDN](https://mitlibraries.atlassian.net/wiki/spaces/IWC/pages/3405086741/Static+Sites+CDN) resource on Confluence.

## References

### Pantheon

The following articles are part of Pantheon's documentation:

* [Overview of Pantheon's Global CDN](https://docs.pantheon.io/guides/global-cdn)
* [Front end performance - caching](https://docs.pantheon.io/guides/frontend-performance/caching)
* [WordPress Cache Plugin](https://docs.pantheon.io/guides/wordpress-configurations/wordpress-cache-plugin)
* [Pantheon Advanced Page Cache plugin](https://wordpress.org/plugins/pantheon-advanced-page-cache/)

### WordPress and PHP

Managing the cache may require familiarity with the following functions provided by WordPress or PHP:

* [get_site_url() [WordPress]](https://developer.wordpress.org/reference/functions/get_site_url/)
* [is_page() [WordPress]](https://developer.wordpress.org/reference/functions/is_page/)
* [parse_url() [PHP]](https://www.php.net/manual/en/function.parse-url.php)

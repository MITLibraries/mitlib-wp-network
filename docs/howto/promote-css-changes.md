# How to promote CSS changes to Live with minimal pain

This document describes the best workflow for promoting changes to CSS styles
to the Live tier in Pantheon, in such a way that they take effect relatively
quickly and without confusion about whether things worked.

## Why this is necessary

Promoting changes to CSS stylesheets can be a tricky proposition, because the
files involved can be cached in many different places. Additionally, many of
our stylesheets are compiled via SCSS - but this does not happen on every page
load on the Test and Live tiers, because it raises performance problems.

As a result, there can at times be a significant delay between deploying a new
set of styles and seeing those changes reflected in users' browsers.

Following the steps below may not eliminate that delay entirely, but should help
reduce it.

## When to follow these steps

Follow this procedure whenever a change in being promoted on Pantheon which
affects any stylesheet in the themes.

These steps should be followed when making the change to either the Live or Test
tiers.

## The procedure

1. Deploy the change via the Code tab on the Pantheon dashboard.
2. In your browser, load a page which should be impacted by the new CSS styles.
   At this point, the change should not yet be visible.
3. Using the developer tools in your browser, identify and directly load the
   compiled stylesheet which holds the updated rules. For the parent theme, this
   will likely be `global.css`, which is compiled using the WP-SCSS plugin.
4. Within that stylesheet, identify whether the style change can be identified.
   If the new styles are not yet visible, continue with this procedure (if the
   styles have been updated and the rendering is still incorrect, there may be a
   bug which requires further development).
5. Log into WordPress, go to the WP-SCSS settings page, and turn on the "Always
   Recompile" option. This setting is off by default on the Test and Live tiers
   for performance reasons.
6. Use the Pantheon dashboard to clear caches for that tier.
7. Wait for a minute or two, to give the caches time to fully clear. This can be
   monitored using the "Workflows" modal on the dashboard.
8. Force-reload the compiled stylesheet opened in step 3. Confirm that the
   updated styles are now included.
9. Force-reload the reference page again (from step 2), and check that the
   intended change is now visible.
10. Once you have seen the change in action, turn off the "Always Recompile"
    setting from step 5.

## A possible roadmap of future adjustments

WordPress has a mechanism for helping to cache-bust this sort of system, which
might be adopted as part of our workflows in the future. In the parent theme,
the line which registers the global stylesheet uses the theme version as a
URL parameter:

**style.css**
```css
/*
Theme Name: MITlib Parent
Author: MIT Libraries
Version: 0.2.1
Description: The parent theme for the MIT Libraries' Pentagram-designed identity.
```

**functions.php**
```php
$theme_version = wp_get_theme()->get( 'Version' );

wp_register_style( 'parent-global', get_template_directory_uri() . '/css/build/global.css', array( 'parent-styles', 'font-open-sans' ), $theme_version );
```

Incrementing the theme version in style.css during development should help
browsers to update their caches.

_A possible future adjustment to this process would be to include the theme
version in the filename itself, rather than just the querystring._

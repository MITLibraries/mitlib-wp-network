# How to troubleshoot a build failure on Pantheon

This document describes some helpful steps to take when you run into a build
failure on Pantheon. These failures are seen most often when creating a brand
new instance.

## Identifying a build failure

A build failure on Pantheon might become evident when creating a multidev initially:

```bash
% terminus multidev:create mitlib-wp-network.live wp66
 [error]  The operation failed to complete. 
```

It might also appear when trying to clone content between tiers:

```bash
 % terminus remote:wp mitlib-wp-network.wp66 -- search-replace libraries.mit.edu wp66-mitlib-wp-network.pantheonsite.io --url=libraries.mit.edu
 [warning] This environment is in read-only Git mode. If you want to make changes to the codebase of this site (e.g. updating modules or plugins), you will need to toggle into read/write SFTP mode first.
Warning: Permanently added 'REACTED' (RSA) to the list of known hosts.
Enter passphrase for key 'REDACTED': 
Error: This does not seem to be a WordPress installation.
The used path is: /code/web/wp/
Pass --path=`path/to/wordpress` or run `wp core download`.
 [notice] Command: mitlib-wp-network.wp66 -- wp search-replace libraries.mit.edu wp66-mitlib-wp-network.pantheonsite.io [Exit: 1]
 [error]
```


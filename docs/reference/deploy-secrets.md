# How we manage build and deploy secrets

This document describes how we deal with the sensitive values necessary to build and deploy our Wordpress application,
in all the places it needs to function.

## The secrets

## Build contexts

### Local (Composer)

### GitHub Actions

### Pantheon

## Where secrets are stored

```bash
% terminus secret:site:list mitlib-wp-network
 ------------- ------------- -------------- --------------- 
  Secret name   Secret type   Secret value   Secret scopes  
 ------------- ------------- -------------- --------------- 
  ...           ...           ...            ...
 ------------- ------------- -------------- --------------- 
```
## Tools

In order to manage this information, you will need the following tools:

* Access to [our shared LastPass account](https://www.lastpass.com/).
* [Composer](https://getcomposer.org)
* Login information for the Libraries' deploy account (which can be found in LastPass).
* Access to [the Actions secrets and variables page](https://github.com/MITLibraries/mitlib-wp-network/settings/secrets/actions)
  for this Github repository, for builds managed by Github Actions.
* The [Terminus CLI tool](https://github.com/pantheon-systems/terminus).

## References

More information about Terminus can be found at [docs.pantheon.io/terminus](https://docs.pantheon.io/terminus).

(Please note that an earlier version of this document referenced the [Terminus Secrets Manager Plugin](https://github.com/pantheon-deprecated/terminus-secrets-manager-plugin).
That plugin's functionality has been folded into Terminus itself.)


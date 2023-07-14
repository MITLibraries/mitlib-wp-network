# How to apply updates from Pantheon

This document will describe the process for keeping our repository up-to-date
with upstream changes introduced by Pantheon.

## Background

Our GitHub repository was created as a fork of Pantheon's [WordPress Composer
Managed](https://github.com/pantheon-systems/wordpress-composer-managed) repository. As Pantheon continues to develop their platform, they
merge changes into their `default` branch - which we need to then incorporate
into our `master` branch.

## Workflow

1. Create a `catchup` branch from `master`, and create a multidev from it.

Doing this now, from a trusted starting point, can make troubleshooting easier.

2. Sync the `default` branch - and only the `default` branch - with the Pantheon
   repository.

**Syncing the entire repository would overwrite all our local development, and
revert us to a blank WordPress site.**

3. Identify which commits on the `default` branch still need to be merged.

Each round of platform updates is marked along the branch with a tag (you'll
create one for this round of updates in step 9), so this step should be
completed by reading the list of commits until you get to a tag.

4. Review this set of commits to identify any concerns.

Ideally all commits will be judged safe to apply. If a subset are desired, pick
that point along the `default` branch.

5. Create a `default#` branch off of the chosen starting point

The number used in this branch name will naturally change over time, obviously.

6. Merge `default#` into `catchup`.

This PR can be merged without review, but may require resolving a merge
conflict in cases where Pantheon makes changes to a file we have also modified.

7. Re-deploy `catchup` to Pantheon, and inspect it for functionality.

This inspection may be something that an individual engineer can evaluate
directly, or may require code review or stakeholder review - at your discretion.
Treat this process as you would any other dependency update, and if you have any
questions you can ask your colleagues for their input.

8. After any needed signoffs and review, merge `catchup` into `master`.

9. Create a tag on the `default` branch marking what was included in the update.

Creating this tag will make it easier to start the next round of updates. The
name for this tag should match the `default#` branch you created in step 5.

10. Delete the `catchup` and `default#` branches.

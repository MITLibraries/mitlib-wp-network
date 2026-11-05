# How to update dependencies managed via NPM

The blocks defined by our locally-developed plugins require the use of NPM during the development workflow. Updating the
tooling required by these blocks can be done via the following process:

1. See the full outdated picture across everything

```bash
npm outdated
```

A sample output from this command should look something like this:

```bash
Package                  Current   Wanted  Latest  Location                              Depended by
@wordpress/block-editor   17.1.0   17.1.0  20.0.0  node_modules/@wordpress/block-editor  mitlib-blocks@1.0.0
@wordpress/block-editor   17.1.0   17.1.0  20.0.0  node_modules/@wordpress/block-editor  mitlib-post-hero-images@1.0.0
@wordpress/blocks        15.27.0  15.27.0  17.1.0  node_modules/@wordpress/blocks        mitlib-blocks@1.0.0
@wordpress/blocks        15.27.0  15.27.0  17.1.0  node_modules/@wordpress/blocks        mitlib-post-hero-images@1.0.0
@wordpress/components     40.1.0   40.1.0  44.0.0  node_modules/@wordpress/components    mitlib-blocks@1.0.0
@wordpress/components     40.1.0   40.1.0  44.0.0  node_modules/@wordpress/components    mitlib-post-hero-images@1.0.0
@wordpress/scripts        34.2.0   34.2.0  37.1.0  node_modules/@wordpress/scripts       mitlib-wp-network
```

2. For WordPress-namespaced packages, prefer the WP-aware updater on a per-plugin basis

```bash
npm run packages-update -w mitlib-blocks
npm run packages-update -w mitlib-post-hero-images
npm run packages-update # This updates anything declared in the root-level package.json
git diff
```

Once this step is complete you should review the new state of `package.json`, as well as the changes to the various
lockfiles.

3. Apply non-WordPress-namespaced dependencies individually

This step may be skippable for plugins which don't declare non-WordPress dependencies.

```bash
npm update <pkg> -w mitlib-blocks -w mitlib-post-hero-images
```

4. Confirm the lock is self-consistent and installable from scratch

```bash
rm -rf node_modules web/app/plugins/*/node_modules
npm ci
```

5. Inspect the basics of the dependency tree

```bash
npm ls --workspaces --depth=0
```

This will show the top level of the dependency tree (`depth=0` will prevent seeing what will likely be a _very_ deep set
of dependencies), broken down by which plugins have declared which packages. In the following sample output, there are
two plugins, each with very similar sets of packages (duplicates are marked with `deduped`)

```bash
mitlib-wp-network@1.0.0 PATH_TO_REPOSITORY_ROOT
├─┬ mitlib-blocks@1.0.0 -> ./web/app/plugins/mitlib-blocks
│ ├── @wordpress/block-editor@20.0.0
│ ├── @wordpress/blocks@17.1.0
│ ├── @wordpress/components@44.0.0
│ ├── @wordpress/core-data@9.1.0
│ ├── @wordpress/data@11.1.0
│ ├── @wordpress/element@10.1.0
│ ├── @wordpress/i18n@7.1.0
│ └── @wordpress/scripts@37.1.0
└─┬ mitlib-post-hero-images@1.0.0 -> ./web/app/plugins/mitlib-post-hero-images
  ├── @wordpress/block-editor@20.0.0 deduped
  ├── @wordpress/blocks@17.1.0 deduped
  ├── @wordpress/components@44.0.0 deduped
  ├── @wordpress/core-data@9.1.0 deduped
  ├── @wordpress/data@11.1.0 deduped
  ├── @wordpress/i18n@7.1.0
  └── @wordpress/scripts@37.1.0
```

6. Run audit to report security problems which remain

```bash
npm audit
```

In an ideal world, this command will have a clean output. However, this may not be feasible if there are packages lower
in the dependency tree which have not themselves published updates yet.

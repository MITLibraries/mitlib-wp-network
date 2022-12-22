# MITlib Post

This plugin defines a Base class, in the Mitlib\PostTypes namespace, which can
then be extended by additional plugins to define various custom post types.

Because of the architecture used by Advanced Custom Fields Pro, this plugin also
provides the `data/` folder used to hold the JSON files which define the list
of custom fields in any implementing plugins.

## Roadmap

An option for future development of this work is to store the field definitions
with the plugins for each type - so the Mitlib Post Exhibits plugin (which
implements a descendent class of the Base class) would store the Exhibits
fields there, rather than here.

One part of that work would be to have the Base class return the descendant
file location, rather than its own. See https://stackoverflow.com/q/3014254 for
one way this might happen.

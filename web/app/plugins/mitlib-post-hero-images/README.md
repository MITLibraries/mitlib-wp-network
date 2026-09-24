# MITlib Post Hero Images

This defines a Hero Image custom post type, extending the Base class provided by
Mitlib Post. Each Hero Image post uses the standard WordPress featured image as
its primary image, along with a set of custom fields used to credit the source
of that image.

The Hero Image post type is also added to the set of content which the
WordPress API publishes, so that it can be consumed by blocks such as the hero
section block.

The fields within this post type are defined in a JSON file that can be found
in the Mitlib Post data folder.

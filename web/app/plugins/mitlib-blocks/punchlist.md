# Punch list for development

## Block definition / data

### Location atom should look up location posts

The Location atom block needs to be a post lookup for the available locations, rather than just accepting a name. I
believe all the fields I need to render are available in the post type (although the post title will be doing double
duty as both the visible location name as well as the data attribute value which the hours loader library looks for)

### Location atom edit.js tweaks

- duplicates the location name between the inspector and the main block display
- hard-coded id attribute should be removed

### useBlockProps is omitted

I need to figure out what this is meant to do, because right now it doesn't make sense to me.

### Translation function

I've counseled against using this if we're not going to translate anything - but LLMs are advising that it return.

### using-atem `blurb` field should be TextareaControl, not TextControl

This would allow us to use em-dashes, if nothing else.

## Block rendering

### Rendering of the using-atom block isn't working as expected

I've defined attributes for things like icon and link, but am unclear yet how to properly render them. The markup
structure I tried defining in save.js isn't working the way I expected it to (and I may need to switch to render.php for
this, but I'm not quite sure what the dividing line is between these two patterns yet)

* ExternalLink is the wrong component to reach for (this is an editor UI component)
* RichText probably isn't the right type of element to be working with either
* Attribute values like `icon` can be `TextControl` and rendered via JSX directly

Suggested markup:
```js
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
    const { headline, blurb, icon, link } = attributes;
    const blockProps = useBlockProps.save();

    return (                     
        <div { ...blockProps }>
            <i className={ `fa-light fa-${ icon }` } aria-hidden="true" role="img"></i>
            <div className="option-box-content">
                <h3><a href={ link }><RichText.Content value={ headline } /></a></h3>
                <p>{ blurb }</p>
            </div>
        </div>
    );
}
```

### location-atom still has static content for the link to the location, and the data attribute value

### Principle between save.js and render.php

* Use save.js when all content is derived from attributes in the block editor (the using-the-libraries atoms are great
here)
* Use render.php when database lookups are needed (the location atom would need render.php if we actually look up an
existing post - but save.js would be fine if all information is defined in the editor)

## Block metadata and editor concerns

### Location blocks in a custom category in the block editor

I've tried simplifying the name of the blocks in block.json, since repeating "MITLIB - " at the start of every block is
leading to confusion about which block does what. However, what I was hoping for was to define a new section of blocks
in the editor interface, in parallel to categories like "TEXT", "MEDIA", or "DESIGN" - but when I specify "MITLIB" as
the category, they show up under "undefined" - which, yes, they're on their own - but this isn't quite what I was hoping
for.

Suggested implementation is to use the `block_categories_all` filter to extend the `$categories` array:
```php
add_filter( 'block_categories_all', function( $categories ) {
  return array_merge(
    array(
      array(
        'slug'  => 'mitlib',
        'title' => 'MIT Libraries',
        'icon'  => null,
      ),
    ),
    $categories
  );
} );
```
_This would be a good time to adopt a PHP class for this plugin..._

### Block icon

I also need to look up the available iconography for "icon" in block.json, and look again at how the preview gets
defined - right now there's a blank spot and "no preview available".

Suggested response is to look at https://developer.wordpress.org/resource/dashicons/

Previews would be generated using the "example" entry in block.json - it looks like we could have static renderings of content in here?



 Location atom save.js has two hardcoded values that attribute-driven rendering hasn't reached yet. The href="/hayden" and data-location-hours="Hayden Library" are both static strings.   
 These need to come from attributes — either from the post lookup once that's implemented, or as interim TextControl attributes. Until they're dynamic, any location other than Hayden     
 will render broken markup.                                                                                                                                                                
                                                                                                                                                                                           
 Location atom edit.js has a confusing duplication. Both the InspectorControls panel and the main canvas have controls for locationName — the TextControl in the panel and the RichText in 
 the canvas both edit the same attribute. Once you move to a post lookup, the canvas representation should become read-only (just displaying the selected location's name), and the panel  
 control becomes the SelectControl for choosing which location. For now the duplication is fine as a scaffold.                                                                             
                                                                                                                                                                                           
 Location atom edit.js has a hardcoded id="todays-hours" on the section element. That ID comes from the parent hours-section block — it shouldn't be on the atom. The atom is a list item, 
 not a section. The edit.js preview wraps things in a <section> that doesn't match the <li> that save.js produces, which will cause confusion when you're visually checking the editor     
 view against the frontend output.                                                                                                                                                         
                                                                                                                                                                                           
 useBlockProps is missing from both atoms' save.js. You've correctly imported and used it in edit.js for both blocks, but neither save.js spreads useBlockProps.save() onto the wrapper    
 element. The using-atom fix is shown above. For location-atom, the wrapper is a <li> — spread it there.                                                                                   
                                                                                                                                                                                           
 The __() translation wrapper is absent from user-facing strings in both blocks' edit.js. The featured-and-events block uses __( 'string', 'mitlib-blocks' ) consistently; these new       
 blocks have bare string literals in PanelBody title and TextControl label props. Consistent use of __() is a good habit even for a site that isn't being translated, and it's what the    
 linter will flag.                                                                                                                                                                         
                                                                                                                                                                                           
 blurb in using-atom is a plain TextControl but is output via <p>{ blurb }</p> in save.js. If the blurb ever needs to contain any formatting — even just an em dash — a TextControl won't  
 preserve it. This is probably fine given the content, but worth a note that TextareaControl would be the right component if the blurb gets longer, consistent with how askUsDescription   
 is handled in the using-the-libraries-section block.    
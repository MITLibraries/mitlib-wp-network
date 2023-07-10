<?php
/**
 * Template-part for displaying icons on SPOTLIGHT CARDS.
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

?>

<!--spotlight -->
<?php
$field = get_field_object( 'feature_type' );
$value = get_field( 'feature_type' );
$label = $field['choices'][ $value ];

switch ( $field['choices'][ $value ] ) {
	case 'Tip':
		$feat_class = 'info';
		break;
	case 'Update':
		$feat_class = 'update';
		break;
	case 'Featured resource':
	case 'Featured collection':
	case 'Featured service':
	case 'Featured exhibit':
	case 'Featured story':
	case 'Featured video':
	case 'In the media':
	case 'Check it out':
		$feat_class = 'or_star-25';
		break;
}
?>
<?php if ( 'spotlights' == $post->post_type ) { ?>
<div class="featuredCol"><?php echo esc_html( $label ); ?></div>
<?php } ?>
<?php if ( 'spotlights' == $post->post_type ) { ?>
<div class="featuredColImg"><div class="<?php echo esc_attr( $feat_class ); ?>"></div> </div>
<?php } ?><!--//spotlight --> 

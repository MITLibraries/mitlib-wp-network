<?php
/**
 * Template Name: Biblio RSS
 *
 * This template is used to display
 * RSS feed for Biblio posts.
 *
 * @package MITlib_News
 * @since 0.1.0
 * @link https://yoast.com/custom-rss-feeds-wordpress/
 */

namespace Mitlib\News;

$numposts = 5;

/**
 * This outputs a formatted timestamp.
 *
 * @param string $timestamp A provided timestamp.
 * @link https://yoast.com/custom-rss-feeds-wordpress/ Source
 */
function yoast_rss_date( $timestamp = null ) {
	$timestamp = ( null == $timestamp ) ? time() : $timestamp;
	echo esc_html( date( DATE_RSS, $timestamp ) );
}

/**
 * This outputs an excerpt of a source string with ellipsis on a word boundary.
 *
 * @param string $string The string to be trimmed.
 * @param int    $length The desired length of excerpt.
 * @param string $replacer The ellipsis or continuation string to indicate truncation.
 * @link https://yoast.com/custom-rss-feeds-wordpress/ Source
 */
function yoast_rss_text_limit( $string, $length, $replacer = '...' ) {
	$string = strip_tags( $string );
	if ( strlen( $string ) > $length ) {
		return ( preg_match( '/^(.*)\W.*$/', substr( $string, 0, $length + 1 ), $matches ) ? $matches[1] : substr( $string, 0, $length ) ) . $replacer; }
	return $string;
}



$args = array(
	'posts_per_page'      => -1,
	'post__not_in'        => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1,
	'post_type'           => 'bibliotech',
	'orderby'             => 'menu_order',
	'order'               => 'ASC',
	'suppress_filters'    => false,
);
$the_query = new \WP_Query( $args );
$lastpost = $numposts - 1;
header( 'Content-Type: application/rss+xml; charset=UTF-8' );
echo '<?xml version="1.0"?>';
?>

<rss version="2.0">
<channel>
	<title>MIT Libraries Bibliotech</title>
	<link>//libraries.mit.edu/news/bibliotech-feed/</link>
	<description>Newsletter published by the MIT Libraries</description>
	<language>en-us</language>
	<pubDate><?php yoast_rss_date( strtotime( $ps[ $lastpost ]->post_date_gmt ) ); ?></pubDate>
	<lastBuildDate><?php yoast_rss_date( strtotime( $ps[ $lastpost ]->post_date_gmt ) ); ?></lastBuildDate>
	<managingEditor>hartman@mit.edu (Stephanie Hartman)</managingEditor>
<?php
while ( $the_query->have_posts() ) :
	$the_query->the_post();
	// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- This is targeted at the yoast_rss_text_limit function below.
	?>

	<item>
	<title><?php echo esc_html( get_the_title( $post->ID ) ); ?></title>
	<link><?php the_permalink_rss( $post->ID ); ?></link>
	<description><?php echo '<![CDATA[' . yoast_rss_text_limit( $post->post_content, 500 ) . '<br/><br/>Keep on reading: <a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . esc_html( get_the_title( $post->ID ) ) . '</a>' . ']]>'; ?></description>
	<pubDate><?php yoast_rss_date( strtotime( $post->post_date_gmt ) ); ?></pubDate>
	<guid><?php echo esc_url( get_permalink( $post->ID ) ); ?></guid>
	</item>
<?php
	// phpcs:enable -- Start scanning again.
endwhile;
?>
</channel>
</rss>

<?php
/**
 * Template Name: Standard Template
 *
 * @package MITlib_Parent
 * @since 0.0.1
 */

namespace Mitlib\Parent;

$content_class = "content";
if (is_active_sidebar('sidebar-1')) {
    $content_class .= " has-sidebar";
}
get_header();
?>

<?php if (is_active_sidebar('sidebar-search')) : ?>
    <div id="sidebar-search" class="widget-area" role="complementary">
        <?php dynamic_sidebar('sidebar-search'); ?>
    </div>
<?php endif; ?>

<?php if (in_category('shortcrumb')) { ?>
    <?php get_template_part('inc/breadcrumbs', 'noChild'); ?>
<?php } else { ?>
    <?php get_template_part('inc/breadcrumbs'); ?>
<?php } ?>


<?php while (have_posts()) : ?>
    <?php the_post(); ?>
    <div id="stage" class="inner" role="main">
        <div id="content" class="<?php echo $content_class; ?>">
            <?php the_content(); ?>
        </div>
    </div>
<?php endwhile; ?>

<?php get_footer(); ?>

<?php
/**
 * Show the appropriate content.
 *
 * @package WordPress
 * @since Mokko 1.0.0
 */

?>

<div class="post-content">

    <?php if ( !has_post_thumbnail() ) : ?>

        <div class="post-top">

            <?php if ( is_sticky() ) : ?>
                <div class="ms-sticky no-thumbnail">
                    <span class="ms-sticky--icon"><?php esc_html_e('Feautured', 'mokko'); ?></span>
                </div>
            <?php endif;?>

        </div>

    <?php endif; ?>
        		
	<a href="<?php the_permalink(); ?>">
		<h2><?php the_title(); ?></h2>
	</a>

    <div class="post-meta-header">

        <div class="post-meta__info">

            <div class="card__header">
                <span class="post-meta__date"><?php echo get_the_date(); ?></span>
                <span class="ms-p--ttr"><?php echo mokko_reading_time(get_the_ID()); ?></span>
            </div>

        </div>

    </div>

	<?php if ( isset( $show_excerpt_list)  ) {
		if ( $show_excerpt_list == 'on' ) {
			echo mokko_get_excerpt(get_the_ID(), $excerpt_length);
		}
	} else {
		echo mokko_get_excerpt(get_the_ID(),'240');
	} ?>

    <div class="post-category__list"><span><?php esc_html_e('Category:', 'mokko'); ?></span><?php the_category('&nbsp;'); ?></div>

	<div class="post-footer">

        <a href="<?php the_permalink(); ?>">
            <span><?php esc_html_e('Read Article', 'mokko'); ?></span>
        </a>

	</div>

</div>
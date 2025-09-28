<?php 
/**
 * @author: MadSparrow
 * @version: 1.0
 */
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) { exit( 'Direct script access denied.' ); }

$item_class = 'grid-item col-sm-12 col-md-6 col-lg-' . $col_numb; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($item_class); ?>>

    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>"></a>

    <?php if ( has_post_thumbnail() ) : ?>

        <figure class="ms-posts--card__media">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute() ?>">
        </figure>

    <?php endif; ?>

    <div class="post-content">

        <?php if ( is_sticky() ) : ?>

            <div class="ms-sticky">
                <span class="ms-sticky--icon"><?php esc_html_e('Feautured', 'mokko'); ?></span>
            </div>

        <?php endif;?>

        <div class="post-meta-header">

            <div class="post-header--author">

                <img src="<?php echo get_avatar_url( get_the_author_meta('email'), array("size"=>45)); ?>" alt="<?php echo get_the_author(); ?>">

                <div class="post-meta__info">
                    <span class="post-meta__author"><?php echo get_the_author(); ?></span>
                    <span class="post-meta__date"><?php echo get_the_date(); ?></span>
                </div>

            </div>

        </div>    

        <div class="post-meta-cont">
            <div class="post-category"><?php the_category(',&nbsp'); ?></div>
            <div class="post-header">
                <a class="post-title" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                    <h3><?php the_title(); ?></h3>
                </a>
            </div>
        </div>

    </div>

</article>

<?php
/**
 * @author: MadSparrow
 * @version: 1.0
 */

get_header();

$a_id = $post->post_author;
$prev = get_previous_post();
$next = get_next_post();
$related_cats_post = mokko_related_posts(); 
$format = get_post_format();

get_template_part( 'template-parts/header/header');

?>

<main class="ms-main ms-single-post" data-scroll-section>

    <header class="ms-sp--header">
        <div class="post-meta-date meta-date-sp">
			<span class="post-author__name"><?php the_author_meta( 'display_name', $a_id ); ?></span>
			<span><?php echo get_the_date(); ?></span>
		</div>
		<?php the_title( '<h1 class="ms-sp--title">', '</h1>' ); ?>
        <div class="post-category__list">
			<?php the_category(); ?>
		</div>
	</header>

	<?php if( class_exists('ACF') ) : ?>

		<?php if ( $format == '' ) : ?>
			<?php get_template_part( 'template-parts/excerpt/parts/media', 'thumbnail-single' ); ?>
		<?php else: ?>
		<div class="ms-single-post--img">
			<?php if ( $format !== 'gallery' && $format !== 'video' && $format !== 'quote' ) : ?>
				<?php get_template_part( 'template-parts/excerpt/parts/media', 'thumbnail-single' ); ?>
			<?php endif; ?>
			<?php get_template_part( 'template-parts/excerpt/parts/media', $format ); ?>
		</div>
		<?php endif; ?>

	<?php else: ?>
		<?php get_template_part( 'template-parts/excerpt/parts/media', 'thumbnail-single' ); ?>
	<?php endif; ?>

	<article class="ms-sp--article">
		<div class="entry-content">
			<?php 
			// Instead of Mokko's manual ACF blocks, inject your Elementor Template
			echo do_shortcode('[elementor-template id="4773"]'); 
			?>
		</div>
	</article>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer default-max-width">
			<?php edit_post_link(
				sprintf( '<span class="meta-icon"><svg class="svg-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"><path fill="" d="..."></path></svg>' . esc_html__( 'Edit %s', 'mokko' ) . '</span>',
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				), '<span class="edit-link">', '</span>'
			); ?>
		</footer>
	<?php endif; ?>

    <?php if(has_tag()) : ?>
        <div class="single-post__tags">
            <?php the_tags( '', '', '' ); ?>
        </div>
    <?php endif; ?>

    <?php mokko_show_share_post(); ?> 

	<?php if (!empty($prev) OR !empty($next)) : ?>
		<nav class="navigation post-navigation">
			<div class="nav-links">
				<div class="nav-previous">
					<?php if (!empty($prev)) : ?>
						<a href="<?php echo get_permalink($prev->ID); ?>" rel="prev">
							<div class="prev-post">
								<div class="ms-spp">
									<span class="nav-label" aria-hidden="true"><?php esc_html_e('Previous Article', 'mokko'); ?></span>
									<h3 class="post-title"><?php echo esc_html($prev->post_title); ?></h3>
								</div>
							</div>
						</a>
					<?php endif ?>
				</div>
				<div class="nav-next">
					<?php if (!empty($next)) : ?>
						<a href="<?php echo get_permalink($next->ID); ?>" rel="next">
							<div class="next-post">
								<div class="ms-spn">
									<span class="nav-label" aria-hidden="true"><?php esc_html_e('Next Article', 'mokko'); ?></span>
									<h3 class="post-title"><?php echo esc_html($next->post_title); ?></h3>
								</div>
							</div>
						</a>
					<?php endif ?>
				</div>
			</div>
		</nav>
	<?php endif; ?>

	<?php if($related_cats_post->have_posts()): ?>
		<section class="ms-related-posts">
			<div class="alignwide">
				<h2 class="ms-rp--title"><?php esc_html_e('Related Posts', 'mokko'); ?></h2>
				<?php while($related_cats_post->have_posts()): $related_cats_post->the_post(); ?>
					<article class="ms-rp--block">
						<div class="ms-rp--inner">
							<div class="rp-inner__left">
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute (); ?>">
									<?php if( has_post_thumbnail() ):?>
										<figure class="ms-rp--thumb">
											<?php the_post_thumbnail('mokko-card-post-thumb', array( 'alt' => get_the_title())); ?>
										</figure>
									<?php endif; ?>
								</a>
							</div>
							<div class="rp-inner__right">
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute (); ?>">
									<div class="ms-rp--cont">
										<div class="ms-rp--text">
											<h3 class="ms-rp__title"><?php the_title(); ?></h3>
                                            <span class="ms-rp__date"><?php echo get_the_date(); ?></span>
                                            <span class="ms-rp--ttr"><?php echo mokko_reading_time(get_the_ID()); ?></span>
											<div><?php echo mokko_get_excerpt(get_the_ID(),'140');?></div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>
	
</main>

<?php get_footer(); ?>


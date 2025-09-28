<?php 
/**
 * @author: MadSparrow
 * @version: 1.0
 */

get_header();

$id = get_the_ID();

get_template_part( 'template-parts/header/header');

?>
<main class="ms-main" data-scroll-section>

    <div class="ms-content--portfolio">
        <?php while ( have_posts() ) : the_post();
            the_content();
        endwhile; ?>
    </div>

    <div class="ms-spn--wrap container">
        <div class="ms-spn--content row">
            <?php echo mokko_portfolio_nav_prev( $id ); ?>
        </div>
    </div>
    
</main>

<?php get_footer(); ?>

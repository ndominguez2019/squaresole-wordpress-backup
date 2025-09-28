<?php
/**
 * @author: MadSparrow
 * @version: 1.0
 */
?>

<?php if ( has_post_thumbnail() ) : ?>
		
    <?php if ( is_sticky() ) : ?>

        <div class="post-top">

            <?php if ( is_sticky() ) : ?>
                <div class="ms-sticky thumbnail">
                    <span class="ms-sticky--icon"><?php esc_html_e('Feautured', 'mokko'); ?></span>
                </div>
            <?php endif;?>

        </div>
        
    <?php endif;?>

<?php endif; ?>
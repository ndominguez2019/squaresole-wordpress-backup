<nav class="main-header__nav js-main-header__nav main-header__default" id="main-header-nav">
    <?php if ( has_nav_menu( 'primary-menu' ) ) {  mokko_default_menu(); } ?>
</nav>

<?php if ( mokko_menu_widgets_check() == true ) : ?>

    <div class="main-header__widgets">

        <div class="main-header--widgets">
            
            <?php if ( MOKKO_WOOCOMMERCE ) {
                    if ( is_woocommerce() || is_cart() ) { 
                        mokko_menu_widgets(); 
                    }
                }

                mokko_mode_switcher();
                mokko_search_widgets();
                
            ?>

        </div>

    </div>

<?php endif; ?>

<button class="main-header__nav-trigger js-main-header__nav-trigger menu-default" aria-label="Toggle menu" aria-expanded="false" aria-controls="main-header-nav">
    <i class="main-header__nav-trigger-icon" aria-hidden="true"></i>
</button>
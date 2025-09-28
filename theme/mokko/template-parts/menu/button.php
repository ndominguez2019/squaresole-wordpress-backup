<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
    
    <div class="main-header__widgets">

        <div class="main-header--widgets">
            
            <?php if ( MOKKO_WOOCOMMERCE ) {
                    if ( is_woocommerce() || is_cart() ) { mokko_menu_widgets(); }
                }

                mokko_mode_switcher();
                mokko_search_widgets();
                
            ?>

        </div>

        <div class="container-menu ms-h_w">
            <div class="action-menu">
                <div class="menu-text">
                    <span><?php esc_html_e('Menu', 'mokko'); ?></span>
                </div>
                <div class="menu-lines">
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                </div>
            </div>
        </div>

        <div class="ms-menu-wrapper">
            <div class="ms-menu">
                <div class="ms-menu-container">
                    <?php if ( has_nav_menu( 'primary-menu' ) ) {  mokko_primary_menu(); } ?>
                </div>
            </div>
        </div>

        <div class="close-menu-bg"></div>

    </div>

<?php endif; ?>
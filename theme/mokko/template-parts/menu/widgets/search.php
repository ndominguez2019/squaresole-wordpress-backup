<?php

?>

<div class="header__search-icon ms-h_w">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#4F5663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M21 21L16.65 16.65" stroke="#4F5663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</div>

<div class="header__search-modal data-scroll-section">

    <button class="header__search--close-btn">
        <svg class="icon icon--sm" viewBox="0 0 24 24">
            <title>Close modal window</title>
            <g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="3" x2="21" y2="21"></line>
                <line x1="21" y1="3" x2="3" y2="21"></line>
            </g>
        </svg>
    </button>

    <div class="header__search--inner">

        <?php 

            if ( MOKKO_WOOCOMMERCE ) {
            
                mokko_search_woo();

            } else {
                get_search_form();
            }
            
        ?>

    </div>
</div>
<?php if ( ! defined( 'ABSPATH' ) ) { exit( 'Direct script access denied.' ); }

// Menu
function mokko_primary_menu() {

    $manu_class = 'navbar-nav';

    if ( ! class_exists( 'acf' ) ) {
        $manu_class = 'navbar-nav';
    } else {
        if ( get_field('menu_variation') ) {
            
            if (get_field('menu_variation') == 'default') {
                $manu_class = 'navbar-nav';
            } else {
                $manu_class = 'navbar-nav-button';
            }        
        }     
    }

    echo wp_nav_menu( array(
        'theme_location' => 'primary-menu',
        'container' => true,
        'depth' => 3,
        'menu_id'        => 'primary-menu-button',
        'menu_class'     => $manu_class,
    ) );
}

function mokko_default_menu() {

    $manu_class = 'navbar-nav';
    echo wp_nav_menu( array(
        'theme_location' => 'primary-menu',
        'container' => true,
        'depth' => 3,
        'menu_id'        => 'primary-menu-default',
        'menu_class'     => $manu_class,
    ) );
}

// Theme Mode
function mokko_theme_mode() {
    if(get_theme_mod( 'mode_switcher' )) {
        $out = mokko_theme_mode_cookie();
    } else {
        if(get_theme_mod( 'theme_mode' )) {
            $out = get_theme_mod( 'theme_mode' );
        } else {
            $out = "light";
        }
    }
    return $out;
}

function mokko_theme_mode_cookie() {
    if (empty($_COOKIE["theme-mode"])) {
        if(get_theme_mod( 'theme_mode' )) {
            $theme_mode = get_theme_mod( 'theme_mode' );
        } else {
            $theme_mode = 'light';
        }
        return $theme_mode;
    }
    
    if(!isset($_COOKIE["theme-mode"])) {
        $theme_mode = get_theme_mod( 'theme_mode' );
    } else {
        $theme_mode = $_COOKIE["theme-mode"];
    }
    return $theme_mode;

}
function mokko_theme_mode_cheked() {

    $theme_mode = mokko_theme_mode_cookie();
    if ($theme_mode === 'light') {
        $cheked = 'checked';
    } else {
        $cheked = '';
    }
    return $cheked;
    
}

// Menu Type
function mokko_menu_type() {

    $menu_type = 'default';
    
    if ( class_exists('ACF') && get_field( 'choiсe_menu_page' ) && get_field( 'choiсe_menu_page' ) !== 'global_settings') {
        get_template_part( 'template-parts/menu/' . get_field( 'menu_type_page' ), get_post_format() );
    } else {
        if ( get_theme_mod( 'menu_type' ) ) {
            $menu_type = get_theme_mod( 'menu_type' );
            get_template_part( 'template-parts/menu/' . $menu_type, get_post_format() );
        } else {
            get_template_part( 'template-parts/menu/default', get_post_format() );
        }
    }


}

// Menu Widgets
function mokko_menu_widgets() {

    if ( get_theme_mod( 'cart_widget' ) === true ) {
        get_template_part( 'template-parts/menu/widgets/cart' );
    } 
    
}

function mokko_search_widgets() {

    if ( get_theme_mod( 'search_widget' ) === true ) {
        get_template_part( 'template-parts/menu/widgets/search' );
    } 

}

function mokko_menu_widgets_check() {
    if( get_theme_mod( 'mode_switcher' ) && get_theme_mod( 'mode_switcher' ) == '1') {
        $widgets_available = true;
    } elseif (get_theme_mod( 'search_widget' ) && get_theme_mod( 'search_widget' ) === true) {
        $widgets_available = true;
    } elseif ( MOKKO_WOOCOMMERCE ) {
        $widgets_available = true;
        if ( is_woocommerce() || is_cart() ) { 
            mokko_menu_widgets(); 
        }
    } else {
        $widgets_available = false;
    }
    return $widgets_available;
}

function mokko_mode_switcher() {

    if( get_theme_mod( 'mode_switcher' ) && get_theme_mod( 'mode_switcher' ) == '1') {
        get_template_part( 'template-parts/menu/widgets/switcher' );
    } 

}

function mokko_search_woo() {

    if ( is_woocommerce() || is_cart() ) { 
        get_product_search_form(); 
    } else {
        get_search_form();
    }

}

function mokko_page_transition() {

    if(get_theme_mod( 'page_transition' ) && get_theme_mod( 'page_transition' ) == '1') {
        $transition = '<div id="loaded"></div>';
        return $transition;
    }

}

// Elementor Templates List Footer
function ms_get_elementor_templates( $type = '' ) {

    $args = [
        'post_type' => 'elementor_library',
        'posts_per_page' => -1,
    ];

    if ( $type ) {

        $args[ 'tax_query' ] = [
            [
                'taxonomy' => 'elementor_library_type',
                'field' => 'slug',
                'terms' => $type,
            ],
        ];

    }

    $page_templates = get_posts( $args );

    $options[0] = esc_html__( 'Select a Template', 'mokko' );

    if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ) {
        foreach ( $page_templates as $post ) {
            $options[$post->ID] = $post->post_title;
        }
    } else {

        $options[0] = esc_html__( 'Create a Template First', 'mokko' );

    }

    return $options;

}

// Smooth Scroll
function mokko_smooth_scroll() {
    if(get_theme_mod( 'smooth_scroll' ) && get_theme_mod( 'smooth_scroll' ) == '1') {
        $out = 'on';
    } else {
        $out = 'off';
    }
    return $out;
}

// Smooth Scroll BTT Button
function mokko_bttb_target() {
    $out = '';
    if ( get_theme_mod('top_btn') && get_theme_mod('top_btn') == '1' ) {
        $out = '<div data-scroll-section id="top" class="home"></div>';
    }
    return $out;
}

function ms_render_elementor_template( $template ) {

    if ( ! $template ) {
      return;
    }

    if ( 'publish' !== get_post_status( $template ) ) {
      return;
    }
    if ( did_action( 'elementor/loaded' ) ) {
        $new_frontend = new Elementor\Frontend;
        return $new_frontend->get_builder_content_for_display( $template, false );        
    }

}

// Footer query
function mokko_get_footer() {
    $args = array(
        'post_type' => 'elementor_library',
        'posts_per_page' => -1,
    );

    $ps = get_posts( $args );
    return $ps;
}

function mokko_show_share_post() {

    if( get_theme_mod( 'share_post' ) && get_theme_mod( 'share_post' ) == '1') {
        echo mokko_share_post();
    } 

}

// Sanitize Class
if ( ! function_exists( 'mokko_sanitize_class' ) ) {
  function mokko_sanitize_class( $class, $fallback = '' ) {

    if ( is_string( $class ) ) {
      $class = explode( ' ', $class );
    }

    if ( is_array( $class ) && count( $class ) > 0 ) {
      $class = array_map( 'sanitize_html_class', $class );
      return implode( ' ', $class );
    } else {
      return sanitize_html_class( $class, $fallback );
    }

  }
}

// Header Class
function mokko_header_class() {

    if( class_exists('acf')) {
        if ( get_field( 'choiсe_menu_page' ) && get_field( 'choiсe_menu_page' ) !== 'global_settings') {
            $h_ac = mokko_header_custom_page();
        } else {
            $h_ac = mokko_header_global_settings();
        }
    } else {
        $h_ac = mokko_header_global_settings();
    }

    $menu_class = 'main-header js-main-header auto-hide-header' . $h_ac;

    return mokko_sanitize_class($menu_class);

}

// Header Global Settings
function mokko_header_global_settings() {

    if ( get_theme_mod('menu_type') == 'default' ) {
        $default = 'right';
        if ( get_theme_mod('menu_align') ) {
            $menu_align = ' menu-' . get_theme_mod('menu_align', $default);
        } else {
            $menu_align = ' menu-right';
        }
    } else {
        $menu_align =  ' menu-right';
    }
    
    $menu_class = 'main-header js-main-header auto-hide-header' . $menu_align;

    return $menu_class;
}

// Header Custom Settings
function mokko_header_custom_page() {

    if( class_exists('acf')) {

        if ( get_field( 'choiсe_menu_page' ) && get_field( 'choiсe_menu_page' ) !== 'global_settings') {

            if ( get_field('header_transparent') ) {
                $h_transparent = (get_field('header_transparent') == '1' ? ' ms-nb--transparent' : '');
            } else {
                $h_transparent = '';
            }
    
            if ( get_field('header_white') && get_field('header_transparent') ) {
                $h_white = (get_field('header_white') == '1' ? ' ms-nb--white' : '');
            } else {
                $h_white = '';
            }
    
            if ( function_exists('get_field') && get_field('full_width') ) {
                $full_width = get_field('full_width') ? ' full-width' : '';
            } else {
                $full_width = '';
            }

            if ( get_field('menu_type_page') === 'default' ) {
                $menu_align = ' menu-' .  get_field('menu_align_page');
            } else {
                $menu_align = ' menu-right';
            }

            $h_ac = 'main-header js-main-header auto-hide-header' . $h_transparent . $full_width . $h_white . $menu_align;

        } else {
            $h_ac = '';
        }
    } else {
        $h_ac = '';
    }

    return $h_ac;
}

// Header Type
function mokko_header_type() {
    $header_style = 'default';
    $default = 'default';
    if ( function_exists('get_theme_mod') ) {
        $header_style = get_theme_mod( 'type_header', $default );
    }
    return $header_style;
}

// Posts Loop
function mokko_posts_loop($items, $cat, $post_id, $order, $orderby) {

    $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'paged' => $paged,
            'posts_per_page' => $items,
            'category_name' => $cat,
            'post__in' => $post_id,
            'orderby' => $orderby,
            'order' => $order
        );
    $query = new WP_Query($args);
    return $query;
}

// Posts Pagination
function mokko_posts_pagination( $new_query = '' ) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if ( $new_query == '' ) {
        global $wp_query;
        $new_query = $wp_query;
    } 
    /* Stop the code if there is only a single page page */
    if( $new_query->max_num_pages <= 1 )
        return;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $new_query->max_num_pages );
    /*Add current page into the array */
    if ( $paged >= 1 )
        $links[] = $paged;
    /*Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    echo '<nav class="pagination" aria-label="Pagination"><ol class="pagination__list">' . "\n";
    /*Display Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="page-item prev">%s </li>' . "\n", get_previous_posts_link(esc_html( 'Previous', 'mokko' )) );
    /*Display Link to first page*/
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class=""' : '';
        printf( '<li%s class=""><a href="%s" class="pagination__item">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
        if ( ! in_array( 2, $links ) )
            echo '<li class=""><span>…</span></li>';
    }
    /* Link to current page */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="page-item active"' : '';
        printf( '<li%s><a href="%s" class="pagination__item">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
    /* Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li class="display--sm">…</li>' . "\n";
        $class = $paged == $max ? ' class="display--sm"' : '';
        printf( '<li%s class="display--sm"><a href="%s" class="pagination__item pagination__item--ellipsis">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link('Next', $max) )
        printf( '<li class="page-item next">%s </li>' . "\n", get_next_posts_link( esc_html( 'Next', 'mokko' ), $max) );
    echo '</ol></nav>' . "\n";
}

// Related Posts
function mokko_related_posts() {

$post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category( $post_id );

    if(!empty($categories) && !is_wp_error($categories)):
        foreach ($categories as $category):
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);

    $query_args = array( 
        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => array($post_id),
        'posts_per_page'  => '3',
     );

    $related_cats_post = new WP_Query( $query_args );

    return $related_cats_post;
}

// Socials Custom Plugin
function mokko_twitter_share() {
    $posttags = get_the_tags();
    if ($posttags) {
        foreach($posttags as $tag) {
            echo strtolower('#' . $tag->name . ', '); 
        }
    }
}

// Estimated reading time
function mokko_reading_time($id) {

    $content = get_post_field( 'post_content', $id );
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil($word_count / 200);
    $timer = esc_html( ' min read', 'mokko' );

    $totalreadingtime = $readingtime . $timer;
    return $totalreadingtime;
    
}

// Custom Comments
function mokko_comments( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	
	switch ( $comment->comment_type ) :
		case 'pingback':
		case 'trackback':
		?>
        <li class="post pingback" id="comment-<?php comment_ID(); ?>">
        	<div class="pingback ms-author-name"><?php comment_author_link(); ?></div>
        	<div class="post-date"><?php comment_date(); ?></div>
        	<div class="ms-commentcontent"><?php comment_text();  ?></div>
        	<?php edit_comment_link( __( 'Edit', 'mokko' ), '<span class="edit-link">', '</span>' ); ?></p>
    	</li>
		<?php 
		break;
		default: 
		?>
            <li id="comment-<?php comment_ID(); ?>">
            <div <?php comment_class(); ?>>
				<div class="ms-comment-body">
                    <div class="ms-author-vcard">
                        <figure class="avatar__figure" role="img" aria-label="Avatar">
                                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                            <div class="avatar__img"><?php echo get_avatar( $comment, 50 ); ?></div>
                        </figure>
                    </div>
					<div class="ms-author-vcard-content">
                        <div class="ms-author-vcard--info">
                            <div class="ms-author-name"><?php comment_author(); ?></div>
                            <span class="ms-comment-time"><?php comment_date(); ?></span>
                        </div>					
						<div class="ms-commentcontent">
							<?php comment_text(); ?>
                            <div class="ms-comment-footer">
							<div class="ms-comment-edit">
                                <?php edit_comment_link( $text = '<svg height="14px" version="1.1" viewBox="0 0 24 24" width="14px"><path d="M21.635,6.366c-0.467-0.772-1.043-1.528-1.748-2.229c-0.713-0.708-1.482-1.288-2.269-1.754L19,1C19,1,21,1,22,2S23,5,23,5  L21.635,6.366z M10,18H6v-4l0.48-0.48c0.813,0.385,1.621,0.926,2.348,1.652c0.728,0.729,1.268,1.535,1.652,2.348L10,18z M20.48,7.52  l-8.846,8.845c-0.467-0.771-1.043-1.529-1.748-2.229c-0.712-0.709-1.482-1.288-2.269-1.754L16.48,3.52  c0.813,0.383,1.621,0.924,2.348,1.651C19.557,5.899,20.097,6.707,20.48,7.52z M4,4v16h16v-7l3-3.038V21c0,1.105-0.896,2-2,2H3  c-1.104,0-2-0.895-2-2V3c0-1.104,0.896-2,2-2h11.01l-3.001,3H4z"/></svg>Edit' ); ?></div>
							<div class="ms-comment-reply">
								<?php comment_reply_link( array_merge( $args, array(
									'reply_text' => '<svg height="16px" version="1.1" viewBox="0 0 16 16" width="14px"><g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g fill="none" class="group" transform="translate(0.000000, -336.000000)"><path d="M0,344 L6,339 L6,342 C10.5,342 14,343 16,348 C13,345.5 10,345 6,346 L6,349 L0,344 L0,344 Z M0,344"/></g></g></svg>Reply',
									'depth' => $depth,
									'max_depth' => $args['max_depth'] 
								) ) ); ?>
							</div>
						</div>
						</div>
					</div>
				</div>
            </div>
   	<?php
        break;
    endswitch;
}

// Blog Custom Comments
function mokko_comments_number() {

	$comment_count = get_comments_number();
	printf(
	    '<span>' . esc_html( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title', 'mokko' ) ),
	    number_format_i18n( get_comments_number() ) . '</span>',
        '<span>' . get_the_title() . '</span>'
	);	
}

// Pagination
function mokko_link_pages() {
    wp_link_pages( array(
        'before'      => '<div class="page-links">' . __( 'Pages:', 'mokko' ),
        'after'       => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after'  => '</span>',
    ) );
}

// Portfolio Filter
function mokko_filter_category() {
    if ( isset($_GET['category']) ) {
        $out = $_GET['category'];
    } else {
        $out = '';
    }
    return $out;
}

// Portfolio Loop
function mokko_portfolio_loop( $cat, $items, $post_id ) {
   
    if ($cat == '') {
        $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type'      => 'portfolios',
            'post_status'    => 'publish',
            'posts_per_page' => $items,
            'paged'          => $paged,
            'post__in' => $post_id
        );  
    } else {
        $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type'      => 'portfolios',
            'post_status'    => 'publish',
            'posts_per_page' => $items,         
            'paged'          => $paged,
            'post__in' => $post_id,
            'tax_query' => array(
                array(
                    'taxonomy' => 'portfolios_categories',
                    'field'    => 'slug',
                    'terms' => $cat
                )
            )
        );  
    }
    $query = new WP_Query($args);
    return $query;
}

// Get Works Taxonomy
if ( !function_exists( 'mokko_works_category' ) ) {
    function mokko_work_category($post_id) {
        $terms = wp_get_post_terms($post_id, 'portfolios_categories');
        $count = count($terms);
        $slug = '';
        $out = '';
        if ( $count > 1 ) {
            foreach ( $terms as $term ) {
                $out = implode(', ', array_map(function($term) { return $term->slug; }, $terms));
            }
        } else {
           foreach ( $terms as $term ) {
               $out = $term->name;
            } 
        }
        return $out;
    }
}

// Portfolio pagination
function mokko_portfolio_pagination($total_pages, $btntext, $load_btn) {

    $total = $total_pages;
    $out = '<div class="btn-wrap ajax-area' . $load_btn . '" data-max="' . $total . '">';
    $out .= '<div class="btn btn-load-more btn--md">';
    $out .= '<span class="load-more-icon"><svg class="load-filter-icon" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><circle cx="50" cy="50" r="30" stroke-width="6" stroke-linecap="round" fill="none"><animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1"></animateTransform><animate attributeName="stroke-dasharray" repeatCount="indefinite" dur="1s" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1"></animate></circle></svg></span>';
    $out .= '<span class="load-more-text">' . $btntext . '</span>';
    $out .= '</div>';
    $out .= '</div>';
    return $out;

}

//Infinite next and previous post looping in WordPress
// Single Portfolio Page Next Link

function mokko_portfolio_nav_prev( $id ) {

    $count_posts = wp_count_posts( 'portfolios' )->publish;

    if ( $count_posts > 1 ) {

        if ( get_previous_post() == true ) {
            $prevPost = get_previous_post();
            $prevTitle = get_the_title($prevPost);
            $link = get_permalink( get_adjacent_post(false,'',true)->ID );
            $img = get_the_post_thumbnail_url( $prevPost->ID, 'mokko-portfolio-nav-thumb');
            $out = '<div class="ms-spn--text col-md-4">';
            $out .= '<div class="ms-spn--head">';
            $out .= '<h3>' . esc_html__('Next Project', 'mokko') . '</h3>';
            $out .= '</div>';
            $out .= '</div>';
            $out .= '<div class="col-md-4"><a href="' . $link . '" class="ms-spn--thumb">';
            $out .= '<img src="' . $img . '" />';
            $out .= '</a></div>';
            $out .= '<div class="col-md-4"><a href="' . $link . '" class="ms-spn--title">';
            $out .= '<h1>' . $prevTitle . '</h1>';
            $out .= '</a></div>';
            return $out;
        } else {
    
            $first = new WP_Query( array(
                'post_type'      => 'portfolios',
                'post_status'    => 'publish',
                'posts_per_page' => 2,
                'post__not_in'   => array( $id ),
                'order' => 'DESC',
            ));
    
            $first->the_post();
    
            $prevPost = get_previous_post();
            $prevTitle = get_the_title($prevPost);
            $img = get_the_post_thumbnail_url($post = '', 'mokko-portfolio-nav-thumb');
            $out = '<div class="ms-spn--text col-md-4">';
            $out .= '<div class="ms-spn--head">';
            $out .= '<h3>' . esc_html__('Next Project', 'mokko') . '</h3>';
            $out .= '</div>';
            $out .= '</div>';
            $out .= '<div class="col-md-4"><a href="' . get_permalink() . '" class="ms-spn--thumb">';
            $out .= '<img src="' . $img . '" />';
            $out .= '</a></div>';
            $out .= '<div class="col-md-4"><a href="' . get_permalink() . '" class="ms-spn--title">';
            $out .= '<h1>' . get_the_title() . '</h1>';
            $out .= '</a></div>';
            
            return $out;
            wp_reset_postdata();
        };

    }

}

// Single Portfolio Page Prev Link
function mokko_portfolio_nav_next() {
    if (get_next_post() == true) {
        $nextPost = get_next_post();
        $nextTitle = get_the_title( get_next_post() );
        $out_title = '<div class="ms-spn--text"><svg width="80" height="11" viewBox="0 0 80 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="ms-spn--arrow"><g><path d="M0 5.09961H74.7" stroke-width="0.922" stroke-miterlimit="10"></path> <path d="M74.5 0.299805L79.3 5.0998L74.5 9.8998" stroke-width="0.922" stroke-miterlimit="10"></path></g></svg><h1>' . esc_html__('Previous', 'mokko') . '</h1><h3>' . $nextTitle . '</h3></div>';
        $nextThumbnail = get_the_post_thumbnail( $nextPost->ID) . $out_title ;
        next_post_link( '%link', $nextThumbnail );
    }
    else {
        $last = new WP_Query( array(
            'post_type'      => 'portfolios',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'order' => 'ASC',
        ));

        $last->the_post();

        $img = get_the_post_thumbnail_url($post = '');
        $out = '<a href="' . get_permalink() . '">';
        $out .= '<img src="' . $img . '" />';
        $out .= '<div class="ms-spn--text"><svg width="80" height="11" viewBox="0 0 80 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="ms-spn--arrow"><g><path d="M0 5.09961H74.7" stroke="white" stroke-width="0.922" stroke-miterlimit="10"></path> <path d="M74.5 0.299805L79.3 5.0998L74.5 9.8998" stroke="white" stroke-width="0.922" stroke-miterlimit="10"></path></g></svg><h1>' . esc_html__('Previous', 'mokko') . '</h1><h3>';
        $out .=  get_the_title();
        $out .=  '</h3></div>';
        $out .= '</a>';

        return $out;
        wp_reset_postdata();
    }
}

// Load More Button
if( !function_exists( 'mokko_infinity_load' ) ){

    function mokko_infinity_load($query) {
    
        $max_page = $query->max_num_pages;
        $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
        $display = false;
        $link_url = c_next_posts($max_page, $display);
        wp_localize_script( 'mokko-main-script', 'infinity_load', array(
                'startPage' => $paged,
                'maxPages' => $max_page,
                'nextLink' => $link_url
        ) );

    }

    // Check link for php8.1
    function c_next_posts( $max_page, $display ) {
        $link = get_next_posts_page_link( $max_page );
    
        $output = '';
        if( $link ){
            $output = esc_url( $link );
        }
            
            if ( $display ) {
                    echo esc_html($output);
            } else {
                    return $output;
            }
    }

}

// Custom Excertp
function mokko_get_excerpt( $id, $count ){
   $permalink = get_permalink( $id );

   $excerpt = get_the_excerpt();
   $excerpt = strip_tags( $excerpt );
   $excerpt = mb_substr( $excerpt, 0, $count );
   $excerpt = mb_substr( $excerpt, 0, strripos( $excerpt, " " ) );
   $excerpt = rtrim( $excerpt, ",.;:- _!$&#" );
   $excerpt = '<p class="post-excerpt">' . $excerpt . '...' . '</p>';

   return $excerpt;
}

// Custom excerpt lenght
add_filter( 'excerpt_length', function($length) {
    return 24;
}, PHP_INT_MAX );

// WooCommerce

// Live cart-count
function mokko_cart_count() {
    if ( WC()->cart->get_cart_contents_count() > 0 ) {
        $cart_count = '<span>' . WC()->cart->get_cart_contents_count() . '</span>';
    } else {
        $cart_count = '';
    }
    return $cart_count;
}

// Allow SVG in WordPress media library
function mokko_display_svg_in_media_library( $response, $attachment, $meta ) {
    if ( $response['mime'] == 'image/svg+xml' ) {
        $response['sizes']['full'] = array(
            'url' => $response['url'],
            'width' => null,
            'height' => null,
            'orientation' => null
        );
    }
    return $response;
}
add_filter( 'wp_prepare_attachment_for_js', 'mokko_display_svg_in_media_library', 10, 3 );
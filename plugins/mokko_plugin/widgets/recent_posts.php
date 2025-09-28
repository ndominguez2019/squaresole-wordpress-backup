<?php

Class mokko_recent_widget_custom extends WP_Widget {

    public function __construct() {
        $widget_details = array(
            'classname' => 'mokko_recent_widget_custom',
            'description' => esc_html__('Display Recent Thumbnail Posts.', 'mokko')
        );

        parent::__construct('mokko_recent_widget_custom', esc_html__('Mokko: Recent Thumbnail Posts', 'mokko'), $widget_details);
    }

    public function widget($args, $instance) {
                if ( ! isset( $args['widget_id'] ) ) {
                $args['widget_id'] = $this->id;
    }

    if ( function_exists( 'add_theme_support' ) ) {
        add_image_size( 'mokko-recent-post-thumb', 90, 90, true ); 
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts', 'mokko' );

    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
    if ( ! $number )
        $number = 5;
    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

    $r = new WP_Query( apply_filters( 'widget_posts_args', array(
        'posts_per_page'      => $number,
        'no_found_rows'       => true,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true
    ) ) );

    if ($r->have_posts()) :
    ?>
        <aside class="ms_widget_recent_posts">
        <?php  $args['before_widget']; ?>
        <?php if ( $title ) {
           echo wp_kses_post($args['before_title']) . $title . $args['after_title'];
        } ?>
        <ul>
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <li class="recent-post">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="post-image">
                        <div class="ms-p-arrow">
                            <svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewBox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z"></path>
                            </svg>
                        </div>
                        <?php the_post_thumbnail($size = 'mokko-recent-post-thumb', array( 'alt' => get_the_title())); ?>
                    </div>
                    <?php endif; ?>
                    <div class="recent-post__info">
                        <?php get_the_title() ? the_title() : the_ID(); ?>
                        <?php if ( $show_date ) : ?>
                            <span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
                        <?php endif; ?>
                    </div>
                </a>
            </li>
        <?php endwhile; ?>
        </ul>
        <?php $args['after_widget']; ?>
        <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif; ?>
        </aside>
    <?php }

    public function flush_widget_cache() {
        wp_cache_delete('widget_recent_posts_thumbnail', 'widget');
    }
 
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        ?>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" style="width:50px;" />
        </p>
        <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
        </p>
        <?php
    }

}